<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DataDosenController;
use App\Http\Controllers\Admin\DaftarProposalController;
use App\Http\Controllers\Dosen\ProfilDosenController;
use App\Http\Controllers\Dosen\ProposalPKMController;
use App\Http\Controllers\Dosen\ProposalSayaController;
use App\Http\Controllers\AuthController;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/notif/read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('notif.read')->middleware('auth');


// Rute untuk Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('', function () {
            return view('admin.profil-lppm');
        })->name('admin.profil-lppm');

        Route::get('/data_dosen', function () {
            return view('admin.data-dosen');
        })->name('admin.data-dosen');

        Route::get('/data_proposal_pkm', function () {
            return view('admin.daftar-proposal-pkm');
        })->name('admin.daftar-proposal-pkm');
    });
    
    Route::controller(DataDosenController::class)->group(function () {
        Route::get('/dosen/datatables',  'index');
        Route::post('/dosen/tambah_dosen', 'store');
        Route::delete('/dosen/hapus_dosen/{id}', 'destroy');
    });

    Route::controller(DaftarProposalController::class)->group(function () {
        Route::get('/daftar_proposal_pkm/datatables',  'index');
        Route::get('/daftar_proposal_pkm/detail/{id}',  'detail');
        Route::post('/daftar_proposal_pkm/terima_proposal/{id}',  'terimaProposal');
        Route::post('/daftar_proposal_pkm/tolak_proposal/{id}',  'tolakProposal');
        Route::post('/daftar_proposal_pkm/tambah_komentar/{id}',  'tambahKomentar');
        Route::delete('/daftar_proposal_pkm/hapus_proposal/{id}',  'destroy');
    });
});

// Rute untuk Dosen
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('', function () {
        return view('dosen.profil-lppm');
    })->name('dosen.profil-lppm');

    Route::controller(ProfilDosenController::class)->group(function () {
        Route::get('/profil', 'index')->name('dosen.profil-dosen');
        Route::post('/profil/updateProfil', 'update_profil');
        Route::post('/profil/updatePassword', 'update_password');
    });

    Route::controller(ProposalPKMController::class)->group(function () {
        Route::get('/pengajuan_proposal', 'index')->name('dosen.pengajuan-proposal');
        Route::post('/pengajuan_proposal/tambah_proposal', 'store');
    });

    Route::get('/proposal_saya', function () {
        return view('dosen.proposal-saya');
    })->name('dosen.proposal-saya');

    Route::controller(ProposalSayaController::class)->group(function () {
        Route::get('/proposal_saya/datatables', 'index');
        Route::get('/proposal_saya/edit_proposal_pkm/{id}', 'edit');
        Route::post('/proposal_saya/update_proposal_pkm/{id}', 'update');
        Route::delete('/proposal_saya/hapus_proposal/{id}', 'destroy');
    });
});
