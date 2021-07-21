import { BddSpecgroup } from "../../../BddSpecgroup"
import { BddSpec } from "../../../BddSpec";
import { Calendarfood } from "./Calendarfood";

export class ZzzAnalySpecgroup extends BddSpecgroup {
    makeSpecs(): BddSpec[] {
        const ret: BddSpec[] = [
            new Calendarfood(),
        ];
        return ret;
    }
    execSpecs(): string[] {
        const ret: string[] = [
            Calendarfood.name,
        ];
        return ret;
    }
}