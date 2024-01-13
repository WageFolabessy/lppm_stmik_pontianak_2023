<?php

namespace App\Models\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaKegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama_peserta',
        'program_studi',
        'peminatan',
    ];

    public function proposalPkm()
    {
        return $this->belongsTo(ProposalPKM::class, 'proposal_pkm_id');
    }
}
