<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $pageTitle = 'User';
        return view('pages.user', compact('pageTitle'));
    }


    public function store(UserRequest $request)
    {
        try {
            $user =  User::create($request->validated());
            $user->assignRole($request->role);
            return response()->json(['param' => true, 'message' => 'Successfully']);
        } catch (\Exception $err) {
            return response()->json(['param' => false, 'message' => $err->getMessage()]);
        }
    }

    public function update(UserEditRequest $request, User $user)
    {
        try {

            $user->update($request->validated());
            $user->syncRoles($request->role);

            return response()->json(['param' => true, 'message' => 'Successfully']);
        } catch (\Exception $err) {
            return response()->json(['param' => false, 'message' => $err->getMessage()]);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $user =   User::findOrFail($request->ID);
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['param' => true, 'message' => 'Berhasil Update']);
        } catch (\Exception $err) {
            return response()->json(['param' => false, 'message' => $err->getMessage()]);
        }
    }

    public function logoutAllUsers()
    {
        DB::table('sessions')->truncate(); // Menghapus semua sesi
        return response()->json(['param' => true, 'message' => 'Semua user telah logout']);
    }

    public function logoutUser($id)
    {
        DB::table('sessions')
            ->where('user_id', $id) // `user_id` adalah kolom sesi yang terhubung ke pengguna
            ->delete(); // Menghapus sesi pengguna tertentu

        return response()->json(['param' => true, 'message' => 'User telah logout']);
    }
}
