<?php

use App\Http\Controllers\BMICalculatorController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\IconsController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\TextComparisonController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\XSSProtection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('auth.login', ['pageTitle' => 'Login']);
})->middleware('guest');

Route::get('/test', function () {


    $roles = Permission::all()->pluck('name');
    echo '<pre>';
    print_r($roles);
    echo '</pre>';
})->middleware('guest');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store')->middleware('xss');

    Route::get('/sub-kategori', [SubKategoriController::class, 'index'])->name('sub-kategori');
    Route::post('/sub-kategori/store', [SubKategoriController::class, 'store'])->name('sub-kategori.store')->middleware('xss');
    Route::put('/sub-kategori/edit/{id}', [SubKategoriController::class, 'edit'])->name('sub-kategori.edit')->middleware('xss');

    Route::get('/text-comparisons', [TextComparisonController::class, 'index'])->name('text-comparisons');
    Route::post('/text-comparisons', [TextComparisonController::class, 'compareTexts'])->name('compare-texts');


    Route::get('/role', [RoleController::class, 'index'])->name('role');
    Route::post('/role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/permission', [PermissionController::class, 'index'])->name('permission');
    Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');


    Route::get('/bmi', [BMICalculatorController::class, 'index'])->name('bmi');
    Route::post('/bmi', [BMICalculatorController::class, 'calculate'])->name('bmi.store');

    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store')->middleware(XSSProtection::class);
    Route::put('user/update/{user}', [UserController::class, 'update'])->name('user.update')->middleware(XSSProtection::class);
    Route::post('/user/password', [UserController::class, 'updatePassword'])->name('user.password')->middleware(XSSProtection::class);
    Route::get('/user/logout-all', [UserController::class, 'logoutAllUsers']);
    Route::get('/user/logout/{id}', [UserController::class, 'logoutUser']);


    Route::get('/datatable/{tabel}', [DatatableController::class, 'index'])->name('datatable');


    Route::delete('/delete/{table}/{id}', [DeleteController::class, 'index'])->name('delete');
    Route::post('/modal/{name}', function (Request $request) {
        $param = $request->segment(2);
        return view('modal/' . $param);
    });
});

require __DIR__ . '/auth.php';
