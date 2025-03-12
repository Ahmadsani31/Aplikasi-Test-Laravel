<?php

namespace App\Http\Controllers;

use App\Models\TextComparison;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {

        $user = User::count();

        $comparison = TextComparison::count();
        $role = Role::count();

        $pageTitle = 'Dashboard';
        return view('dashboard', compact('pageTitle', 'user', 'comparison', 'role'));
    }
}
