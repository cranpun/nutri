import { BddSpecgroup } from "../../BddSpecgroup";
import { BddRole } from "../../BddRole";
import { ZzzUserSpecgroup } from "./user/ZzzUserSpecgroup";
import { ZzzFoodSpecgroup } from "./food/ZzzFoodSpecgroup";
import { ZzzMenuSpecgroup } from "./menu/ZzzMenuSpecgroup";
import { ZzzAnalySpecgroup } from "./analy/ZzzAnalySpecgroup";

export class AdminRole extends BddRole {
    protected makeSpecgroups(): BddSpecgroup[] {
        return [
            new ZzzUserSpecgroup(),
            new ZzzFoodSpecgroup(),
            new ZzzMenuSpecgroup(),
            new ZzzAnalySpecgroup(),
        ];
    }
    public execSpecgroups(): string[]{
        return [
            ZzzUserSpecgroup.name,
            ZzzFoodSpecgroup.name,
            ZzzMenuSpecgroup.name,
            ZzzAnalySpecgroup.name,
        ]
    }
}
