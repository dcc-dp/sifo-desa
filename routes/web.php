<?php


use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PemerintahController;

use App\Http\Controllers\admin\DatapendudukController;

use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Admin\SuratDomisiliController;
use App\Http\Controllers\Admin\SuratPengantarController;
use App\Http\Controllers\Admin\SuratKetusController;
use App\Http\Controllers\Admin\SuratIzinController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GaleriController;
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

        Route::get('/kategori-index', [KategoriController::class, 'index'])->name('kategori-index');
        Route::get('/kategori-create', [KategoriController::class, 'create'])->name('kategori-create');
        Route::post('/kategori-store', [KategoriController::class, 'store'])->name('kategori-store');
        Route::get('/kategori-edit/{id}', [KategoriController::class, 'edit'])->name('kategori-edit');
        Route::put('/kategori-update/{id}', [KategoriController::class, 'update'])->name('kategori-update');
        Route::get('/kategori-destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori-destroy');

        Route::get('/berita-index', [BeritaController::class, 'index'])->name('berita-index');
        Route::get('/berita-create', [BeritaController::class, 'create'])->name('berita-create');
        Route::post('/berita-store', [BeritaController::class, 'store'])->name('berita-store');
        Route::get('/berita-edit/{id}', [BeritaController::class, 'edit'])->name('berita-edit');
        Route::put('/berita-update/{id}', [BeritaController::class, 'update'])->name('berita-update');
        Route::get('/berita-destroy/{id}', [BeritaController::class, 'destroy'])->name('berita-destroy');
    });
});

// Route::get('/tes', function () {
//     return view('admin.pemerintah.tes');
// })->name('tes');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');


// Route::get('/galeri', function(){
//     return view('admin.galeri.galeri');
// })->name('galeri')->middleware('auth');

Route::get('/galeri',[GaleriController::class,'index'])->name('galeri')->middleware('auth');

Route::get('/tambah',[GaleriController::class,'tambah'])->name('tambahGambar')->middleware('auth');

Route::get('/sejarah', function(){
    return view('admin.sejarahDesa.sejarah');
})->name('sejarah_desa')->middleware('auth');

Route::get('/sejarah/tambah', function(){
    return view('admin.sejarahDesa.tambah');
})->name('tambah')->middleware('auth');

Route::get('/sejarah/detail', function(){
    return view('admin.sejarahDesa.sejarahDetail');
})->name('sejarah_detail')->middleware('auth');

