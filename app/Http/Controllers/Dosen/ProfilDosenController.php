<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\User;

class ProfilDosenController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        return view('dosen.profil-dosen', compact('user'));
    }

    public function update_profil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nidn' => 'required|max:12|unique:users,nidn,' . Auth::id(),
            'nama' => 'required',
            'golongan' =>
            'required|in:Asisten Ahli (III/A),Asisten Ahli (III/B),Lektor,Lektor Kepala (IV/C),dll,Tidak Ada Golongan',
            
            'program_studi' => 'required|in:Teknik Informatika,Sistem Informasi',
        ], [
            'nidn.required' => 'NIDN harus diisi',
            'nama.required' => 'Nama harus diisi',
            'golongan.required' => 'Golongan harus diisi',
            'program_studi.required' => 'Program Studi harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::find(Auth::id());
        $user->update($request->all());

        return response()->json(['success' => 'Profil berhasil diupdate'], 200);
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
        ], [
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password harus memiliki minimal 8 karakter'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['success' => 'Password berhasil diupdate'], 200);
    }
}
