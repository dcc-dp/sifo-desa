<?php


use App\Http\Controllers\Admin\SejarahController as AdminSejarahController;
use App\Http\Controllers\CekNikController;
use App\Http\Controllers\PengaduanAuth;
use App\Http\Controllers\PengajuanSuratAuth;
use App\Http\Controllers\PengajuanSuratController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RtController;
use App\Http\Controllers\Admin\RwController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserGaleriController;
use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\SuratIzinController;
use App\Http\Controllers\Admin\PemerintahController;
use App\Http\Controllers\Admin\SuratKetusController;
use App\Http\Controllers\Admin\BatchGaleriController;
use App\Http\Controllers\Admin\DatapendudukController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\SuratDomisiliController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\SuratPengantarController;
use App\Http\Controllers\CekNikController as ControllersCekNikController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\UserLoginController;

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

// Route::get('/', function () {
//     return redirect('/dashboard');
// })->middleware('auth');

// Route::get('/', function () {
//     return view('pages.home', [
//         'title' => 'Beranda Desa'
//     ]);
// })->name('home');

Route::get('/galeri', [UserGaleriController::class, 'index'])->name('user.galeri');
Route::get('/galeri/{batch}', [UserGaleriController::class, 'show'])->name('user.galeri.show');

Route::get('/galeri-user', function () {
    return view('pages.profildesa.galeri');
})->name('galeri');



Route::get('/', [UserController::class, 'home'])->name('home');

Route::get('/pemerintah', [UserController::class, 'pemerintah'])->name('pemerintah');
Route::get('/pemerintah/{id}', [UserController::class, 'show'])->name('pemerintah-detail');

// Route::get('/berita', [UserController::class, 'berita'])->name('berita');

Route::get('/sejarah', [UserController::class, 'sejarah'])->name('sejarah');

Route::get('/kategori', [UserController::class, 'kategori'])->name('kategori');
Route::get('/kategori/{slug}', [UserController::class, 'showKategori'])->name('show-kategori');
Route::get('/berita/{slug}', [UserController::class, 'detailBerita'])->name('detail-berita');

Route::get('/agenda', [UserController::class, 'agenda'])->name('agenda');

Route::get('/statistik-penduduk', [StatistikController::class, 'statistikPenduduk'])->name('user.statistik.penduduk');
Route::get('/statistik-agama', [StatistikController::class, 'statistikAgama'])->name('user.statistik.agama');
Route::get('/statistik-pekerjaan', [StatistikController::class, 'statistikPekerjaan'])->name('user.statistik.pekerjaan');
Route::get('/statistik-pendidikan', [StatistikController::class, 'statistikPendidikan'])->name('user.statistik.pendidikan');


// Route::get('/pendidikan', function () {
//     return view('pages.datastatik.pendidikan');
// })->name('pendidikan');

// Route::get('/pekerjaan', function () {
//     return view('pages.datastatik.pekerjaan');
// })->name('pekerjaan');

// Route::get('/agama', function () {
//     return view('pages.datastatik.agama');
// })->name('agama');

Route::post('/pengaduan/storeLanding', [PengaduanController::class, 'storeLanding'])->name('pengaduan.storeLanding');
Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan-store');

// Pengaduan authentication routes
Route::get('/pengaduan-login', [PengaduanAuth::class, 'showLoginForm'])->name('pengaduan.login-form');
Route::post('/pengaduan-login', [PengaduanAuth::class, 'login'])->name('pengaduan.login');

// Protected pengaduan route
Route::get('/pengaduan', [PengaduanController::class, 'create'])->middleware('pengaduan.auth')->name('pengaduan');
Route::get('/pengaduan-logout', [PengaduanAuth::class, 'logout'])->name('pengaduan.logout');

// Pengajuan Surat authentication routes
Route::get('/pengajuan-login', [PengajuanSuratAuth::class, 'showLoginForm'])->name('pengajuan.login-form');
Route::post('/pengajuan-login', [PengajuanSuratAuth::class, 'login'])->name('pengajuan.login');

