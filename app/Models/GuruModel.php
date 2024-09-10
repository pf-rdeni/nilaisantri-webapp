<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table      = 'tbl_guru';
    public function GetData()
    {
        return $this->findAll();
    }
}