<?php

namespace App\Controllers;

use App\Models\GuruKelasModel;
use App\Models\HelpFunctionModel;

class GuruKelas extends BaseController
{
    protected $guruKelasModel;
    protected $helpFunction;

    public function __construct()
    {
        $this->guruKelasModel = new GuruKelasModel();
        $this->helpFunction = new HelpFunctionModel();
    }

    public function show()
    {
        $data = [
            'page_title' => 'Daftar Guru Kelas',
            'guruKelas' => $this->helpFunction->getDataGuruKelas(),
            'kelas' => $this->helpFunction->getDataKelas(),
            'dataTpq' => '411221010225' // Baiturrahman for change in the future
        ];

        return view('backend/kelas/guruKelas', $data);
    }

    public function store()
    {
        $id = $this->request->getPost('Id');
        $data = [
            'IdTpq' => $this->request->getPost('IdTpq'),
            'IdKelas' => $this->request->getPost('IdKelas'),
            'IdGuru' => $this->request->getPost('IdGuru'),
            'IdTahunAjaran' => $this->request->getPost('IdTahunAjaran'),
            'IdJabatan' => $this->request->getPost('IdJabatan'),
        ];

        $id ? $this->guruKelasModel->save($data) : $this->guruKelasModel->insert($data);
        
        return redirect()->to('guruKelas/show');
    }

    public function edit($id)
    {
        $data = [
            'page_title' => 'Data Guru Kelas',
            'guruKelas' => $this->guruKelasModel->find($id)
        ];
        
        return view('backend/kelas/edit', $data);
    }

    public function delete($id)
    {
        $this->guruKelasModel->delete($id);
        return redirect()->to('guruKelas/show');
    }
}
