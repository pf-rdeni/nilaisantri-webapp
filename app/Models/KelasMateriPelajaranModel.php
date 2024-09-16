<?php

namespace App\Models;
use CodeIgniter\Model;

class KelasMateriPelajaranModel extends Model
{
    protected $table = 'tbl_kelas_materi_pelajaran';
    protected $primaryKey = 'Id';
    protected $allowedFields = [
        'IdKelas',
        'IdTpq',
        'IdTahunAjaran',
        'IdMateri',
        'Semester',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
