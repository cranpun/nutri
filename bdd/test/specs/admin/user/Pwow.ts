import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import * as Path from "path";
import * as BddCommand from "../../../BddCommand";

export class Pwow extends BddSpec {
    private readonly contentsid: string = "#contents-admin-user-index";
    public isExport(): boolean {
        return false;
    }
    public async importsqls(): Promise<string[] | null> {
        // 前のspecがpassword changeでsqlを生成していないので、その前のAddを使う
        return ["admin/ZzzUserSpecgroup/Create"];
    }
    public async spec(browser: BddBrowser): Promise<void> {
        // **********************************************************
        // 移動
        // **********************************************************
        await browser.move([
            new BddLink("#topnav-user", `${this.contentsid} #act-overwritepassword-2`, 1000),
            // 2番目のユーザのパスワードを変更
            new BddLink(`${this.contentsid} #act-overwritepassword-2`, `.swal2-input`, 1000),
        ]);

        // **********************************************************
        // データ設定
        // **********************************************************
        await browser.type(`.swal2-input`, `anotherpass`);
        await browser.move([
            new BddLink(`.swal2-confirm`, `${this.contentsid}`, 1000),
        ]);

        // ログアウトしてパスワード確認
        await browser.logout();
        await browser.login("bdd_test_admin", "anotherpass");

        // **********************************************************
        // 確認
        // **********************************************************
        // ログアウトボタンがあればログイン成功
        await this.testExist("#act-logout", browser);

        // **********************************************************
        // 後処理
        // **********************************************************
        // 管理者ユーザで再ログイン
        await browser.logout();
        await browser.login("nutri_bdd_admin");
    }
}