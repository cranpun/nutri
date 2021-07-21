import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import * as BddCommand from "../../../BddCommand";

export class Create extends BddSpec {
    private readonly controller = "food";
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
            new BddLink("#topnav-food", `#contents-admin-${this.controller}-index #act-create-open`),
            new BddLink(`#act-create-open`, `#act-create`),
        ]);

        // **********************************************************
        // データ設定
        // **********************************************************
        await browser.type(`#name`, "bdd_test_food");

        // 保存
        await browser.move([
            new BddLink("#act-create", `#contents-admin-${this.controller}-update`),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // 栄養素だけ登録
        await browser.click("#nutri_ids_1");
        await browser.click("#nutri_ids_2");
        await browser.click("#nutri_ids_3");

        await browser.move([
            new BddLink("#act-submit", `#contents-admin-${this.controller}-index`),
        ]);

        // ユーザとしては2番目
        const id = "125";
        await this.testTextval(`#d-name-${id}`, "bdd_test_food", browser);
        await this.testTextval(`#d-category-${id}`, "その他", browser);
        await this.testExist(`#d-foodnutri-${id}-1`, browser);
        await this.testExist(`#d-foodnutri-${id}-2`, browser);
        await this.testExist(`#d-foodnutri-${id}-3`, browser);
        await this.testCount(`.d-foodnutri-${id}`, 3, browser);
    }
}