<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table      = 'tbl_nilai';
    protected $primaryKey = 'Id';
    protected $useAutoIncrement = false;
    protected $useTimestamps = true;
    protected $allowedFields = ['Id', 'Nilai'];
    
    public function GetDataNilaiDetail($id = false)
    {
        $db = db_connect();
        $sql = 'SELECT
                n.Id,
                n.IdTahunAjaran, 
                n.Semester, 
                n.IdTpq, 
                n.IdKelas, 
                s.IdSantri, 
                s.Nama, 
                n.IdMateri, 
                m.Kategori, 
                m.NamaMateri, 
                n.Nilai
                FROM
                    tbl_nilai n
                JOIN 
                    tbl_santri s ON n.IdSantri = s.IdSantri
                JOIN 
                    tbl_materi_pelajaran m ON n.IdMateri = m.IdMateri
                WHERE
                    n.IdTpq = 411221010225
                    AND n.IdSantri = 20150001
                    AND n.Semester = 1
                    AND n.IdKelas = "SD1"
                ORDER BY
                    n.IdMateri ASC,
                    n.Semester ASC;';
        $query = $db->query($sql);

        return $query;
        
    }
    public function GetDataNilaiPerSemetser($id = false)
    {
        $db = db_connect();
        $sql = 'SELECT
                n.IdSantri, s.Nama, s.JenisKelamin,
                t.NamaTahunAjaran, n.Semester, 
                SUM(n.Nilai) AS TotalNilai, 
                ROUND(AVG(n.Nilai), 2) AS NilaiRataRata
                FROM
                    tbl_nilai n
                JOIN
                    tbl_santri s ON n.IdSantri = s.IdSantri
                JOIN
                    tbl_tahun_ajaran t ON n.IdTahunAjaran = t.IdTahunAjaran
                WHERE
                    n.IdKelas = "SD1"
                GROUP BY
                    n.IdSantri, n.Semester
                ORDER BY
                n.Semester ASC, TotalNilai DESC';
        $query = $db->query($sql);

        return $query;
    }
}
