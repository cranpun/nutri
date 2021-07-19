import { BddSpec } from "./BddSpec";
import * as BddCommand from "./BddCommand";
import * as Path from "path";
import { BddBrowser } from "./BddBrowser";
import { BddSpecgroup } from "./BddSpecgroup";


export abstract class BddRole {
    protected specgroups: BddSpecgroup[];
    protected abstract makeSpecgroups(): BddSpecgroup[];
    public abstract execSpecgroups(): string[];

    constructor() {
        this.specgroups = this.makeSpecgroups();
    }
    public getSpecgroups(): BddSpecgroup[] {
        return this.specgroups;
    }
    public name(): string {
        // [大文字のロール]Roleになっているので、Roleを削って小文字
        return this.constructor.name.replace("Role", "").toLowerCase();
    }
}