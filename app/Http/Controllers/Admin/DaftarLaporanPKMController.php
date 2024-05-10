<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Dosen\laporanPKM;
use Illuminate\Http\Request;

class DaftarLaporanPKMController extends Controller
{
    public function index()
    {
        $data = laporanPKM::with('user')->orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($data) {
                return $data->user->nama;
            })
            ->addColumn('aksi', function ($data) {
                return view('admin.components.tombol-aksi-unduh-laporan-pkm')->with('data', $data);
            })
            ->setRowId(function ($data) {
                return 'row-' . $data->id;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function unduhLaporanPKM($id)
    {
        $data = laporanPKM::findOrFail($id);
        $filePath = storage_path('app/' .$data->file_laporan);
        $fileName = basename($filePath);

        return response()->download(
            $filePath,
            $fileName,
            ['Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
        )->deleteFileAfterSend(true);
    }
}
