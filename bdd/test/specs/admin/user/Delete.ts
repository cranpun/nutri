import { BddSpec } from "../../../BddSpec";
import { BddBrowser, BddLink } from "../../../BddBrowser";
import * as Path from "path";

export class Delete extends BddSpec {
    private readonly contentsid:string = "#contents-admin-user-index";
    public isExport(): boolean {
        return false; // ユーザは残す
    }
    public async importsqls(): Promise<string[] | null> {
        return ["admin/ZzzUserSpecgroup/Create"];
    }
    public async spec(browser: BddBrowser): Promise<void> {
        // **********************************************************
        // 移動とデータ設定
        // **********************************************************
        await browser.move([
            new BddLink("#topnav-user", `${this.contentsid} #act-del-2`, 1000),
            new BddLink(`${this.contentsid} #act-del-2`, `.swal2-confirm`, 1000),
            new BddLink(`.swal2-confirm`, `${this.contentsid}`, 1000),
        ]);

        // **********************************************************
        // 確認
        // **********************************************************
        // 指定したユーザがいない
        await this.testNotExist("#row-4", browser);
    }
}