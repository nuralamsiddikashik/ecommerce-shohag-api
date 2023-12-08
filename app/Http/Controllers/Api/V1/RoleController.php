<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller {
    public function index() {
        $roles = Role::with( 'permissions' )->get();
        return ok( 'Success', $roles );
    }

    public function store( RoleRequest $request ) {
        $role = Role::create( $request->only( 'name' ) );
        $role->permissions()->sync( $request->permissions );
        return ok( 'Role created', $role );
    }

    public function update( RoleRequest $request, Role $role ) {
        $role->update( $request->only( 'name' ) );
        $role->permissions()->sync( $request->permissions );
        $this->logoutAllUsers();
        return ok( 'Role updated', $role );
    }

    public function destroy( Role $role ) {
        $role->delete();
        $this->logoutAllUsers();
        return ok( 'Role deleted' );
    }

    public function show( Role $role ) {
        $role->load( 'permissions' );
        return ok( 'Success', $role );
    }

    public function syncPermissions( Request $request, Role $role ) {
        $role->permissions()->sync( $request->permissions );
        return ok( 'Permissions sysnced' );
    }

    public function logoutAllUsers() {
        DB::table( 'personal_access_tokens' )->truncate();
    }
}
