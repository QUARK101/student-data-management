<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'program_studi_id',
        'nama',
        'nim',
        'email',
        'no_hp',
        'angkatan',
        'status',
        'alamat',
    ];

    protected $casts = [
        'angkatan' => 'integer',
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'Aktif'  => 'success',
            'Cuti'   => 'warning',
            'Lulus'  => 'primary',
            'Keluar' => 'danger',
            default  => 'secondary',
        };
    }
}