// Route::get('/pemerintah-index', [PemerintahController::class, 'indexx'])
//     ->middleware('auth')
//     ->name('pemerintah-index');


Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/data.penduduk-index', [DatapendudukController::class, 'index'])->name('data.penduduk-index');
        Route::get('/data.penduduk-create', [DatapendudukController::class, 'create'])->name('data.penduduk-create');
        Route::post('/data.penduduk-store', [DatapendudukController::class, 'store'])->name('data.penduduk-store');
        Route::get('/data.penduduk-show/{id}', [DatapendudukController::class, 'show'])->name('data.penduduk-show');
        Route::get('/data.penduduk-edit/{id}', [DatapendudukController::class, 'edit'])->name('data.penduduk-edit');
        Route::put('/data.penduduk-update/{id}', [DatapendudukController::class, 'update'])->name('data.penduduk-update');
        Route::get('/data.penduduk-destroy/{id}', [DatapendudukController::class, 'destroy'])->name('data.penduduk-destroy');
        Route::get('/data.penduduk-search', [DatapendudukController::class, 'search'])->name('data.penduduk-search');

        Route::get('/surat-index', [SuratController::class, 'index'])->name('surat.index');
        Route::get('/surat-create', [SuratController::class, 'create'])->name('surat.create');
        Route::post('/surat-store', [SuratController::class, 'store'])->name('surat.store');
        Route::get('/surat-show/{id}', [SuratController::class, 'show'])->name('surat.show');
        Route::get('/surat-edit/{id}', [SuratController::class, 'edit'])->name('surat.edit');
        Route::put('/surat-update/{id}', [SuratController::class, 'update'])->name('surat.update');
        Route::get('/surat-destroy/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');
        Route::get('/search', [SuratController::class, 'search'])->name('surat.search');

        Route::get('/suratdomisili-index', [SuratDomisiliController::class, 'index'])->name('suratdomisili.index');
        Route::get('/suratdomisili-create', [SuratDomisiliController::class, 'create'])->name('suratdomisili.create');
        Route::post('/suratdomisili-store', [SuratDomisiliController::class, 'store'])->name('suratdomisili.store');
        Route::get('/suratdomisili-show/{id}', [SuratDomisiliController::class, 'show'])->name('suratdomisili.show');
        Route::get('/suratdomisili-edit/{id}', [SuratDomisiliController::class, 'edit'])->name('suratdomisili.edit');
        Route::put('/suratdomisili-update/{id}', [SuratDomisiliController::class, 'update'])->name('suratdomisili.update');
        Route::get('/suratdomisili-destroy/{id}', [SuratDomisiliController::class, 'destroy'])->name('suratdomisili.destroy');
        Route::get('/search', [SuratDomisiliController::class, 'search'])->name('surat.search');
   

        Route::get('/suratpengantar-index', [SuratPengantarController::class, 'index'])->name('suratpengantar.index');
        Route::get('/suratpengantar-create', [SuratPengantarController::class, 'create'])->name('suratpengantar.create');
        Route::post('/suratpengantar-store', [SuratPengantarController::class, 'store'])->name('suratpengantar.store');
        Route::get('/suratpengantar-show/{id}', [SuratPengantarController::class, 'show'])->name('suratpengantar.show');
        Route::get('/suratpengantar-edit/{id}', [SuratPengantarController::class, 'edit'])->name('suratpengantar.edit');
        Route::put('/suratpengantar-update/{id}', [SuratPengantarController::class, 'update'])->name('suratpengantar.update');
        Route::get('/suratpengantar-destroy/{id}', [SuratPengantarController::class, 'destroy'])->name('suratpengantar.destroy');
        Route::get('/suratpengantar-search', [SuratPengantarController::class, 'search'])->name('suratpengantar.search');

        Route::get('/surat-keterangan-usaha', [SuratKetusController::class, 'index'])->name('suratketus.index');
        Route::get('/surat-keterangan-usaha/create', [SuratKetusController::class, 'create'])->name('suratketus.create');
        Route::post('/surat-keterangan-usaha/store', [SuratKetusController::class, 'store'])->name('suratketus.store');
        Route::get('/surat-keterangan-usaha/{id}', [SuratKetusController::class, 'show'])->name('suratketus.show');
        Route::get('/surat-keterangan-usaha/{id}/edit', [SuratKetusController::class, 'edit'])->name('suratketus.edit');
        Route::put('/surat-keterangan-usaha/{id}', [SuratKetusController::class, 'update'])->name('suratketus.update');
        Route::delete('/surat-keterangan-usaha/{id}', [SuratKetusController::class, 'destroy'])->name('suratketus.destroy');
        Route::get('/surat-keterangan-usaha-search', [SuratKetusController::class, 'search'])->name('suratketus.search');

        Route::get('/suratizin', [SuratIzinController::class, 'index'])->name('suratizin.index');
        Route::get('/suratizin/create', [SuratIzinController::class, 'create'])->name('suratizin.create');
        Route::post('/suratizin', [SuratIzinController::class, 'store'])->name('suratizin.store');
        Route::get('/suratizin/{id}', [SuratIzinController::class, 'show'])->name('suratizin.show');
        Route::get('/suratizin/{id}/edit', [SuratIzinController::class, 'edit'])->name('suratizin.edit');
        Route::put('/suratizin/{id}', [SuratIzinController::class, 'update'])->name('suratizin.update');
        Route::delete('/suratizin/{id}', [SuratIzinController::class, 'destroy'])->name('suratizin.destroy');
        Route::get('/suratizin-search', [SuratIzinController::class, 'search'])->name('suratizin.search');
            });
 });
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
