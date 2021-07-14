import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import * as Path from "path";
import * as BddCommand from "../../../BddCommand";

export class Pwch extends BddSpec {
    private readonly contentsid:string = "#contents-admin-user-index";
    public isExport(): boolean {
        // 管理者のパスワードが変わってしまっているのでsqlは出さない。
        return false;
    }
    public async importsqls(): Promise<string[] | null> {
        // 直前がDeleteなので使わない
        return ["admin/ZzzUserSpecgroup/Create"];
    }
    public async spec(browser: BddBrowser): Promise<void> {
        // **********************************************************
        // 移動
        // **********************************************************
        await browser.move([
            new BddLink("#topnav-myname", "#act-logout"),
            new BddLink(`#topnav-changepassword`, `.swal2-input`, 1000),
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
        await browser.login("nutri_bdd_admin", "anotherpass");

        // **********************************************************
        // 確認
        // **********************************************************
        // ログアウトボタンがあればログイン成功
        await this.testExist("#act-logout", browser);
    }
}