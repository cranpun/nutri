import { BddSpec } from "./BddSpec";
import * as BddCommand from "./BddCommand";
import * as Path from "path";
import { BddBrowser } from "./BddBrowser";
import chalk from "chalk";

export abstract class BddSpecgroup {
    protected specsgroup: BddSpec[];
    protected abstract makeSpecs(): BddSpec[];
    public abstract execSpecs(): string[];

    constructor() {
        this.specsgroup = this.makeSpecs();
    }
    public getSpecs(): BddSpec[] {
        return this.specsgroup;
    }

    public async doTest(browser: BddBrowser, importsqls: { [key: string]: string }, role: string): Promise<void> {
        console.log(chalk.bgRed("vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv"));
        console.log(chalk.bgRed(`// group start : ${this.constructor.name}`));

        for (const spec of this.getSpecs()) {
            if (!this.execSpecs().includes(spec.name())) {
                // 実行対象でなければとばす。通知。
                const mes = `ignore spec ${spec.name()}`;
                console.log(` ***** ${mes} *****`);
                continue;
            }
            // sqlに使うのでスラッシュ固定で生成
            const name = `${this.name()}/${spec.name()}`; // group/spec。sqlやprotに利用。
            console.log(chalk.bgBlue("   // **********************************************"));
            console.log(chalk.bgBlue(`   // spec start   : ${name}`));
            const sqls: string[] | null = await spec.importsqls();
            if (sqls !== null) {
                // 個別の指定があればそれを使う
                for (const sql of await sqls) {
                    await BddCommand.importSql(sql);
                    await browser.waitMs(2000);
                }
            } else {
                // デフォルトは直前のsql
                const presql: string = importsqls[name];
                if (presql === null) {
                    throw "error : no import sql setting";
                }
                await BddCommand.importSql(presql);
                await browser.waitMs(2000);
            }
            // sqlの読み込み
            await browser.reload();

            await spec.spec(browser);

            if (spec.isExport()) {
                // ここはdocker内のpathになるので環境によらずスラッシュで結合
                await BddCommand.exportSql(`${this.name()}/${spec.name()}`, role);
                await browser.waitMs(2000);
            }
            console.log(chalk.bgBlue(`   // spec end     : ${name}`));
            console.log(chalk.bgBlue("   // **********************************************"));
            await browser.screenshot(`${this.name()}-${spec.name()}`);
        }

        console.log(chalk.bgRed(`// group end   : ${this.constructor.name}`));
        console.log(chalk.bgRed("^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^"));
        // await BddCommand.notifDoneSpecgroup(name);
    }

    public name(): string {
        const ret = this.constructor.name;
        return ret;
    }
}