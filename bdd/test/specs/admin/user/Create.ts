import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import * as BddCommand from "../../../BddCommand";

export class Create extends BddSpec {
    private readonly contentsid:string = "#contents-admin-user-create";
    public isExport(): boolean {
        return true;
    }
    public async importsqls(): Promise<string[] | null> {
        return []; // 一番最初のspecなのでから配列にする
    }
    public async spec(browser: BddBrowser): Promise<void> {
        // **********************************************************
        // 画面表示
        // **********************************************************
        await browser.move([
            new BddLink("#topnav-user", `#contents-admin-user-index #act-create`),
            new BddLink(`#contents-admin-user-index #act-create`, `${this.contentsid} #act-submit`),
        ]);

        // **********************************************************
        // データ設定
        // **********************************************************
        await browser.type(`${this.contentsid} #name`, "bdd_test_admin");
        await browser.type(`${this.contentsid} #password`, BddCommand.env("LOGIN_PASSWORD"));
        await browser.type(`${this.contentsid} #password_confirmation`, BddCommand.env("LOGIN_PASSWORD"));
        await browser.type(`${this.contentsid} #display_name`, "bddテスト用管理者");
        // await browser.type(`${this.contentsid} #email`, "test_admin@dev.dev.ll");

        // 保存
        await browser.move([
            new BddLink("#act-submit", "#contents-admin-user-index"),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // 今回追加したユーザとデフォルトのユーザ
        await this.testCount(`#contents-admin-user-index #indextable tbody tr`, 2, browser);
        // ユーザとしては2番目
        const id = "2";
        await this.testTextval(`#d-name-${id}`, "bdd_test_admin", browser);
        await this.testTextval(`#d-display_name-${id}`, "bddテスト用管理者", browser);
        // await this.testTextval(`#d-email-${id}`, "test_admin@dev.dev.ll", browser);
    }
}