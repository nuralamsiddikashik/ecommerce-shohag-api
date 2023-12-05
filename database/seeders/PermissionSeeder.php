<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $permissions = [
            'user-list',
            'user-show',
            'user-create',
            'user-edit',
            'user-delete',

            'role-list',
            'role-show',
            'role-create',
            'role-edit',
            'role-delete',
        ];

        foreach ( $permissions as $permission ) {
            Permission::firstOrCreate( ['name' => $permission] );
        }
    }
}
