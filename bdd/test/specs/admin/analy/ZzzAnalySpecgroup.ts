import { BddSpecgroup } from "../../../BddSpecgroup"
import { BddSpec } from "../../../BddSpec";
import { Calendarfood } from "./Calendarfood";
import { Calendarnutri } from "./Calendarnutri";

export class ZzzAnalySpecgroup extends BddSpecgroup {
    makeSpecs(): BddSpec[] {
        const ret: BddSpec[] = [
            new Calendarfood(),
            new Calendarnutri(),
        ];
        return ret;
    }
    execSpecs(): string[] {
        const ret: string[] = [
            Calendarfood.name,
            Calendarnutri.name,
        ];
        return ret;
    }
}