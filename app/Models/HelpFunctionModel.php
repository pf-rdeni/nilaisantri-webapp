<?php

namespace App\Models;
use CodeIgniter\Model;

class HelpFunctionModel extends Model
{
    protected $santriModel;

    public function __construct()
    {
        parent::__construct();
    }

    public function getDataTpq($id = false)
    {
        $namaTable = "tbl_tpq";
        $builder = $this->db->table($namaTable);

        if ($id) {
            $builder->where('IdTpq', $id);
        }

        return $builder->get()->getResultArray();
    }

    public function getDataGuru($id = false, $status = true)
    {
        $namaTable = "tbl_guru";
        $builder = $this->db->table($namaTable)->where('Status', $status);
    
        if ($id) {
            $builder->where('IdTpq', $id);
        }
        return $builder->get()->getResultArray();
    }

    public function getDataKelas()
    {
        return $this->db->table('tbl_kelas')
            ->select('IdKelas, NamaKelas')
            ->get()->getResultArray();
    }

     public function getDataJabatan($id = false)
    {
        $namaTable = "tbl_jabatan";
        $builder = $this->db->table($namaTable);
    
        if ($id) {
            $builder->where('IdJabatan', $id);
        }
        return $builder->get()->getResultArray();
    }

     public function getDataGuruKelas()
    {
        return $this->db->table('tbl_guru_kelas gk')
                        ->select('j.IdJabatan, j.NamaJabatan, gk.IdTahunAjaran, gk.Id, gk.IdGuru, gk.IdTpq, gk.IdKelas, g.Nama, t.NamaTpq, k.NamaKelas')
                        ->join('tbl_guru g', 'g.IdGuru = gk.IdGuru')
                        ->join('tbl_tpq t', 't.IdTpq = gk.IdTpq')
                        ->join('tbl_kelas k', 'k.IdKelas = gk.IdKelas')
                        ->join('tbl_jabatan j', 'j.IdJabatan = gk.IdJabatan')
                        ->get()
                        ->getResultArray();
    }

    public function getNextKelas($idKelas)
    {
        $classMapping = [
            'TK1' => 'TK2',
            'TK2' => 'SD1',
            'TK' => 'SD1',
            'SD1' => 'SD2',
            'SD2' => 'SD3',
            'SD3' => 'SD4',
            'SD4' => 'SD5',
            'SD5' => 'SD6',
            'SD6' => 'SMP1',
            'SMP1' => 'SMP2',
            'SMP2' => 'SMP3',
            'SMP3' => 'Alumni'
        ];

        return $classMapping[$idKelas] ?? 'Alumni';
    }

    public function getTahuanAjaranBerikutnya($currentTahunAjaran)
    {
        $startYear = (int) substr($currentTahunAjaran, 0, 4);
        $endYear = (int) substr($currentTahunAjaran, 4);

        $nextStartYear = $startYear + 1;
        $nextEndYear = $endYear + 1;

        return $nextStartYear . $nextEndYear;
    }

    public function convertTahunAjaran($TahunAjaran)
    {
        $startYear = (int) substr($TahunAjaran, 0, 4);
        $endYear = (int) substr($TahunAjaran, 4);

        $StartYear = $startYear;
        $EndYear = $endYear;

        return $StartYear .'/'. $EndYear;
    }

    public function getTahunAjaranSaatIni()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        // Get the current year and determine the academic year
        return ($currentMonth >= 7) ? $currentYear . ($currentYear + 1) : ($currentYear - 1) . $currentYear;
    }

    public function getTahunAjaranSebelumnya()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        // Get the current year and determine the academic year
        return ($currentMonth >= 7) ? ($currentYear - 1) . $currentYear : $currentYear . ($currentYear + 1);
    }
}

class HelpFunctionUpdate extends Model
{


}