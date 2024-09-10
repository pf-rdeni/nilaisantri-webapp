<?php

namespace App\Controllers;

use App\Models\SantriModel;


class Santri extends BaseController
{

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
        return view('backend/santri/santri_perKelas', $data);
    }

    public function setSantriKelasBaru()
    {
        //$IdTpq = '411221010225';
        $datasantri = $this->DataSantri->GetDataSantriStatus("");
        $data = [
            'page_title' => 'Data Santri',
            'santri' => $datasantri
        ];
        return view('backend/santri/santri_setKelas', $data);
    }
}