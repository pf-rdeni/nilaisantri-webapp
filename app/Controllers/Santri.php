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
        return view('backend/santri/santri', $data);
    }

    public function showSantriPerKelas()
    {
        $IdTpq = '411221010225';
        $datasantri = $this->DataSantri->GetDataSantriPerKelas();
        $data = [
            'page_title' => 'Data Santri',
            'santri' => $datasantri
        ];
        return view('backend/santri/santriNaikKelas', $data);
    }

    public function sowSantriKelasBaru()
    {
        //$IdTpq = '411221010225';
        $dataKelas = $this->DataSantri->GetNamaKelas();
        $datasantri = $this->DataSantri->GetDataSantriStatus("Baru");
        $data = [
            'page_title' => 'Data Santri',
            'santri' => $datasantri,
            'kelas' => $dataKelas
        ];
        return view('backend/santri/santriKelasBaru', $data);
    }
}