<?php

namespace Modules\Core\Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRegistrar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            [
                "id" => Str::uuid(),
                "name" => "list base modules"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update base module"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create base module"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show base module"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change base module status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete base module"
            ],
            [
                "id" => Str::uuid(),
                "name" => "list business units"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update business unit"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create business unit"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show business unit"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change business unit status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete business unit"
            ],
            [
                "id" => Str::uuid(),
                "name" => "list product groups"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update product group"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create product group"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show product group"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change product group status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete product group"
            ],
            [
                "id" => Str::uuid(),
                "name" => "list product categories"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update product category"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create product category"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show product category"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change product category status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete product category"
            ],
            [
                "id" => Str::uuid(),
                "name" => "list shops"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update shop"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create shop"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show shop"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change shop status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete shop"
            ],
            // append permissions here
            [
                "id" => Str::uuid(),
                "name" => "list regions"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update region"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create region"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show region"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change region status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete region"
            ],
            // append permissions here
            [
                "id" => Str::uuid(),
                "name" => "list areas"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update area"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create area"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show area"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change area status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete area"
            ],
            // append permissions here
            [
                "id" => Str::uuid(),
                "name" => "list teams"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update team"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create team"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show team"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change team status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete team"
            ],
            // append permissions here
            [
                "id" => Str::uuid(),
                "name" => "list promoters"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update promoter"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create promoter"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show promoter"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change promoter status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete promoter"
            ],
            // append permissions here
            [
                "id" => Str::uuid(),
                "name" => "list pages"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update page"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create page"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show page"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change page status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete page"
            ],

            // append permissions here
            [
                "id" => Str::uuid(),
                "name" => "list contacts"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show contact"
            ],

            // append permissions here
            [
                "id" => Str::uuid(),
                "name" => "list specs"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update spec"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create spec"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show spec"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change spec status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete spec"
            ],

            // append permissions here
            [
                "id" => Str::uuid(),
                "name" => "list brands"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update brand"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create brand"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show brand"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change brand status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete brand"
            ],

            // append permissions here
            [
                "id" => Str::uuid(),
                "name" => "list models"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update model"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create model"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show model"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change model status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete model"
            ],
            [
                "id" => Str::uuid(),
                "name" => "list display"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show display"
            ],
            [
                "id" => Str::uuid(),
                "name" => "list shop targets"
            ],
            [
                "id" => Str::uuid(),
                "name" => "list attendances"
            ],
            [
                "id" => Str::uuid(),
                "name" => "add attendance note"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create attendances"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show attendances"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update attendances"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete attendances"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change attendance status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "list sellouts"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create sellout"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show sellout"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update sellout"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete sellout"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change sellout status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "export incentive"
            ],
            [
                "id" => Str::uuid(),
                "name" => "list notifications"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create notification"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show notification"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update notification"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete notification"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change notification status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "list channel types"
            ],
            [
                "id" => Str::uuid(),
                "name" => "create channel type"
            ],
            [
                "id" => Str::uuid(),
                "name" => "show channel type"
            ],
            [
                "id" => Str::uuid(),
                "name" => "update channel type"
            ],
            [
                "id" => Str::uuid(),
                "name" => "delete channel type"
            ],
            [
                "id" => Str::uuid(),
                "name" => "change channel type status"
            ],
            [
                "id" => Str::uuid(),
                "name" => "check sellout"
            ],


        ];

        // create permissions
        foreach ($permissions as $permission) {
            $check = Permission::query()->where('name', $permission['name'])->first();
            if ($check) {
                $check->update(['name' => $permission['name'], 'guard_name' => 'admin']);
            } else {
                Permission::create(['id' => $permission['id'], 'name' => $permission['name'], 'guard_name' => 'admin']);
            }
        }
    }
}
