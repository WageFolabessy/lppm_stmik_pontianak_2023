<?php

namespace App\Models\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin\User;

class ProposalPKM extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'judul',
        'lokasi',
        'tanggal',
        'jam',
        'media',
        'status',
        'komentar',
    ];

    protected $table = 'proposal_pkm';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesertaKegiatans()
    {
        return $this->hasMany(PesertaKegiatan::class, 'proposal_pkm_id');
    }
}
