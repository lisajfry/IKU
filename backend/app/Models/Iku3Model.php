<?php

namespace App\Models;

use CodeIgniter\Model;

class Iku3Model extends Model
{
    protected $table            = 'iku3';
    protected $primaryKey       = 'iku3_id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['NIDN', 'aktivitas_dosen', 'mahasiswa_bimbingan'];

    protected $validationRules = [
        'aktivitas_dosen' => 'in_list[Bertridharma dikampus lain,Bekerja sebagai praktisi,Membimbing mahasiswa berprestasi]',
        'mahasiswa_bimbingan' => 'permit_empty', // Allow empty value
    ];
}
