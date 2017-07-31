<?php
namespace Baytek\Laravel\Users\Members\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(['member'] as $role) {
            Role::create(['name' => ucfirst($role)]);
        }

        foreach(['role'] as $permission) {
            Permission::create(['name' => ucwords('view '   . $permission)]);
            Permission::create(['name' => ucwords('create ' . $permission)]);
            Permission::create(['name' => ucwords('update ' . $permission)]);
            Permission::create(['name' => ucwords('delete ' . $permission)]);
        }
    }
}
