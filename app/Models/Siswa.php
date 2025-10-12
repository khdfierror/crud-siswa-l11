<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nama_orang_tua',
        'telepon',
        'email',
        'kelas',
        'foto',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
