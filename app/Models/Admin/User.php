<?php

namespace App\Models\Admin;

use App\Models\Dosen\LaporanPKM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Dosen\ProposalPKM;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
    */
    protected $fillable = [
        'nidn',
        'nama',
        'golongan',
        'program_studi',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
    */
    protected $hidden = [
        'password',
    ];

    public function proposals()
    {
        return $this->hasMany(ProposalPkm::class);
    }

    public function laporansPKM()
    {
        return $this->hasMany(LaporanPKM::class);
    }
}
