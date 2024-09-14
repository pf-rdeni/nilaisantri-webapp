<?php

namespace App\Controllers;

use App\Models\SantriModel;
use App\Models\EncryptModel;

class Santri extends BaseController
{
    public $DataSantri;
    protected $encryptModel;
    public function __construct()
    {
        $this->encryptModel = new EncryptModel();
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

    public function showSantriPerKelas($encryptedIdGuru = null)
    {
        if($encryptedIdGuru !== null)
            $IdGuru = $this->encryptModel->decryptData($encryptedIdGuru);
        else 
            $IdGuru = $encryptedIdGuru;
        
        $datasantri = $this->DataSantri->GetDataSantriPerKelas($IdGuru);
        $data = [
            'page_title' => 'Data Santri Per Semester',
            'santri' => $datasantri
        ];

        return view('backend/santri/santriPerKelas', $data);
    }
    
    public function showKontakSantri($IdSantri = null) 
    {

        $data = [
            'page_title' => 'Kontak Santri',
            'santri' => $datasantri=""
        ];
        return view('backend/santri/kontakSantri', $data);
    }

}