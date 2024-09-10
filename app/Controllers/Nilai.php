<?php

namespace App\Controllers;

use App\Models\NilaiModel;


class Nilai extends BaseController
{

    public function __construct()
    {
        $this->DataNilai = new NilaiModel();
    }

    public function showDetail()
    {
        $IdTpq = '411221010225';
        $datanilai = $this->DataNilai->GetDataNilaiDetail($IdTpq);
        $data = [
            'page_title' => 'Data Nilai',
            'nilai' => $datanilai
        ];
        return view('backend/nilai/santri_detail', $data);
    }

    public function showSumaryPersemester()
    {
        $IdTpq = '411221010225';
        $datanilai = $this->DataNilai->GetDataNilaiPerSemetser($IdTpq);
        $data = [
            'page_title' => 'Rank Data Nilai',
            'nilai' => $datanilai
        ];
        return view('backend/nilai/santri_sumary_persemester', $data);
    }

    public function showNilaiProfilDetail()
    {
        $id=20150001;
        $datanilai = $this->DataNilai->GetDataNilaiDetail($id);
        $data=[
            'page_title'=> 'Detail Nilai',
            'nilai'=>  $datanilai
        ];

        return view('backend/nilai/santri_detail_profil', $data);

    }

    public function update($id)
    {
        if (!$this->validate([
            'Nilai' => [
                'rules' => 'required|greater_than_equal_to[50]|less_than_equal_to[95]',
                'errors' => [
                    'required' => 'Materi '.$this->request->getVar('NamaMateri').' Nilai yang di input :'.$this->request->getVar('Nilai').' harus diisi',
                    'greater_than_equal_to' => 'Materi '.$this->request->getVar('NamaMateri').' Nilai yang di input :'.$this->request->getVar('Nilai').' harus lebih dari atau sama dengan 50',
                    'less_than_equal_to' => 'Materi '.$this->request->getVar('NamaMateri').' Nilai yang di input :'.$this->request->getVar('Nilai').' harus kurang dari atau sama dengan 95',
                ]
            ]
        ])) {
            // Retrieve the specific validation error for 'Nilai'
            $validation = \Config\Services::validation();
            $errorMessage = $validation->getError('Nilai');
        
            session()->setflashdata('pesan', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Gagal Disimpan: ' . $errorMessage . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                </button>
            </div>');
            
            return redirect()->to('/nilai/showDetail/')->withInput()->with('validation', $validation);
        }                
        else{
            $this->DataNilai->save([
                'Id' => $this->request->getVar('Id'),
                'Nilai' => $this->request->getVar('Nilai'),
            ]);
    
            session()->setFlashdata('pesan', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Berhasil Disimpan 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            return redirect()->to('/nilai/showDetail');
        }
        
    }
}
