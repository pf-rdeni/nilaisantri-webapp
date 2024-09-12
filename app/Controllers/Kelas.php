<?php

namespace App\Controllers;
use App\Models\KelasModel;
use App\Models\SantriModel;

class Kelas extends BaseController
{
    protected $santriModel;
    protected $kelasModel;

    public function __construct()
    {
        // Initialize models
        $this->santriModel = new SantriModel();
        $this->kelasModel = new KelasModel();
    }

    // Function to display all records (Read)
    public function index()
    {
        $model = new KelasModel();
        
        // Get all records from the tbl_kelas table
        $data['kelas'] = $model->findAll();
        
        // Load the view and pass the data
        return view('kelas/index', $data);
    }


    public function sowSantriKelasBaru()
    {
        $dataKelas = $this->kelasModel->GetNamaKelas();
        $datasantri = $this->santriModel->GetDataSantriStatus("Baru1");

        $data = [
            'page_title' => 'Data Santri',
            'santri' => $datasantri,
            'kelas' => $dataKelas
        ];

        return view('backend/kelas/kelasBaru', $data);
    }

    public function setKelasSantri()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        // Get the current year and determine the academic year
        $idTahunAjaran = ($currentMonth >= 7) ? $currentYear . ($currentYear + 1) : ($currentYear - 1) . $currentYear;

        // Get the associative arrays of IdKelas and IdTpq from the request
        $idKelasArray = $this->request->getVar('IdKelas');
        $idTpqArray = $this->request->getVar('IdTpq');

        // Initialize an array to store the new Santri data
        $dataSantriBaru = [];

        // Loop through each IdSantri and corresponding IdKelas and IdTpq
        foreach ($idKelasArray as $idSantri => $idKelas) {
            // Save each IdSantri, IdKelas, and IdTpq in $dataSantriBaru
            $dataSantriBaru = [
                'IdSantri' => $idSantri,
                'IdKelas'  => $idKelas,
                'IdTpq'    => $idTpqArray[$idSantri],
                'IdTahunAjaran' => $idTahunAjaran
            ];
            // Insert the record into the tbl_kelas_santri table
            //$this->DataSantri->InsertSantriKelas($dataSantriBaru);
            $this->store($dataSantriBaru);
            // Update the row where IdSantri matches the given id
            //$this->DataSantri->UpdateSantriStatus($idSantri, "AKTIF");
        }

        $dataKelas = $this->kelasModel->GetNamaKelas();
        $datasantri = $this->santriModel->GetDataSantriStatus("Baru1");

        $data = [
            'page_title' => 'Data Santri',
            'santri' => $datasantri,
            'kelas' => $dataKelas
        ];

        return view('backend/kelas/kelasBaru', $data);
    }


    // Function to create a new record (Create)
    public function create()
    {
        return view('kelas/create');  // Load the form to create a new record
    }

    // Function to store a new record in the database (Create)
    public function store($data)
    {
        $model = new KelasModel();
        $model->save([
            'IdKelas'       => $data['IdKelas'],
            'IdTpq'         => $data['IdTpq'],
            'IdSantri'      => $data['IdSantri'],
            'IdTahunAjaran' => $data['IdTahunAjaran']
        ]);
    }

    // Function to edit an existing record (Read)
    public function edit($id)
    {
        $model = new KelasModel();

        // Get the record by ID
        $data['kelas'] = $model->find($id);

        return view('kelas/edit', $data);  // Load the form to edit the record
    }

    // Function to update the record in the database (Update)
    public function update($id)
    {
        $model = new KelasModel();

        // Validate and update the record
        if ($this->validate([
            'IdKelas'       => 'required',
            'IdTpq'         => 'required',
            'IdSantri'      => 'required',
            'IdTahunAjaran' => 'required'
        ])) {
            $model->update($id, [
                'IdKelas'       => $this->request->getPost('IdKelas'),
                'IdTpq'         => $this->request->getPost('IdTpq'),
                'IdSantri'      => $this->request->getPost('IdSantri'),
                'IdTahunAjaran' => $this->request->getPost('IdTahunAjaran')
            ]);

            return redirect()->to('/kelas');  // Redirect to the list of records
        } else {
            // If validation fails, reload the form
            return view('kelas/edit', ['kelas' => $model->find($id)]);
        }
    }

    // Function to delete a record from the database (Delete)
    public function delete($id)
    {
        $model = new KelasModel();

        // Delete the record by ID
        $model->delete($id);

        return redirect()->to('/kelas');  // Redirect to the list of records
    }
}
