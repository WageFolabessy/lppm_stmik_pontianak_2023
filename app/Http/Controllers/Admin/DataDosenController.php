<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\User;

class DataDosenController extends Controller
{
    public function index()
    {
        $data = User::where('is_admin', false)->orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return view('admin.components.tombol-aksi-dosen')->with('data', $data);
            })->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nidn' => 'required|max:12|unique:users,nidn,',
            'nama' => 'required',
            'golongan' =>
            'required|in:Asisten Ahli (III/A),Asisten Ahli (III/B),Lektor,Lektor Kepala (IV/C),dll,Tidak Ada Golongan',

            'program_studi' => 'required|in:Teknik Informatika,Sistem Informasi',
            'password' => 'required|min:8',
        ], [
            'nidn.required' => 'NIDN harus diisi',
            'nama.required' => 'Nama harus diisi',
            'golongan.required' => 'Golongan harus diisi',
            'program_studi.required' => 'Program Studi harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password harus memiliki minimal 8 karakter'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $dosen = new User;
        $dosen->nidn = $request->nidn;
        $dosen->nama = $request->nama;
        $dosen->golongan = $request->golongan;
        $dosen->program_studi = $request->program_studi;
        $dosen->password = Hash::make($request->password);
        $dosen->save();

        return response()->json(['success' => 'Dosen berhasil ditambahkan.']);
    }

    public function destroy($id)
    {
        $dosen = User::find($id);
        $dosen->delete();

        return response()->json([
            'success' => 'Dosen berhasil dihapus'
        ]);
    }
}
