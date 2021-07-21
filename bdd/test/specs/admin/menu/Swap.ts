import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import dayjs from "dayjs";

export class Swap extends BddSpec {
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
            new BddLink("#topnav-menu", `#act-swap-${today}-lunch-up`, 1000),
            new BddLink(`#act-swap-${today}-lunch-up`, `#contents-admin-${this.controller}-index`, 1000),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************

        // **********************************************************
        // 確認
        // **********************************************************
        // 今回追加したユーザとデフォルトのユーザ
        const nextday = dayjs().add(1, "day").format("YYYY-MM-DD");
        await this.testTextval(`#row-${nextday} #d-menu-1`, "bdd_menu1", browser);
        await this.testTextval(`#row-${nextday} #d-menu-2`, "bdd_menu2", browser);
    }
}