<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriPelajaranModel extends Model
{
    protected $table = 'tbl_materi_pelajaran';
    protected $primaryKey = 'Id';
    protected $allowedFields = ['IdMateri', 'NamaMateri', 'Kategori'];
    protected $useTimestamps = true; // To automatically handle created_at and updated_at fields
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
