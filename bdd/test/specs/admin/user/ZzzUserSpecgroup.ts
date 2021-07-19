import { BddSpecgroup } from "../../../BddSpecgroup"
import { BddSpec } from "../../../BddSpec";
import { Create } from "./Create";
import { Delete } from "./Delete";
import { Pwow } from "./Pwow";
import { Pwch } from "./Pwch";
import { Update } from "./Update";

export class ZzzUserSpecgroup extends BddSpecgroup {
    makeSpecs(): BddSpec[] {
        const ret: BddSpec[] = [
            new Create(),
            new Pwch(),
            new Pwow(),
            new Delete(),
            new Update(),
        ];
        return ret;
    }
    execSpecs(): string[] {
        const ret: string[] = [
            Create.name,
            Pwch.name,
            Pwow.name,
            Delete.name,
            Update.name,
        ];
        return ret;
    }
}