// Protected pengajuan route
Route::get('/pengajuan', function () {
    return view('pages.layananonline.pengajuan');
})->middleware('pengajuan.auth')->name('pengajuan');
Route::post('/pengajuan/store', [PengajuanSuratController::class, 'store'])->middleware('pengajuan.auth')->name('pengajuan.store');
Route::get('/pengajuan-logout', [PengajuanSuratAuth::class, 'logout'])->name('pengajuan.logout');




Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('admin')->group(function () {
        Route::get('/pemerintah-index', [PemerintahController::class, 'index'])->name('pemerintah-index');
        Route::get('/pemerintah-create', [PemerintahController::class, 'create'])->name('pemerintah-create');
        Route::post('/pemerintah-store', [PemerintahController::class, 'store'])->name('pemerintah-store');
        Route::get('/pemerintah-edit/{id}', [PemerintahController::class, 'edit'])->name('pemerintah-edit');
        Route::put('/pemerintah-update/{id}', [PemerintahController::class, 'update'])->name('pemerintah-update');
        Route::get('/pemerintah-destroy/{id}', [PemerintahController::class, 'destroy'])->name('pemerintah-destroy');

        Route::get('/sejarah-index', [SejarahController::class, 'index'])->name('sejarah-index');
        Route::get('/sejarah-create', [SejarahController::class, 'create'])->name('sejarah-create');
        Route::post('/sejarah-store', [SejarahController::class, 'store'])->name('sejarah-store');
        Route::get('/sejarah-edit/{id}', [SejarahController::class, 'edit'])->name('sejarah-edit');
        Route::put('/sejarah-update/{id}', [SejarahController::class, 'update'])->name('sejarah-update');
        Route::get('/sejarah-destroy/{id}', [SejarahController::class, 'destroy'])->name('sejarah-destroy');

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

        Route::get('/pengaduan-index', [PengaduanController::class, 'index'])->name('pengaduan-index');
        Route::get('/pengaduan-create', [PengaduanController::class, 'create'])->name('pengaduan-create');
        Route::post('/pengaduan-store', [PengaduanController::class, 'store'])->name('pengaduan-store');
        Route::get('/pengaduan-edit/{id}', [PengaduanController::class, 'edit'])->name('pengaduan-edit');
        Route::put('/pengaduan-update/{id}', [PengaduanController::class, 'update'])->name('pengaduan-update');
        Route::get('/pengaduan-destroy/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan-destroy');

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

        Route::get('/galeri/{id}/create', [GaleriController::class, 'create'])->name('galeri.create');
        Route::post('/galeri/{id}/store',  [GaleriController::class, 'store'])->name('galeri.store');
        Route::delete('/galeri/{id}',      [GaleriController::class, 'destroy'])->name('galeri.destroy');

        Route::get('/batchgaleri', [BatchGaleriController::class, 'index'])->name('batchgaleri.index');
        Route::get('/batchgaleri/create', [BatchGaleriController::class, 'create'])->name('batchgaleri.create');
        Route::post('/batchgaleri/store', [BatchGaleriController::class, 'store'])->name('batchgaleri.store');

        Route::get('/batchgaleri/{id}/edit', [BatchGaleriController::class, 'edit'])->name('batchgaleri.edit');
        Route::put('/batchgaleri/{id}', [BatchGaleriController::class, 'update'])->name('batchgaleri.update');
        Route::get('/batchgaleri/{id}', [BatchGaleriController::class, 'show'])->name('batchgaleri.show');
        Route::delete('/batchgaleri/{id}', [BatchGaleriController::class, 'destroy'])->name('batchgaleri.destroy');

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


        Route::get('/rw-index', [RwController::class, 'index'])->name('rw-index');
        Route::get('/rw-create', [RwController::class, 'create'])->name('rw-create');
        Route::post('/rw-store', [RwController::class, 'store'])->name('rw-store');
        Route::get('/rw-edit/{id}', [RwController::class, 'edit'])->name('rw-edit');
        Route::put('/rw-update/{id}', [RwController::class, 'update'])->name('rw-update');
        Route::get('/rw-destroy/{id}', [RwController::class, 'destroy'])->name('rw-destroy');

        Route::get('/rt-index', [RtController::class, 'index'])->name('rt-index');
        Route::get('/rt-create', [RtController::class, 'create'])->name('rt-create');
        Route::post('/rt-store', [RtController::class, 'store'])->name('rt-store');
        Route::get('/rt-edit/{id}', [RtController::class, 'edit'])->name('rt-edit');
        Route::put('/rt-update/{id}', [RtController::class, 'update'])->name('rt-update');
        Route::get('/rt-destroy/{id}', [RtController::class, 'destroy'])->name('rt-destroy');
    });
});

// Route::get('/tes', function () {
//     return view('admin.pemerintah.tes');
// })->name('tes');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard')->middleware('auth');


// Route::get('/galeri', function(){
//     return view('admin.galeri.galeri');
// })->name('galeri')->middleware('auth');



Route::get('/sejarah', function () {
    return view('admin.sejarahDesa.sejarah');
})->name('sejarah_desa')->middleware('auth');

Route::get('/sejarah/tambah', function () {
    return view('admin.sejarahDesa.tambah');
})->name('tambah')->middleware('auth');

Route::get('/sejarah/detail', function () {
    return view('admin.sejarahDesa.sejarahDetail');
})->name('sejarah_detail')->middleware('auth');

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

// Route::get('/signin', function () {
//     return view('account-pages.signin');
// })->name('signin');

Route::get('/ceknik', [CekNikController::class, 'index'])->name('ceknik');
Route::post('/ceknik', [CekNikController::class, 'store'])->name('ceknik.store');

Route::middleware('guest')->group(function () {
    Route::get('/user/login', [UserLoginController::class, 'userindex'])->name('userlogin');
    Route::post('/user/login', [UserLoginController::class, 'userlogin'])->name('userlogin.post');
   
});
 Route::post('/user/logout', [UserLoginController::class, 'userlogout'])->name('userlogout');

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