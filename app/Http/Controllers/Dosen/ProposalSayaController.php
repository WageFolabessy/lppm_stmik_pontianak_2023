<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin\User;
use App\Models\Dosen\ProposalPKM;
use App\Models\Dosen\PesertaKegiatan;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class ProposalSayaController extends Controller
{
    public function index()
    {
        if (Auth::user()->is_admin) {
            // Jika pengguna saat ini adalah admin, tampilkan semua proposal (termasuk yang dihapus oleh dosen)
            $data = ProposalPKM::withTrashed()->with('pesertaKegiatans')
                ->where('user_id', Auth::id())
                ->orderBy('updated_at', 'desc')->get();
        } else {
            // Jika pengguna saat ini adalah dosen, tampilkan proposal yang belum dihapus atau yang dihapus oleh admin
            $data = ProposalPKM::withTrashed()->where(function ($query) {
                $query->where('deleted_by', '!=', Auth::id())
                      ->orWhereNull('deleted_by');
            })->with('pesertaKegiatans')->where('user_id', Auth::id())
                ->orderBy('updated_at', 'desc')->get();
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('peserta_kegiatan', function ($data) {
                if ($data->pesertaKegiatans->isEmpty()) {
                    return 'Tidak Ada Peserta Kegiatan';
                } else {
                    $peserta = '';
                    foreach ($data->pesertaKegiatans as $p) {
                        $peserta .= '<li>' . $p->nama_peserta . '</li>';
                    }
                    return '<ul>' . $peserta . '</ul>';
                }
            })
            ->addColumn('status', function ($data) {
                if ($data->status == "Disetujui") {
                    return "<span class='bg-success p-2'>" . $data->status . "</span>";
                } elseif ($data->status == "Ditolak") {
                    return "<span class='bg-danger p-2'>" . $data->status . "</span>";
                }
                return $data->status;
            })
            ->addColumn('komentar', function ($data) {
                if ($data->komentar == null) {
                    return 'Belum Ada Komentar';
                } else {
                    return $data->komentar;
                }
            })
            ->addColumn('aksi', function ($data) {
                return view('dosen.components.tombol-aksi')->with('data', $data);
            })
            ->rawColumns(['peserta_kegiatan', 'status', 'aksi'])
            ->make(true);
    }

    public function edit($id)
    {
        $data = ProposalPKM::with('pesertaKegiatans')->find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
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

        $proposal = ProposalPKM::find($id);

        // Update proposal
        $proposal->judul = $request->judul;
        $proposal->lokasi = $request->lokasi;
        $proposal->tanggal = $request->tanggal;
        $proposal->jam = $request->jam;
        $proposal->media = $request->media;
        $proposal->jenis_kegiatan = $request->jenis_kegiatan;
        $proposal->save();

        $admins = User::where('is_admin', true)->get();
        $admins->each(function ($admin) use ($proposal) {
            $admin->notify(new \App\Notifications\UpdatedPkmProposal($proposal));
        });

        // Delete existing peserta kegiatan
        PesertaKegiatan::where('proposal_pkm_id', $id)->delete();

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
            return response()->json(['message' => 'Proposal PKM dan peserta kegiatan berhasil diperbaharui.']);
        }
        return response()->json(['message' => 'Proposal PKM berhasil diperbaharui.']);
    }

    public function destroy($id)
    {
        $proposal = ProposalPKM::withTrashed()->find($id);

        if ($proposal->trashed()) {
            // Jika proposal sudah dihapus (soft delete), maka hapus permanen
            $proposal->forceDelete();
        } else {
            // Jika proposal belum dihapus, lakukan soft delete dan tetapkan 'deleted_by'
            $proposal->deleted_by = Auth::id();
            $proposal->save();
            $proposal->delete();
        }

        return response()->json([
            'success' => 'Proposal PKM berhasil dihapus'
        ]);
    }

    public function toWord($id)
    {
        $proposal = ProposalPKM::find($id);

        $templatePath = storage_path('app/public/file/Proposal_PKM TERBARU.docx');
        $template = new TemplateProcessor($templatePath);
        $template->setValues([
            "nidn_dosen" => $proposal->user->nidn,
            "nama_dosen" => $proposal->user->nama,
            "golongan_dosen" => $proposal->user->golongan,
            "prodi_dosen" => $proposal->user->program_studi,
            "judul" => $proposal->judul,
            "lokasi" => $proposal->lokasi,
            "tanggal" => $proposal->tanggal,
            "jam" => $proposal->jam,
            "jenis_kegiatan" => $proposal->jenis_kegiatan,
            "media" => $proposal->media,
        ]);

        $pesertaKegiatans = $proposal->pesertaKegiatans()->get();
        $pesertas = [];
        foreach ($pesertaKegiatans as $peserta) {
            $pesertas[] = [
                "nama_mahasiswa" => $peserta->nama_peserta,
                "nim_mahasiswa" => $peserta->nim,
                "prodi_mahasiswa" => $peserta->program_studi,
                "peminatan_mahasiswa" => $peserta->peminatan
            ];
        }
        $template->cloneRowAndSetValues('nama_mahasiswa', $pesertas);

        $namaFile = $proposal->judul . ".docx";
        $template->saveAs($namaFile);

        return response()->download(
            $namaFile,
            $namaFile,
            ['Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
        )->deleteFileAfterSend(true);
    }
}
