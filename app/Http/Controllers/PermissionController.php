<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 5;
        $permission = Permission::query()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        return view('pages.permission', [
            'pageTitle' => 'Permission',
        ], compact('permission'))->with('i', ($request->input('page', 1) - 1) * $perPage);
    }

    public function store(PermissionRequest $request)
    {
        try {
            if ($request->ID == 0) {
                Permission::create($request->validated());
            } else {
                Permission::where('id', $request->ID)->update($request->validated());
            }
            return response()->json(['param' => true, 'message' => 'Successfully']);
        } catch (\Exception $err) {
            return response()->json(['param' => false, 'message' => $err->getMessage()]);
        }
    }
}
