<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'name' => 'user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'super-admin',
                'guard_name' => 'web',
            ],
        ]);

        $role1 = Role::find(1);
        $role1->syncPermissions();
        $role2 = Role::find(2);
        $role2->permissions()->sync([2,6,10,14,18]);
    }
    // 13,14,15,16,17,18,19,20,21,22,23,24
}