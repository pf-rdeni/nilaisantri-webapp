<?php

namespace App\Controllers;

use App\Models\TpqModel;


class Tpq extends BaseController
{

    public function __construct()
    {
        $this->DataTpq = new TpqModel();
    }

    public function show()
    {
        $id = '';
        $datatpq = $this->DataTpq->GetData($id);
        $data = [
            'page_title' => 'Data Tpq',
            'tpq' => $datatpq,
            'validation' => \Config\Services::validation()
        ];
        return view('backend/tpq/tpq', $data);
    }

    public function create()
    {
        $data = [
            'page_title' => 'Form Data Tambah Tpq',
            'validation' => \Config\Services::validation()
        ];

        return view('backend/tpq/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'IdTpq' => [
                'rules' => 'required|is_unique[tbl_tpq.IdTpq]',
                'errors' => [
                    'required' => 'Nama TPQ harus di isi',
                    'is_unique' => '{field} TPQ sudah terdaftar'
                ]
            ],
            'NamaTpq' => [
                'rule' => 'required',
                'errors' => [
                    'required' => 'Nama TPQ harus di isi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            session()->setflashdata('pesan', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Gagal Disimpan 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                </button>
            </div>');
            return redirect()->to('/tpq/create/')->withInput()->with('validation', $validation);
        }

        $this->DataTpq->save([
            'IdTpq' => $this->request->getVar('IdTpq'),
            'NamaTpq' => $this->request->getVar('NamaTpq'),
            'Alamat' => $this->request->getVar('AlamatTpq'),
            'TahunBerdiri' => $this->request->getVar('TanggalBerdiri'),
            'KepalaSekolah' => $this->request->getVar('NamaKepTpq'),
            'NoHp' => $this->request->getVar('NoHp'),
            'TempatBelajar' => $this->request->getVar('TempatBelajar')
        ]);

        session()->setFlashdata('pesan', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Disimpan 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        return redirect()->to('/tpq/show');
    }

    public function update($id)
    {
        /*
        $IdLama= $this->DataTpq->GetData($this->request->getVar('IdTpq'));

        if($IdLama[0]['IdTpq'] == $this->request->getVar('IdTpq') ){
            $rule_IdTpq = 'required';
        }else{
            $rule_IdTpq ='required|is_unique[tbl_tpq.IdTpq]';
        }
        */
        $rule_IdTpq = 'required';
        if (!$this->validate([
            'IdTpq' => [
                'rules' => $rule_IdTpq,
                'errors' => [
                    'required' => 'Nama TPQ harus di isi',
                    'is_unique' => '{field} TPQ sudah terdaftar'
                ]
            ],
            'NamaTpq' => [
                'rule' => 'required',
                'errors' => [
                    'required' => 'Nama TPQ harus di isi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            session()->setflashdata('pesan', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Gagal Disimpan 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                </button>
            </div>');
            return redirect()->to('/tpq/create/')->withInput()->with('validation', $validation);
        }

        $this->DataTpq->save([
            'IdTpq' => $this->request->getVar('IdTpq'),
            'NamaTpq' => $this->request->getVar('NamaTpq'),
            'Alamat' => $this->request->getVar('AlamatTpq'),
            'TahunBerdiri' => $this->request->getVar('TanggalBerdiri'),
            'KepalaSekolah' => $this->request->getVar('NamaKepTpq'),
            'NoHp' => $this->request->getVar('NoHp'),
            'TempatBelajar' => $this->request->getVar('TempatBelajar')
        ]);

        session()->setFlashdata('pesan', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Disimpan 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        return redirect()->to('/tpq/show');
    }

    public function delete($id)
    {
        $this->DataTpq->delete($id);
        session()->setFlashdata('pesan', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Di Hapus 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        return redirect()->to('/tpq/show');
    }
}
