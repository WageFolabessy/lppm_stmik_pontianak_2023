<?php

namespace App\Models\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin\User;


class LaporanPKM extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'laporan_pkm';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
