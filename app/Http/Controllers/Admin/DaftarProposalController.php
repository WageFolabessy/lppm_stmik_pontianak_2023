<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Dosen\ProposalPKM;
use PhpOffice\PhpWord\TemplateProcessor;

class DaftarProposalController extends Controller
{
    public function index()
    {
        if (Auth::user()->is_admin) {
            // Jika pengguna saat ini adalah admin, tampilkan proposal yang belum dihapus atau yang dihapus oleh dosen
            $data = ProposalPKM::withTrashed()->where(function ($query) {
                $query->where('deleted_by', '!=', Auth::id())
                    ->orWhereNull('deleted_by');
            })->with('pesertaKegiatans', 'user')->orderBy('updated_at', 'desc')->get();
        } else {
            // Jika pengguna saat ini adalah dosen, hanya tampilkan proposal yang belum dihapus
            $data = ProposalPKM::where('deleted_by', '!=', Auth::id())
                ->with('pesertaKegiatans', 'user')
                ->orderBy('updated_at', 'desc')->get();
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($data) {
                return $data->user->nama;
            })
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
                    return '<span id="komentar-' . $data->id . '">Belum Ada Komentar</span>';
                } else {
                    return '<span id="komentar-' . $data->id . '">' . $data->komentar . '</span>';
                }
            })
            ->addColumn('aksi', function ($data) {
                return view('admin.components.tombol-aksi-proposal-pkm')->with('data', $data);
            })
            ->setRowId(function ($data) {
                return 'row-' . $data->id;
            })
            ->rawColumns(['peserta_kegiatan', 'status', 'komentar', 'aksi'])
            ->make(true);
    }

    public function detail($id)
    {
        $data = ProposalPKM::with('pesertaKegiatans', 'user')->find($id);
        return response()->json($data);
    }

    public function terimaProposal($id)
    {
        $proposal = ProposalPKM::find($id);
        $proposal->status = 'Disetujui';
        $proposal->save();

        $proposal->user->notify(new \App\Notifications\StatusPkmProposal($proposal));

        return response()->json(['message' => 'Proposal telah disetujui.']);
    }

    public function tolakProposal($id)
    {
        $proposal = ProposalPKM::find($id);
        $proposal->status = 'Ditolak';
        $proposal->save();
        $proposal->user->notify(new \App\Notifications\StatusPkmProposal($proposal));

        return response()->json(['message' => 'Proposal telah ditolak.']);
    }

    public function tambahKomentar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'komentar' => 'required'
        ], [
            'komentar.required' => 'Komentar harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $proposal = ProposalPKM::find($id);
        $proposal->komentar = $request->komentar;
        $proposal->save();
        $proposal->user->notify(new \App\Notifications\KomentarPkmProposal($proposal));
        return response()->json(['success' => 'Komentar berhasil ditambahkan.']);
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
