import * as Path from "path";
import {
    launch,
    Browser,
    Page,
    LaunchOptions,
    BrowserLaunchArgumentOptions,
    BrowserConnectOptions,
    ElementHandle,
    WaitForSelectorOptions,
    KeyInput,
    ScreenshotOptions,
    Dialog
} from "puppeteer-core";
import * as BddCommand from "./BddCommand";
const process = require("process");
import chalk from "chalk";

export class BddLink {
    public click: string;
    public wait: string;
    public waitms: number;
    constructor(click: string, wait: string, waitms: number = 0) {
        this.click = click;
        this.wait = wait;
        this.waitms = waitms;
    }
}
export class BddBrowser {
    private browser!: Browser;
    private page!: Page;
    private appUrl!: string;
    public async start(appUrl: string): Promise<void> {
        this.appUrl = appUrl;
        const timeout = 7 * 1000;
        const opt: LaunchOptions & BrowserLaunchArgumentOptions & BrowserConnectOptions = {};
        opt.timeout = timeout;
        opt.executablePath = BddCommand.env("CHROME_PATH");
        opt.args = [
            '--lang=ja',
            // "--window-position=0,-3000", // デュアルディスプレイ用。マイナス値を入れると上のディスプレイになる。0,0でメインの左上。
            `--window-position=${BddCommand.env("WINDOW_POS")}`, // デュアルディスプレイ用。マイナス値を入れると上のディスプレイになる。0,0でメインの左上。
            `--window-size=${BddCommand.env("WINDOW_SIZE")}`, // ウィンドウを超える大きさであれば自動的に最大。
            "--guest",
        ];
        opt.defaultViewport = null;
        opt.headless = BddCommand.env("HEADLESS").toLowerCase() === "true";
        this.browser = await launch(opt);
        const pages: Page[] = await this.browser.pages();
        this.page = pages[0];
        this.page.setDefaultNavigationTimeout(timeout);
        this.page.setDefaultTimeout(timeout);
        await this.page.goto(`${appUrl}/login`);
    }
    public async end(): Promise<void> {
        if (this.browser) {
            await this.browser.close();
        }
    }
    public p(): Page {
        return this.page;
    }
    public async e(sel: string): Promise<ElementHandle<Element> | null> {
        const ret: ElementHandle<Element> | null = await this.page.$(sel);
        return ret;
    }
    public async td(testid: string): Promise<ElementHandle<Element> | null> {
        const ret: ElementHandle<Element> | null = await this.e(this.testid(testid));
        return ret;
    }
    public testid(testid: string): string {
        const ret: string = `[data-testid=${testid}]`;
        return ret;
    }
    public async move(links: BddLink[]): Promise<void> {
        for (const link of links) {
            console.log(`   move(${link.click},${link.wait})`);
            await this.page.click(link.click);
            const opt: WaitForSelectorOptions = {};
            opt.visible = true;
            await this.page.waitForSelector(link.wait, opt);

            // 次のクリックまでちょっと待つ
            if (link.waitms > 0) {
                await this.waitMs(link.waitms);
            }
        }
    }
    public async click(selector: string): Promise<void> {
        try {
            console.log(`       click:${selector}`);
            await this.page.click(selector);
        } catch (e) {
            console.error(e);
        }
    }
    public async waitMs(ms: number): Promise<void> {
        if (this.page) {
            console.log(`       waitms:${ms}`);
            await this.page.waitForTimeout(ms);
        }
    }
    // ******************************************************
    // input
    // ******************************************************
    public async type(sel: string, text: string): Promise<void> {
        console.log(`       type:${sel}->${text}`);
        await this.page.type(sel, text);
    }
    public async press(sel: string, key: KeyInput): Promise<void> {
        console.log(`       press:${sel}->${key}`);
        const ele: ElementHandle<Element> | null = await this.e(sel);
        if (ele) {
            await ele.press(key);
        }
    }
    public async date(sel: string, y: string | number, m: string | number, d: string | number): Promise<void> {
        console.log(`       date:${sel}->${y}-${m}-${d}`);
        // chromeの日付欄は年月日で欄が別れているので矢印で移動
        await this.page.type(sel, y.toString());
        await this.press(sel, 'ArrowRight');
        await this.page.type(sel, m.toString());
        await this.press(sel, 'ArrowRight');
        await this.page.type(sel, d.toString());
    }
    public async time(sel: string, h: string | number, m: string | number): Promise<void> {
        console.log(`       time:${sel}->${h}:${m}`);
        // chromeの時間欄は年月日で欄が別れているので矢印で移動
        await this.page.type(sel, h.toString());
        await this.press(sel, 'ArrowRight');
        await this.page.type(sel, m.toString());
    }
    public async backspace(sel: string, cnt: number = 1): Promise<void> {
        for (let i = 0; i < cnt; i++) {
            await this.press(sel, "Backspace");
        }
    }
    public async arrowleft(sel: string, cnt: number = 1): Promise<void> {
        for (let i = 0; i < cnt; i++) {
            await this.press(sel, "ArrowLeft");
        }
    }
    public async arrowright(sel: string, cnt: number = 1): Promise<void> {
        for (let i = 0; i < cnt; i++) {
            await this.press(sel, "ArrowRight");
        }
    }
    public async select(sel: string, child: string): Promise<void> {
        console.log(`       select:${sel}->${child}`);
        await this.page.select(sel, child);
    }
    public async file(sel: string, path: string): Promise<void> {
        const ele: ElementHandle<Element> | null = await this.e(sel);
        const cwdpath = Path.join(process.cwd(), path);
        if (ele) {
            await ele.uploadFile(cwdpath);
        }
    }
    public async login(account: string, password: string = "") {
        await this.page.goto(`${this.appUrl}/login`);
        await this.type("#name", account);
        const pass: string = password === "" ? BddCommand.env("LOGIN_PASSWORD") : password;
        await this.type("#password", pass);
        await this.move([
            new BddLink("#act-login", "#topnav-myname"),
        ]);
    }
    public async logout(): Promise<void> {
        // メニューでるまでちょっと待つ
        await this.move([
            new BddLink("#topnav-myname", "#act-logout"),
            new BddLink("#act-logout", "#act-login"),
        ]);
    }
    public async reload(): Promise<void> {
        await this.p().reload();
    }
    public async screenshot(name: string): Promise<void> {
        const p = Path.join(process.cwd(), "log", `${name}.jpg`);
        const opt: ScreenshotOptions = {};
        opt.path = p;
        opt.type = "jpeg";
        opt.fullPage = true;
        if (this.p()) {
            console.log(`\t\t screenshot => ${name}`);
            await this.p().screenshot(opt);
        } else {
            console.error("BddBrowser.screenshot : cannot screenshot. page is null.");
        }
    }

    // ******************************************************
    // get
    // ******************************************************
    public async textval(sel: string): Promise<string | number> {
        const val: string | number = await this.page.$eval(sel, ele => ele.innerHTML.trim());
        return val;
    }
    public async inputval(sel: string): Promise<string | number> {
        const val: string | number = await this.page.$eval(sel, (ele: Element) => (<HTMLInputElement>ele).value);
        return val;
    }
    public async check(sel: string): Promise<boolean> {
        const val: boolean = await this.page.$eval(sel, (ele: Element) => (<HTMLInputElement>ele).checked);
        return val;
    }
    public async count(sel: string): Promise<number> {
        const ret: number = await this.page.$$eval(sel, eles => eles.length);
        return ret;
    }
    public async getHref(sel: string): Promise<string | null> {
        const val: string | null = await this.page.$eval(sel, ele => ele.getAttribute("href"));
        return val;
    }
    // ******************************************************
    // dialog
    // ******************************************************
    public async dialogok(dialog: Dialog) {
        await dialog.accept();
    }
    public async dialogok_on(): Promise<void> {
        this.page.on("dialog", this.dialogok);
    }
    public async dialogok_off(): Promise<void> {
        this.page.off("dialog", this.dialogok);
    }
}
