<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 'tbl_nilai';
    protected $primaryKey = 'Id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $allowedFields = [
        'Id', 
        'Nilai',
        'IdTpq',
        'IdSantri',
        'IdKelas',
        'IdTahunAjaran',
        'IdMateri',
        'Semester',
        'Catatan',
        'created_at', 
        'updated_at'
    ];
    
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Retrieve detailed nilai data
    public function getDataNilaiDetail($IdSantri, $IdSemester)
    {
        $sql = 'SELECT n.Id, n.IdTahunAjaran, n.Semester, n.IdTpq, n.IdKelas, 
                       s.IdSantri, s.Nama, n.IdMateri, m.Kategori, m.NamaMateri, n.Nilai, n.Catatan
                FROM tbl_nilai n
                JOIN tbl_santri s ON n.IdSantri = s.IdSantri
                JOIN tbl_materi_pelajaran m ON n.IdMateri = m.IdMateri
                WHERE n.IdSantri = '.$IdSantri.'
                AND n.Semester = '.$IdSemester.'
                ORDER BY n.IdMateri ASC, n.Semester ASC';

        return db_connect()->query($sql);
    }

    // Retrieve nilai data per semester
    public function getDataNilaiPerSemester()
    {
        $sql = 'SELECT n.IdSantri, s.Nama, s.JenisKelamin, IdTahunAjaran, n.Semester, 
                       SUM(n.Nilai) AS TotalNilai, ROUND(AVG(n.Nilai), 2) AS NilaiRataRata
                FROM tbl_nilai n
                JOIN tbl_santri s ON n.IdSantri = s.IdSantri
                GROUP BY n.IdSantri, n.Semester
                ORDER BY n.Semester ASC, TotalNilai DESC';

        return db_connect()->query($sql);
    }

    // Insert nilai data
    public function insertNilai($data)
    {
        return !empty($data) ? $this->insert($data) : false;
    }
}
