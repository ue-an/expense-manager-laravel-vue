<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\RoleController;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $categories = Category::latest()->get();
    $expenses = Expense::where('user_id', $user->id)->latest()->get();
    $sums = [];

    for ($i = 0; $i <= count($categories) - 1; $i++) {
        array_push($sums, $expenses->where('category_id', $categories[$i]->id)->sum('amount'));
    }

    return Inertia::render('Dashboard', [
        'categories' => $categories,
        'sums' => $sums,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('account', ProfileController::class);
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('expense', ExpenseController::class);
});

require __DIR__ . '/auth.php';
