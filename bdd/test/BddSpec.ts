import { BddBrowser } from "./BddBrowser";
import Assert = require("assert");
import * as BddCommand from "./BddCommand";
import chalk from "chalk";

export abstract class BddSpec {
    public abstract importsqls(): Promise<string[] | null>;
    public abstract spec(browser: BddBrowser): Promise<void>;
    public abstract isExport(): boolean;

    protected readonly finalsql = "Admin/ZzzConfigSpecgroup/Update";

    public name(): string {
        const ret = this.constructor.name;
        return ret;
    }

    // ******************************************************
    // assert
    // ******************************************************
    protected test(desc: string, actual: any, expect: any): void {
        console.log(chalk.yellow(`           ${desc}`));
        Assert.strictEqual(actual, expect);
    }
    public async testExist(sel: string, browser: BddBrowser): Promise<void> {
        const expect: number = 1;
        const actual: number = await browser.count(sel);
        console.log(chalk.yellow(`           testExist : ${sel}`));
        Assert.strictEqual(actual, expect);
    }
    public async testNotExist(sel: string, browser: BddBrowser): Promise<void> {
        const expect: number = 0;
        const actual: number = await browser.count(sel);
        console.log(chalk.yellow(`           testNotExist : ${sel}`));
        Assert.strictEqual(actual, expect);
    }
    public async testTextval(sel: string, expect: string | number, browser: BddBrowser): Promise<void> {
        const actual: string | number = await browser.textval(sel);
        console.log(chalk.yellow(`           testTextval(${expect}) : ${sel}`));
        Assert.strictEqual(actual.toString(), expect.toString());
    }
    public async testTextdate(sel: string, expect: string | number, browser: BddBrowser): Promise<void> {
        const val: string | number = await browser.textval(sel);
        const actual:string = BddCommand.datestr(new Date(val.toString()));
        console.log(chalk.yellow(`           testDateval(${expect}) : ${sel}`));
        Assert.strictEqual(actual.toString(), expect.toString());
    }
    public async testInputval(sel: string, expect: string | number, browser: BddBrowser): Promise<void> {
        const actual: string | number = await browser.inputval(sel);
        console.log(chalk.yellow(`           testInputval(${expect}) : ${sel}`));
        Assert.strictEqual(actual.toString(), expect.toString());
    }
    public async testCount(sel: string, expect: number, browser: BddBrowser): Promise<void> {
        const actual: number = await browser.count(sel);
        console.log(chalk.yellow(`           testCount(${expect}) : ${sel}`));
        Assert.strictEqual(actual, expect);
    }
}