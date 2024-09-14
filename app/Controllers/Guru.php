<?php

namespace App\Controllers;

use App\Models\GuruModel;


class Guru extends BaseController
{
    protected $DataModels;
    public function __construct()
    {
        $this->DataModels = new GuruModel();
    }

    public function show()
    {

        $data = [
            'page_title' => 'Data Guru',
            'guru' => $this->DataModels->GetData()
        ];
        return view('backend/guru/guru', $data);
    }
}