import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import dayjs from "dayjs";

export class Calendarfood extends BddSpec {
    private readonly controller:string = "food";

    public isExport(): boolean {
        return true;
    }
    public async importsqls(): Promise<string[] | null> {
        return null;
    }
    public async spec(browser: BddBrowser): Promise<void> {
        const date = dayjs().add(1, "day").format("YYYY-MM-DD");

        // **********************************************************
        // 移動とデータ設定
        // **********************************************************
        await browser.move([
            new BddLink("#topnav-analy", `#topnav-calendarfood`, 1000),
            new BddLink("#topnav-calendarfood", `#contents-admin-analy-calendarfood`, 1000),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // 今回追加したユーザとデフォルトのユーザ
        await this.testTextval(`#d-date-1-${date}`, "2", browser);
        await this.testTextval(`#d-date-2-${date}`, "2", browser);
        await this.testTextval(`#d-date-3-${date}`, "2", browser);
    }
}