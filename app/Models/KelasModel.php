<?php

namespace App\Models;
use CodeIgniter\Model;

class KelasModel extends Model
{
    // Define the table name
    protected $table = 'tbl_kelas_santri';

    // Define the primary key
    protected $primaryKey = 'Id';

    // Fields that can be manipulated (inserted or updated)
    protected $allowedFields = [
        'IdKelas', 
        'IdTpq', 
        'IdSantri', 
        'IdTahunAjaran', 
        'Status',
        'created_at', 
        'updated_at'
    ];

    // Enable automatic handling of created_at and updated_at fields
    protected $useTimestamps = true;

    // Define the created and updated fields
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    public function GetNamaKelas()
    {
        $db = db_connect();
        $sql = 'SELECT IdKelas, NamaKelas from tbl_kelas';
        $query = $db->query($sql);
        $query->getResult();
        return $query;
    }
}
