import { BddSpecgroup } from "../../BddSpecgroup";
import { BddRole } from "../../BddRole";
import { ZzzUserSpecgroup } from "./user/ZzzUserSpecgroup";
import { ZzzFoodSpecgroup } from "./food/ZzzFoodSpecgroup";

export class AdminRole extends BddRole {
    protected makeSpecgroups(): BddSpecgroup[] {
        return [
            new ZzzUserSpecgroup(),
            new ZzzFoodSpecgroup(),
        ];
    }
    public execSpecgroups(): string[]{
        return [
            // ZzzUserSpecgroup.name,
            ZzzFoodSpecgroup.name,
        ]
    }
}
