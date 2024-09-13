<?php

namespace App\Controllers;

use App\Models\KelasMateriPelajaranModel;
class KelasMateriPelajaran extends BaseController
{
    public function index()
    {
        $model = new KelasMateriPelajaranModel();
        $data['materi'] = $model->findAll();

        return view('kelas_materi_pelajaran/index', $data);
    }

    public function create()
    {
        return view('kelas_materi_pelajaran/create');
    }

    
    public function store()
    {
        $model = new KelasMateriPelajaranModel();
        $data = [
            'IdKelas'       => $this->request->getPost('IdKelas'),
            'IdTpq'         => $this->request->getPost('IdTpq'),
            'IdTahunAjaran' => $this->request->getPost('IdTahunAjaran'),
            'IdMateri'      => $this->request->getPost('IdMateri'),
            'Semester'      => $this->request->getPost('Semester')
        ];
        $model->save($data);

        return redirect()->to('/kelasMateriPelajaran');
    }

    public function edit($id)
    {
        $model = new KelasMateriPelajaranModel();
        $data['materi'] = $model->find($id);

        return view('kelas_materi_pelajaran/edit', $data);
    }

    public function update($id)
    {
        $model = new KelasMateriPelajaranModel();
        $data = [
            'IdKelas'       => $this->request->getPost('IdKelas'),
            'IdTpq'         => $this->request->getPost('IdTpq'),
            'IdTahunAjaran' => $this->request->getPost('IdTahunAjaran'),
            'IdMateri'      => $this->request->getPost('IdMateri'),
            'Semester'      => $this->request->getPost('Semester')
        ];
        $model->update($id, $data);

        return redirect()->to('/kelasMateriPelajaran');
    }

    public function delete($id)
    {
        $model = new KelasMateriPelajaranModel();
        $model->delete($id);

        return redirect()->to('/kelasMateriPelajaran');
    }

}
