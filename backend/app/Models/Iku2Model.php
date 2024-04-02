<?php

namespace App\Models;

use CodeIgniter\Model;

class Iku2Model extends Model
{
    protected $table            = 'iku2';
    protected $primaryKey       = 'iku2_id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['NIM', 'aktivitas', 'sks', 'prestasi', 'tingkat_lomba', 'dosen_pembimbing'];

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
