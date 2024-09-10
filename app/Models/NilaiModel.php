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
        tbl_nilai.IdSantri, tbl_santri.Nama, tbl_santri.JenisKelamin,
        tbl_tahun_ajaran.NamaTahunAjaran, tbl_nilai.Semester, 
        SUM(Nilai) AS TotalNilai, 
        concat(ROUND(AVG(Nilai),2)) AS NilaiRataRata
        FROM
        tbl_nilai, tbl_santri, tbl_tahun_ajaran
        WHERE
        tbl_nilai.IdSantri=tbl_santri.IdSantri
        AND tbl_tahun_ajaran.IdTahunAjaran=tbl_nilai.IdTahunAjaran
        AND tbl_nilai.IdKelas="SD1"  
        GROUP BY
        tbl_nilai.IdSantri,
        tbl_nilai.Semester
        ORDER BY
        tbl_nilai.Semester ASC,
        TotalNilai DESC';
        $query = $db->query($sql);

        return $query;
    }
}
