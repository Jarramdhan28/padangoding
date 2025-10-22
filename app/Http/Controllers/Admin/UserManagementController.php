<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('pages.admin.user-management.index');
    }

    public function getData(Request $request)
    {
        $result = User::with('roles')
            ->when($request->search, function($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('username', 'ILIKE', "%{$search}%")
                      ->orWhere('name', 'ILIKE', "%{$search}%")
                      ->orWhere('email', 'ILIKE', "%{$search}%");
                });
            })
            ->orderBy('name', 'asc')
            ->paginate(10);
        return ResponseHelper::responseWithMeta((bool) $result, UserResource::collection($result));
    }

    public function getRole()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function setRole(Request $request, User $user)
    {
        $role = Role::find($request->role_id);
        $user->syncRoles($role->name);

        return ResponseHelper::sendResponse((bool) $user, "tambahkan", "Role");
    }
}
