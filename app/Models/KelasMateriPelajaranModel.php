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

    public function getMateriPelajaranByKelasAndTpq($kelas = null, $IdTpq = null)
    {
        // Initialize the query
        $query = $this->select('*'); // You are already inside the model, so use $this
        // If 'kelas' is provided, add condition to the query
        if ($kelas !== null) {
            $query->where('IdKelas', $kelas);
        }

        // If 'IdTpq' is provided, add condition to the query
        if ($IdTpq !== null) {
            $query->where('IdTpq', $IdTpq);
        }

        // Execute the query and get the result as an array
        $data['materi'] = $query->findAll();

        // Return the data
        return $data;
    }
}
