<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Dosen\LaporanPKM;
use App\Models\Admin\User;


class LaporanPKMController extends Controller
{
    public function index()
    {
        $data = LaporanPKM::orderBy('updated_at', 'desc')->where('user_id', Auth::id())->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return view('dosen.components.tombol-aksi-laporan-pkm')->with('data', $data);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_pkm' => 'required',
            'file_laporan' => 'required|file|max:20480',
        ], [
            'judul_pkm.required' => 'Judul PKM harus diisi',
            'file_laporan.required' => 'File laporan harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        
        if ($request->has('file_laporan')) {
            $fileLaporan = $request->file('file_laporan');
            $namaFile = $fileLaporan->getClientOriginalName();

            $path = $request->file('file_laporan')->storeAs('file_laporan_pkm', $namaFile);

            $laporanPKM = new LaporanPKM;
            $laporanPKM->judul_pkm = $request->judul_pkm;
            $laporanPKM->file_laporan = $path;
            $laporanPKM->user_id = auth()->user()->id;
            $laporanPKM->save();
            $admins = User::where('is_admin', true)->get();
            $admins->each(function ($admin) use ($laporanPKM) {
            $admin->notify(new \App\Notifications\NewLaporanPKM($laporanPKM));
        });
        } else {
            return response()->json(['error' => 'File laporan harus diisi'], 422);
        }

        return response()->json(['status' => 'success', 'message' => 'Laporan PKM berhasil diunggah']);
    }

    public function destroy($id)
    {
        $laporanPKM = LaporanPKM::withTrashed()->find($id);

        if ($laporanPKM->trashed()) {
            // Jika laporanPKM sudah dihapus (soft delete), maka hapus permanen
            $laporanPKM->forceDelete();
        } else {
            // Jika laporanPKM belum dihapus, lakukan soft delete dan tetapkan 'deleted_by'
            $laporanPKM->deleted_by = Auth::id();
            $laporanPKM->save();
            $laporanPKM->delete();
        }

        return response()->json([
            'success' => 'Laporan PKM berhasil dihapus'
        ]);
    }
}
