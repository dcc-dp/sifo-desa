<?php

use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\PemerintahController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/pemerintah-index', [PemerintahController::class, 'index'])->name('pemerintah-index');
        Route::get('/pemerintah-create', [PemerintahController::class, 'create'])->name('pemerintah-create');
        Route::post('/pemerintah-store', [PemerintahController::class, 'store'])->name('pemerintah-store');
        Route::get('/pemerintah-edit/{id}', [PemerintahController::class, 'edit'])->name('pemerintah-edit');
        Route::put('/pemerintah-update/{id}', [PemerintahController::class, 'update'])->name('pemerintah-update');
        Route::get('/pemerintah-destroy/{id}', [PemerintahController::class, 'destroy'])->name('pemerintah-destroy');

        Route::get('/agenda-index', [AgendaController::class, 'index'])->name('agenda-index');
        Route::get('/agenda-create', [AgendaController::class, 'create'])->name('agenda-create');
        Route::post('/agenda-store', [AgendaController::class, 'store'])->name('agenda-store');
        Route::get('/agenda-edit/{id}', [AgendaController::class, 'edit'])->name('agenda-edit');
        Route::put('/agenda-update/{id}', [AgendaController::class, 'update'])->name('agenda-update');
        Route::get('/agenda-destroy/{id}', [AgendaController::class, 'destroy'])->name('agenda-destroy');
    });
});

// Route::get('/tes', function () {
//     return view('admin.pemerintah.tes');
// })->name('tes');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Route::get('/pemerintah-index', [PemerintahController::class, 'indexx'])
//     ->middleware('auth')
//     ->name('pemerintah-index');


Route::get('/tables', function () {
    return view('tables');
})->name('tables')->middleware('auth');

Route::get('/wallet', function () {
    return view('wallet');
})->name('wallet')->middleware('auth');

Route::get('/RTL', function () {
    return view('RTL');
})->name('RTL')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');
