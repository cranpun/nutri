import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import * as Path from "path";

export class Update extends BddSpec {
    private readonly controller:string = "food";

    public isExport(): boolean {
        return true;
    }
    public async importsqls(): Promise<string[] | null> {
        return ["admin/ZzzFoodSpecgroup/Create"]; // 削除等は飛ばす
    }
    public async spec(browser: BddBrowser): Promise<void> {
        const id = 4;

        // **********************************************************
        // 移動とデータ設定
        // **********************************************************
        await browser.move([
            new BddLink("#topnav-food", `#act-update-${id}`, 1000),
            new BddLink(`#act-update-${id}`, `#contents-admin-${this.controller}-update`, 1000),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // **********************************************************
        // データ設定
        // **********************************************************
        await browser.type(`#name`, "update");
        await browser.click("#favorite");
        await browser.select(`#category`, 'seafood');
        await browser.click("#nutri_ids_1");
        await browser.click("#nutri_ids_4");

        // 保存
        await browser.move([
            new BddLink("#act-submit", `#contents-admin-${this.controller}-index`),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // 今回追加したユーザとデフォルトのユーザ
        await this.testTextval(`#d-name-${id}`, "updatebdd_test_food", browser);
        await this.testExist(`#row-${id}.favorite`, browser);
        await this.testTextval(`#d-category-${id}`, "魚介類", browser);
        await this.testExist(`#d-foodnutri-${id}-2`, browser);
        await this.testExist(`#d-foodnutri-${id}-3`, browser);
        await this.testExist(`#d-foodnutri-${id}-4`, browser);
        await this.testCount(`.d-foodnutri-${id}`, 3, browser);
    }
}