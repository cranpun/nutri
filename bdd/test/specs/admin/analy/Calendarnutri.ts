import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import dayjs from "dayjs";

export class Calendarnutri extends BddSpec {
    private readonly controller:string = "nutri";

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
            new BddLink("#topnav-analy", `#topnav-calendarnutri`, 1000),
            new BddLink("#topnav-calendarnutri", `#contents-admin-analy-calendarnutri`, 1000),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // 今回追加したユーザとデフォルトのユーザ
        await this.testTextval(`#d-date-1-${date}`, "4", browser);
        await this.testTextval(`#d-date-4-${date}`, "2", browser);
        await this.testTextval(`#d-date-5-${date}`, "2", browser);
        await this.testTextval(`#d-date-8-${date}`, "4", browser);
        await this.testTextval(`#d-date-13-${date}`, "2", browser);
        await this.testTextval(`#d-date-18-${date}`, "2", browser);
        await this.testTextval(`#d-date-19-${date}`, "2", browser);
        await this.testTextval(`#d-date-23-${date}`, "2", browser);
        await this.testTextval(`#d-date-25-${date}`, "4", browser);
        await this.testTextval(`#d-date-31-${date}`, "2", browser);
    }
}