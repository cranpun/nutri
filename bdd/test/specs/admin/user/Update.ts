import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import * as Path from "path";

export class Update extends BddSpec {
    private readonly contentsid:string = "#contents-admin-user-update";
    public isExport(): boolean {
        return true;
    }
    public async importsqls(): Promise<string[] | null> {
        return ["admin/ZzzUserSpecgroup/Create"]; // 削除等は飛ばす
    }
    public async spec(browser: BddBrowser): Promise<void> {
        // **********************************************************
        // 移動とデータ設定
        // **********************************************************
        await browser.move([
            new BddLink("#topnav-user", `#act-update-2`, 1000),
            new BddLink(`#act-update-2`, `#contents-admin-user-update`, 1000),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // **********************************************************
        // データ設定
        // **********************************************************
        await browser.type(`${this.contentsid} #name`, "update");
        await browser.type(`${this.contentsid} #display_name`, "update");
        // await browser.type(`${this.contentsid} #email`, "update");

        // 保存
        await browser.move([
            new BddLink("#act-submit", "#contents-admin-user-index"),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // 今回追加したユーザとデフォルトのユーザ
        await this.testCount(`#contents-admin-user-index #indextable tbody tr`, 2, browser);
        const id = "2";
        await this.testTextval(`#d-name-${id}`, "updatebdd_test_admin", browser);
        await this.testTextval(`#d-display_name-${id}`, "updatebddテスト用管理者", browser);
        // await this.testTextval(`#d-email-${id}`, "updatetest_admin@dev.dev.ll", browser);
    }
}