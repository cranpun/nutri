import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import dayjs from "dayjs";

export class Update extends BddSpec {
    private readonly controller:string = "menu";

    public isExport(): boolean {
        return true;
    }
    public async importsqls(): Promise<string[] | null> {
        return null;
    }
    public async spec(browser: BddBrowser): Promise<void> {
        const today = dayjs().format("YYYY-MM-DD");

        // **********************************************************
        // 移動とデータ設定
        // **********************************************************
        await browser.move([
            new BddLink("#topnav-menu", `#act-update-${today}-lunch`, 1000),
            new BddLink(`#act-update-${today}-lunch`, `#contents-admin-${this.controller}-update`, 1000),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // **********************************************************
        // データ設定
        // **********************************************************
        await browser.type(`#name_0`, "bdd_menu1");
        await browser.type(`#memo_0`, "bdd_memo1");
        await browser.click("#menufood_0_2");
        await browser.click("#menufood_0_3");
        await browser.click("#menufood_0_1");

        await browser.type(`#name_1`, "bdd_menu2");
        await browser.type(`#memo_1`, "bdd_memo2");
        await browser.click("#menufood_1_2");
        await browser.click("#menufood_1_3");
        await browser.click("#menufood_1_1");

        // 保存
        await browser.move([
            new BddLink("#act-submit", `#contents-admin-${this.controller}-index`),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // 今回追加したユーザとデフォルトのユーザ
        await this.testTextval(`#row-${today} #d-menu-1`, "bdd_menu1", browser);
        await this.testTextval(`#row-${today} #d-menu-2`, "bdd_menu2", browser);
    }
}