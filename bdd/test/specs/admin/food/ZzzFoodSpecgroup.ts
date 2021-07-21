import { BddSpecgroup } from "../../../BddSpecgroup"
import { BddSpec } from "../../../BddSpec";
import { Create } from "./Create";
import { Delete } from "./Delete";
import { Update } from "./Update";

export class ZzzFoodSpecgroup extends BddSpecgroup {
    makeSpecs(): BddSpec[] {
        const ret: BddSpec[] = [
            new Create(),
            new Delete(),
            new Update(),
        ];
        return ret;
    }
    execSpecs(): string[] {
        const ret: string[] = [
            // Create.name,
            // Delete.name,
            Update.name,
        ];
        return ret;
    }
}