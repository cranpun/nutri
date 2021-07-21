import { BddSpecgroup } from "../../../BddSpecgroup"
import { BddSpec } from "../../../BddSpec";
import { Update } from "./Update";
import { Swap } from "./Swap";

export class ZzzMenuSpecgroup extends BddSpecgroup {
    makeSpecs(): BddSpec[] {
        const ret: BddSpec[] = [
            new Update(),
            new Swap(),
        ];
        return ret;
    }
    execSpecs(): string[] {
        const ret: string[] = [
            Update.name,
            Swap.name
        ];
        return ret;
    }
}