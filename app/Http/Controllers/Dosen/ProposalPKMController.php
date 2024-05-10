<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\User;
use App\Models\Dosen\ProposalPKM;
use App\Models\Dosen\PesertaKegiatan;

class ProposalPKMController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        return view('dosen.pengajuan-proposal', compact('user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'media' => 'required',
            'jenis_kegiatan' => 'required|in:Workshop,Pelatihan',
        ], [
            'judul.required' => 'Judul harus diisi',
            'lokasi.required' => 'Lokasi harus diisi',
            'tanggal.required' => 'Tanggal harus diisi',
            'jam.required' => 'Jam harus diisi',
            'media.required' => 'Media harus diisi',
            'jenis_kegiatan.required' => 'Jenis Kegiatan harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $proposal = new ProposalPkm;
        $proposal->judul = $request->judul;
        $proposal->lokasi = $request->lokasi;
        $proposal->tanggal = $request->tanggal;
        $proposal->jam = $request->jam;
        $proposal->media = $request->media;
        $proposal->jenis_kegiatan = $request->jenis_kegiatan;
        $proposal->user_id = auth()->user()->id;
        $proposal->save();

        $admins = User::where('is_admin', true)->get();
        $admins->each(function ($admin) use ($proposal) {
            $admin->notify(new \App\Notifications\NewPkmProposal($proposal));
        });

        if ($request->has('peserta')) {
            foreach ($request->peserta as $peserta) {
                $pesertaKegiatan = new PesertaKegiatan;
                $pesertaKegiatan->nim = $peserta['nim'];
                $pesertaKegiatan->nama_peserta = $peserta['nama'];
                $pesertaKegiatan->program_studi = $peserta['prodi'];
                $pesertaKegiatan->peminatan = $peserta['peminatan'];
                $pesertaKegiatan->proposal_pkm_id = $proposal->id;
                $pesertaKegiatan->save();
            }
            return response()->json(['message' => 'Proposal PKM dan peserta kegiatan berhasil disimpan.']);
        }
        return response()->json(['message' => 'Proposal PKM berhasil disimpan.']);
    }
}
