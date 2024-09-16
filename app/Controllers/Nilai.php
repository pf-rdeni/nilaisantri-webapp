<?php

namespace App\Controllers;
use App\Models\NilaiModel;
use App\Models\HelpFunctionModel;

class Nilai extends BaseController
{
    protected $DataNilai;
    protected $pendamping;
    protected $helpFunction;

    public function __construct()
    {
        $this->DataNilai = new NilaiModel();
        $this->helpFunction = new HelpFunctionModel();
        
        $dataGuruKelas = $this->helpFunction->getDataJabatan(session()->get('IdJabatan'));

        $this->pendamping = strpos($dataGuruKelas[0]['NamaJabatan'], 'GURU') !== false;
    }

    public function showDetail($IdSantri, $IdSemseter, $Edit = false)
    {
        $datanilai = $this->DataNilai->GetDataNilaiDetail($IdSantri, $IdSemseter);

        $data = [
            'page_title' => 'Data Nilai',
            'nilai' => $datanilai,
            'guruPendamping' => $this->pendamping,
            'pageEdit' => $Edit
        ];

        return view('backend/nilai/nilaiSantriDetail', $data);
    }

    public function showSumaryPersemester()
    {
        $datanilai = $this->DataNilai->getDataNilaiPerSemester();
        return view('backend/nilai/nilaiSantriPerSemester', [
            'page_title' => 'Rank Data Nilai',
            'nilai' => $datanilai
        ]);
    }

    public function showNilaiProfilDetail($IdSantri)
    {
        $datanilai = $this->DataNilai->GetDataNilaiDetail($IdSantri, 1);
        return view('backend/nilai/nilaiSantriDetailPersonal', [
            'page_title' => 'Detail Nilai',
            'nilai' => $datanilai
        ]);
    }

    public function update($Edit = false)
    {
        $validationRules = [
            'Nilai' => [
                'rules' => 'required|greater_than_equal_to[50]|less_than_equal_to[95]',
                'errors' => [
                    'required' => 'Materi ' . $this->request->getVar('NamaMateri') . ' Nilai harus diisi',
                    'greater_than_equal_to' => 'Materi ' . $this->request->getVar('NamaMateri') . ' Nilai harus lebih dari atau sama dengan 50',
                    'less_than_equal_to' => 'Materi ' . $this->request->getVar('NamaMateri') . ' Nilai harus kurang dari atau sama dengan 95',
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            $errorMessage = $validation->getError('Nilai');

            session()->setFlashdata('pesan', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Gagal Disimpan: ' . $errorMessage . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                        <span aria-hidden="true">&times;</span> 
                    </button>
                </div>');
            
            return redirect()->to('/nilai/showDetail/')->withInput()->with('validation', $validation);
        } 
        $Id=$this->request->getVar('Id');
        $IdSantri= $this->request->getVar('IdSantri');
        $Semester =$this->request->getVar('Semester');
        $this->DataNilai->save([
            'Id' => $Id,
            'Nilai' => $this->request->getVar('Nilai'),
            'Catatan' => $this->request->getVar('Catatan')
        ]);

        session()->setFlashdata('pesan', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Berhasil Disimpan 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        
            //Need to adapted
        return redirect()->to('/nilai/showDetail/'.$IdSantri.'/'.$Semester.'/'.$Edit);
        
    }
}
