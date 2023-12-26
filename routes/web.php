<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ClientController;

Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

/*
 * ROTAS DE FILIAIS
 * */
Route::middleware(['auth'])->group(function () {
    Route::prefix('filiais')->group(function () {
        Route::get('/', [BranchController::class, 'index'])->name('branch.index');
        Route::post('/', [BranchController::class, 'create'])->name('branch.create');
        Route::get('{branch}', [BranchController::class, 'show'])->name('branch.show');
        Route::put('{branch}', [BranchController::class, 'update'])->name('branch.update');
        Route::delete('{branch}', [BranchController::class, 'delete'])->name('branch.delete');
    });
});

/*
 * ROTAS DE USUÁRIOS
 * */
Route::middleware(['auth'])->group(function () {
    Route::prefix('usuarios')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/', [UserController::class, 'create'])->name('user.store');
        Route::get('{user}', [UserController::class, 'show'])->name('user.show');
        Route::put('{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('{user}', [UserController::class, 'delete'])->name('user.destroy');
    });
});

/*
 * ROTAS DE PLANOS
 * */
Route::middleware(['auth'])->group(function () {
    Route::prefix('planos')->group(function () {
        Route::get('/', [PlanController::class, 'index'])->name('plan.index');
        Route::post('/', [PlanController::class, 'create'])->name('plan.store');
        Route::get('{plan}', [PlanController::class, 'show'])->name('plan.show');
        Route::put('{plan}', [PlanController::class, 'update'])->name('plan.update');
        Route::delete('{plan}', [PlanController::class, 'delete'])->name('plan.destroy');
    });
});

/*
 * ROTAS DE CLIENTES
 * */
Route::middleware(['auth'])->group(function () {
    Route::prefix('clientes')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.index');
        Route::post('/', [ClientController::class, 'create'])->name('client.store');
//        Route::get('{plan}', [PlanController::class, 'show'])->name('plan.show');
//        Route::put('{plan}', [PlanController::class, 'update'])->name('plan.update');
//        Route::delete('{plan}', [PlanController::class, 'delete'])->name('plan.destroy');
    });
});

/*
 * ROTAS DE AUTENTICAÇÃO
 * */
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return view('404');
});
