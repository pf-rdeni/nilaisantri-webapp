<?php

namespace App\Controllers;

use App\Models\SantriModel;


class Santri extends BaseController
{
    public $DataSantri;
    public function __construct()
    {
       $this->DataSantri = new SantriModel();
    }

    public function show()
    {
        $IdTpq = '411221010225';
        $datasantri = $this->DataSantri->GetData($IdTpq);
        $data = [
            'page_title' => 'Data Santri',
            'santri' => $datasantri
        ];
        return view('backend/santri/listSantri', $data);
    }

    public function showSantriPerKelas()
    {
        $datasantri = $this->DataSantri->GetDataSantriPerKelas();
        $data = [
            'page_title' => 'Data Santri',
            'santri' => $datasantri
        ];
        return view('backend/santri/santriNaikKelas', $data);
    }
}