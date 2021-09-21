<?php

namespace Tests;

use App\Models\Domain;
use App\Models\Permission;
use App\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

trait CreatesUser
{
    protected $super_admin, $admin, $user;

    public function setUp(): void
    {
        parent::setUp();
        
        Role::firstOrCreate(['name'=>'super-admin']);
        Role::firstOrCreate(['name'=>'admin']);
        Role::firstOrCreate(['name'=>'user']);
        
        $this->super_admin = User::factory()->create(['id'=>1]);
        $this->super_admin->assignRole('super-admin');

        $this->admin = User::factory()->create(['id'=>2]);
        $this->admin->assignRole('admin');

        $this->user = User::factory()->create(['id'=>3]);
        $this->user->assignRole('user');

        $this->setupPermissions();
        $this->setupDomains();
    }

    protected function setupPermissions()
    {
       
        $permission = [
            'user',
            'role',
            'permission',
            'client',
            'log',
            'domain',
        ];
        foreach ($permission as $key => $value) {
            Permission::firstOrCreate([
                    "name" => "create-".$value,
                    "guard_name" => 'web',
                ]);
            Permission::firstOrCreate([
                    "name" => "read-".$value,
                    "guard_name" => 'web',
                ]);
            Permission::firstOrCreate([
                    "name" => "update-".$value,
                    "guard_name" => 'web',
                ]);
            Permission::firstOrCreate([
                    "name" => "delete-".$value,
                    "guard_name" => 'web',
                ]);
        }   
        $this->super_admin
            ->syncPermissions([
                // 'create-user', 'read-user', 'update-user', 'delete-user',
                // 'create-role', 'read-role', 'update-role', 'delete-role',
                // 'create-permission', 'read-permission', 'update-permission', 'delete-permission',
            ]);

        $this->admin
            ->syncPermissions([
                'read-user',
                'create-client', 'read-client', 'update-client', 'delete-client',
                'read-role', 'read-permission', 'read-log',
                
            ]);

        $this->user
            ->syncPermissions([
                
            ]);

        $this->app->make(PermissionRegistrar::class)->registerPermissions();
    }

    public function setupDomains()
    {
        Domain::firstOrCreate(['name'=>'itk.ac.id']);
    }
}