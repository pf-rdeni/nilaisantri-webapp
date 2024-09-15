<?php
namespace App\Models;

use CodeIgniter\Model;

class GuruKelasModel extends Model
{
    protected $table = 'tbl_guru_kelas';
    protected $primaryKey = 'Id';
    protected $allowedFields = ['IdTpq', 'IdKelas', 'IdGuru', 'IdTahunAjaran', 'IdJabatan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    
}
