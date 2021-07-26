import { BddSpecgroup } from "../../../BddSpecgroup"
import { BddSpec } from "../../../BddSpec";
import { Update } from "./Update";
import { Swap } from "./Swap";
import { Shoppingnote } from "./Shoppingnote";

export class ZzzMenuSpecgroup extends BddSpecgroup {
    makeSpecs(): BddSpec[] {
        const ret: BddSpec[] = [
            new Update(),
            new Swap(),
            new Shoppingnote(),
        ];
        return ret;
    }
    execSpecs(): string[] {
        const ret: string[] = [
            Update.name,
            Swap.name,
            Shoppingnote.name
        ];
        return ret;
    }
}