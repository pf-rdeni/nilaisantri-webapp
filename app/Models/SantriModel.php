<?php

namespace App\Models;

use CodeIgniter\Model;

class SantriModel extends Model
{
    public $db;
    public function init()
    {
        $db = db_connect();
    }
    
    protected $table      = 'tbl_santri';
    public function GetData($id = false)
    {
        if ($id) {
            return $this->where(['IdTpq' => $id])->find();
        } else {
            return $this->findAll();
        }
    }

    public function GetDataSantriPerKelas()
    {
        $db = db_connect();
        $sql = 'SELECT 
        ks.IdTahunAjaran,
        k.NamaKelas,
        g.Nama AS GuruNama,
        s.IdSantri,
        s.Nama AS SantriNama,
        s.JenisKelamin,
        t.NamaTpq,
        t.Alamat
        FROM 
            tbl_kelas_santri ks
        JOIN 
            tbl_kelas k ON ks.IdKelas = k.IdKelas
        JOIN 
            tbl_santri s ON ks.IdSantri = s.IdSantri
        JOIN 
            tbl_tpq t ON ks.IdTpq = t.IdTpq
        JOIN 
            tbl_wali_kelas w ON w.IdKelas = k.IdKelas AND w.IdTpq = t.IdTpq
        JOIN 
            tbl_guru g ON w.IdGuru = g.Nik
        WHERE 
            ks.IdTahunAjaran = w.IdTahunAjaran
                    ORDER BY 
            k.NamaKelas ASC, s.Nama ASC';
        $query = $db->query($sql);

        return $query;
    }

    public function GetDataSantriStatus($Status)
    {
        return $this->where(['Status' => $Status])->find();
    }

    public function GetNamaKelas()
    {
        $db = db_connect();
        $sql = 'SELECT IdKelas, NamaKelas from tbl_kelas';
        $query = $db->query($sql);
        $query->getResult();
        return $query;
    }
}