import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import * as Path from "path";

export class Delete extends BddSpec {
    private readonly controller:string = "food";

    public isExport(): boolean {
        return false; // ユーザは残す
    }
    public async importsqls(): Promise<string[] | null> {
        return null;
    }
    public async spec(browser: BddBrowser): Promise<void> {
        const id = 4;

        // **********************************************************
        // 移動とデータ設定
        // **********************************************************
        await browser.move([
            new BddLink("#topnav-food", `#contents-admin-${this.controller}-index #act-del-${id}`, 1000),
            new BddLink(`#contents-admin-${this.controller}-index  #act-del-${id}`, `.swal2-confirm`, 1000),
            new BddLink(`.swal2-confirm`, `#contents-admin-${this.controller}-index `, 1000),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // 指定したユーザがいない
        await this.testNotExist(`#row-${id}`, browser);
    }
}