<?php

namespace App\Models;

use CodeIgniter\Model;

class TpqModel extends Model
{
    protected $table      = 'tbl_tpq';
    protected $primaryKey = 'IdTpq';
    protected $useAutoIncrement = false;
    protected $useTimestamps = true;
    protected $allowedFields = ['IdTpq', 'NamaTpq', 'Alamat', 'TahunBerdiri', 'TempatBelajar', 'KepalaSekolah', 'NoHp'];
    public function GetData($id = false)
    {
        if ($id) {
            return $this->where(['IdTpq' => $id])->find();
            //return $this->find(['IdTpq' => $id]);
        } else {
            return $this->findAll();
        }
    }
}
