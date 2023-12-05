<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $roles = [
            'super-admin',
            'admin',
            'user',
        ];

        foreach ( $roles as $role ) {
            Role::firstOrCreate( ['name' => $role] );
        }

        $superAdmin = Role::where( 'name', 'super-admin' )->first();
        $superAdmin->permissions()->sync( Permission::all() );
    }
}
