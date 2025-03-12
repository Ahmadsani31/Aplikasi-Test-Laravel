<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 5;
        $role = Role::query()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        return view('pages.role', [
            'pageTitle' => 'Role',
        ], compact('role'))->with('i', ($request->input('page', 1) - 1) * $perPage);
    }

    public function store(RoleRequest $request)
    {
        try {
            $permissionsID = array_map(
                function ($value) {
                    return (int)$value;
                },
                $request->input('permission')
            );

            dd($permissionsID);
            if ($request->ID == 0) {


                $role = Role::create(['name' => $request->name]);
                $role->syncPermissions($permissionsID);
            } else {
                $role = Role::find($request->ID);
                $role->name = $request->input('name');
                $role->save();
                $role->syncPermissions($permissionsID);
            }
            return response()->json(['param' => true, 'message' => 'Successfully']);
        } catch (\Exception $err) {
            return response()->json(['param' => false, 'message' => $err->getMessage()]);
        }
    }
}
