<?php

namespace App\Controllers;
use App\Models\MateriPelajaranModel;


class MateriPelajaran extends BaseController
{
    protected $materiModel;

    public function __construct()
    {
        $this->materiModel = new MateriPelajaranModel();
    }

    public function index()
    {
        $data['materi'] = $this->materiModel->findAll();
        return view('materipelajaran/index', $data);
    }

    public function create()
    {
        return view('materipelajaran/create');
    }

    public function store()
    {
        $this->materiModel->save([
            'IdMateri'  => $this->request->getPost('IdMateri'),
            'NamaMateri' => $this->request->getPost('NamaMateri'),
            'Kategori' => $this->request->getPost('Kategori')
        ]);

        return redirect()->to('/materipelajaran');
    }

    public function edit($id)
    {
        $data['materi'] = $this->materiModel->find($id);
        return view('materipelajaran/edit', $data);
    }

    public function update($id)
    {
        $this->materiModel->update($id, [
            'IdMateri'  => $this->request->getPost('IdMateri'),
            'NamaMateri' => $this->request->getPost('NamaMateri'),
            'Kategori' => $this->request->getPost('Kategori')
        ]);

        return redirect()->to('/materipelajaran');
    }

    public function delete($id)
    {
        $this->materiModel->delete($id);
        return redirect()->to('/materipelajaran');
    }
}
