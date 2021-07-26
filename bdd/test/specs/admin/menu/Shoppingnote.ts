import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import * as Path from "path";

export class Shoppingnote extends BddSpec {
    private readonly controller:string = "food"; // メニュー登録後の機能ではあるが、フード関連の機能

    public isExport(): boolean {
        return true;
    }
    public async importsqls(): Promise<string[] | null> {
        return null;
    }
    public async spec(browser: BddBrowser): Promise<void> {
        const id = 2;

        // **********************************************************
        // 移動とデータ設定
        // **********************************************************
        await browser.move([
            new BddLink("#topnav-shoppingnote", `#contents-admin-${this.controller}-shoppingnote`, 1000),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // 今回追加したユーザとデフォルトのユーザ
        await this.testCount(`.d-name`, 3, browser);
        await this.testTextval(`#d-name-${id}`, "卵", browser);
        await this.testTextval(`#d-category-${id}`, "その他", browser);
        await this.testTextval(`#d-count-${id}`, "2", browser);
    }
}