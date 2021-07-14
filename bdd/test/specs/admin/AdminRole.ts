import { BddSpecgroup } from "../../BddSpecgroup";
import { BddRole } from "../../BddRole";
import { ZzzUserSpecgroup } from "./user/ZzzUserSpecgroup";

export class AdminRole extends BddRole {
    protected makeSpecgroups(): BddSpecgroup[] {
        return [
            new ZzzUserSpecgroup(),
        ];
    }
    public execSpecgroups(): string[]{
        return [
            ZzzUserSpecgroup.name,
        ]
    }
}
