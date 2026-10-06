<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChannelController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

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
    return redirect(route('login'));
});

Broadcast::routes(['middleware' => ['auth']]);
// AUTHENTICATION
// proses login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// proses register
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store']);
// lengkapi data
Route::get('/lengkapi-data', [AuthController::class, 'lengkapiData'])->name('lengkapi.data')->middleware('auth');
Route::post('/lengkapi-data', [AuthController::class, 'simpanData'])->name('lengkapi.data.simpan')->middleware('auth');
Route::get('/edit-biodata', [AuthController::class, 'editDataDiri'])->name('edit.biodata')->middleware('auth', 'mahasiswa');
//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/get-desas/{kecamatan_id}', [AuthController::class, 'getDesa']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth', 'mahasiswa')->name('dashboard.index');

// Forum
Route::middleware(['auth', 'mahasiswa'])->prefix('dashboard')->group(function () {
    Route::get('/forum', [ChannelController::class, 'index'])->name('forum.index');
    Route::get('/forum/{id}', [ChannelController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/send', [ChannelController::class, 'send'])->name('forum.send');
    Route::get('/forum/file/preview/{filename}', [ChannelController::class, 'previewFile'])
        ->name('forum.file.preview')
        ->where('filename', '.*');
    //Tambahkan endpoint ini untuk lazy loading chat
    Route::get('/forum/{id}/messages', [ChannelController::class, 'loadMessages'])
        ->name('forum.load.messages');
});

// Admin area
Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index', [
            'title' => 'Dashboard Admin',
        ]);
    })->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    //Master Data
    Route::resource('bidang', App\Http\Controllers\Admin\BidangController::class);
    Route::resource('perguruan', App\Http\Controllers\Admin\PerguruanController::class);
    Route::resource('kotaperguruan', App\Http\Controllers\Admin\KotaPerguruanController::class);
    Route::resource('kecamatan', App\Http\Controllers\Admin\KecamatanController::class);
    Route::resource('desa', App\Http\Controllers\Admin\DesaController::class);
    Route::resource('channel', App\Http\Controllers\Admin\ChannelController::class);
    // Data User Admin & Mahasiswa
    Route::get('/useradmin', [UserController::class, 'indexAdmin'])->name('user.admin.index');
    Route::get('/usermhs', [UserController::class, 'indexMahasiswa'])->name('user.mhs.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/get-desas/{kecamatan_id}', [UserController::class, 'getDesa'])->name('user.getDesa');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});
