// require("source-map-support").install();
import * as Path from "path";
import { BddBrowser } from "./BddBrowser";
import * as BddCommand from "./BddCommand";
import { BddRole } from "./BddRole";
import { AdminRole } from "./specs/admin/AdminRole";
const process = require("process");

const main = (async () => {
    require("dotenv").config();
    BddCommand.init();
    const browser: BddBrowser = new BddBrowser();
    try {
        let role: BddRole = new AdminRole();
        // デフォルトのroleはdebugで確認したいときに指定。
        const optrole = process.argv[2];
        switch (optrole) {
            case 'admin':
                console.log("role is admin");
                role = new AdminRole();
                break;
            default:
                console.log("no role specified. test for default.");
                return;;
        }

        console.log("start test for " + role.name());
        const argExecSpecgroup: string = process.argv[3];

        // importsqlのリスト＝自分の一個前のspecの名前を作成。自分の名前の連想配列。実際に使うかは各specで設定。
        // 合わせて無効化されているSpecの一覧を作成
        const importsqls: { [key: string]: string } = {};
        const ignores: string[] = [];
        let prename = null;
        // グループ単位も確認
        const execgroups = role.execSpecgroups();
        for (const specgroup of role.getSpecgroups()) {
            // 実行対象：グループ単位の判定。
            if (argExecSpecgroup === undefined) {
                // 引数指定がなければコード中の設定を読み取り
                if (!execgroups.includes(specgroup.name())) {
                    ignores.push(specgroup.name());
                }
            } else {
                // 引数指定があればそれだけ
                if (argExecSpecgroup !== specgroup.name()) {
                    ignores.push(specgroup.name());
                }
            }
            const execspecs = specgroup.execSpecs();
            for (const spec of specgroup.getSpecs()) {
                // sql。docker内のpathなので区切りはスラッシュ固定
                const name: string = `${specgroup.name()}/${spec.name()}`;
                importsqls[name] = `${role.name()}/${prename}`;
                prename = name;

                // 実行対象でなければignoreに追加
                if (!execspecs.includes(spec.name())) {
                    ignores.push(`${specgroup.name()} / ${spec.name()}`);
                }
            }
        }

        // 無効なspecがあれば注意喚起
        if (ignores.length > 0) {
            BddCommand.notifStart("無効化されているgroup/specがあります");
            console.warn("ignore group/specs : ", ignores);
        }

        // テスト実行
        await browser.start(BddCommand.env("APPURL"));
        // ブラウザ起動が落ち着くまでちょっと待つ
        await browser.waitMs(3000);
        if (!["pub"].includes(role.name())) {
            // nologin以外はログイン
            await browser.login(`nutri_bdd_${role.name()}`);
        }

        // テスト実行。Execで指定した対象に従って。
        for (const specgroup of role.getSpecgroups()) {
            // コード中に実行指定されていない or 引数でしていしていないならignore
            if (!role.execSpecgroups().includes(specgroup.name())
                || (argExecSpecgroup !== undefined && argExecSpecgroup !== specgroup.name())) {
                // 実行対象でなければとばす。通知。
                const mes = `ignore spec ${specgroup.name()}`;
                console.log(` ***** ${mes} *****`);
                // BddCommand.notifStart(mes);
            } else {
                await specgroup.doTest(browser, importsqls, role.name());
            }
        }

        await browser.waitMs(2000); // 音がかぶるのでちょっと待つ
        await BddCommand.notifSuccess("success for " + role.name());
    } catch (e) {
        await browser.waitMs(2000); // 音がかぶるのでちょっと待つ
        console.error(e);
        await BddCommand.notifError("error");
    } finally {
        await browser.screenshot("finally");
        await browser.end();
    }
});
main();

// ***************************************************************************
// testcode
// ***************************************************************************
// (async () => {
//     await BddCommand.importSqlPris("../../../docker/os/iwill-sys_pris57");
// })();
    // (async () => {
//     require("dotenv").config();
//     const browser: BddBrowser = new BddBrowser();
//     try {
//         // テスト実行
//         await browser.start(BddCommand.env("APPURL"));
//         // ブラウザ起動が落ち着くまでちょっと待つ
//         await browser.waitMs(3000);

//     } catch (e) {
//         console.error(e);
//     } finally {
//         await browser.screenshot("bdd");
//         await browser.end();
//     }
// })();

// (async () => {
//     // await BddCommand.exportSql("finish");
//     // await BddCommand.exportSql("finish");
//     // await BddCommand.importSql("finish");
// })();
