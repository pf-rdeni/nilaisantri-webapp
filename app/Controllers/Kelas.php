<?php

namespace App\Controllers;
use App\Models\KelasModel;
use App\Models\SantriModel;
use App\Models\KelasMateriPelajaranModel;
use App\Models\NilaiModel;


class Kelas extends BaseController
{
    protected $santriModel;
    protected $kelasModel;
    protected $kelasMateriPelajaranModel;
    protected $nilaiModel;

    public function __construct()
    {
        // Initialize models
        $this->santriModel = new SantriModel();
        $this->kelasModel = new KelasModel();
        $this->kelasMateriPelajaranModel = new KelasMateriPelajaranModel();
        $this->nilaiModel = new NilaiModel();

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

    // Function to read back
    public function showListSantriPerKelas($IdTahunAjaran = null)
    {
         // Initialize the model
        $model = new KelasModel();

        // Base query to count the number of IdSantri, join with tbl_kelas to get NamaKelas
        $model->select('tbl_kelas_santri.IdTahunAjaran, tbl_kelas_santri.IdKelas,tbl_kelas.NamaKelas, COUNT(tbl_kelas_santri.IdSantri) AS SumIdKelas')
            ->join('tbl_kelas', 'tbl_kelas_santri.IdKelas = tbl_kelas.IdKelas')  // Join with tbl_kelas to get NamaKelas
            ->groupBy('tbl_kelas_santri.IdTahunAjaran, tbl_kelas_santri.IdKelas')
            ->orderBy('tbl_kelas_santri.IdTahunAjaran', 'ASC')  // Sort by IdTahunAjaran in ascending order
            ->orderBy('tbl_kelas_santri.IdKelas', 'ASC')
            ->where('tbl_kelas_santri.status', true);       // Sort by IdKelas in ascending order

        // If IdTahunAjaran is provided, add a WHERE condition
        if (!is_null($IdTahunAjaran)) {
            $model->where('tbl_kelas_santri.IdTahunAjaran', $IdTahunAjaran);
        }
        else{
            $currentYear = date('Y');
            $currentMonth = date('n');
            // Get the current year and determine the academic last year
            $IdTahunAjaran = ($currentMonth >= 7) ? ($currentYear - 1) . $currentYear : $currentYear . ($currentYear + 1);

            $model->where('tbl_kelas_santri.IdTahunAjaran', $IdTahunAjaran);
        }

        // Execute the query and get the result as an array
        $dataKelas = $model->get()->getResultArray();

        // Return the result
        $data = [
            'page_title' => 'Daftar Naik Kelas',
            'kelas' => $dataKelas
        ];

        return view('backend/kelas/naikKelas', $data);

    }

    /**
     * Function to update kelas
     */
    public function updateNaikKelas($IdTahunAjaran, $IdKelas)
    {
        // Load the KelasModel (assuming it interacts with tbl_kelas_santri)
        $model = new KelasModel();
        //==========================================================================
        // Step 1 
        // Get query List Santri Per Kelas
        //==========================================================================
        // Query the tbl_kelas_santri table based on IdTahunAjaran and IdKelas
        $santriList = $model->where('IdTahunAjaran', $IdTahunAjaran)
                            ->where('IdKelas', $IdKelas)
                            ->where('Status', 1)
                            ->findAll();

        // Calculate the new academic year dynamically
        $newTahunAjaran = $this->calculateNextTahunAjaran($IdTahunAjaran);
        //==========================================================================
        // Step 2 
        // 2.1 Insert into klas
        // 2.1 update the kelas
        // Insert into table nilai
        // 2.3 Query Get List Materi Nilai based on kelas and IdTpq from tbl_kelas_materi_pelajaran
        // 2.4 Insert Into tbl_nilai for All Santri
        //==========================================================================
        // Loop through each Santri and insert them with the updated IdTahunAjaran
        foreach ($santriList as $santri) {
            $IdKelasLama = $santri['IdKelas'];
            $IdKelasBaru = $this->getNextKelas($santri['IdKelas']);
            // Insert the record into tbl_kelas_santri with updated IdTahunAjaran
            $IdTpq = $santri['IdTpq'];
            $IdSantri = $santri['IdSantri'];
            
            // Step 2.1 Insert New Kelas 
            $model->insert([
                
                'IdKelas'       => $IdKelasBaru,
                'IdTpq'         => $IdTpq,
                'IdSantri'      => $IdSantri,
                'IdTahunAjaran' => $newTahunAjaran, 
            ]);
            
            // Step 2.2 Update Status santri Kelas
            $model->update($santri['Id'], ['Status' => 0]);
               
            // Step 2.3 Get List
            $lisMateriPelajaran = $this->kelasMateriPelajaranModel->getMateriPelajaranByKelasAndTpq($IdKelasBaru,$IdTpq);

            // Step 2.4 Insert Tbl List           
            foreach($lisMateriPelajaran['materi'] as $MateriPelajaran)
            {
                $data = [
                    'IdSantri'      => $IdSantri,
                    'IdTpq'         => $IdTpq,
                    'IdKelas'       => $MateriPelajaran['IdKelas'],
                    'IdTahunAjaran' => $newTahunAjaran,
                    'IdMateri'      => $MateriPelajaran['IdMateri'],
                    'Semester'      => $MateriPelajaran['Semester'],
                ];
                $this->nilaiModel->insertNilai($data);
            }

        }
        //==========================================================================
        // Step 3 
        //==========================================================================
        // After inserting, redirect or return the result
        return redirect()->to('/kelas/showListSantriPerKelas/' . $IdTahunAjaran);
    }


    private function getNextKelas($IdKelas)
    {
        // Define the mapping of classes and their next levels
        $classMapping = [
            'TK1' => 'TK2',
            'TK2' => 'SD1',
            'SD1' => 'SD2',
            'SD2' => 'SD3',
            'SD3' => 'SD4',
            'SD4' => 'SD5',
            'SD5' => 'SD6',
            'SD6' => 'SMP1',
            'SMP1' => 'SMP2',
            'SMP2' => 'SMP3',
            'SMP3' => 'Alumni'  // After SMP3, the student becomes Alumni
        ];

        // Check if the current class exists in the mapping
        if (array_key_exists($IdKelas, $classMapping)) {
            // Return the next class level
            return $classMapping[$IdKelas];
        } else {
            // If the class is not found in the mapping, return 'Alumni' as the default
            return 'Alumni';
        }
    }
    /**
     * Function to calculate the next academic year dynamically
     * @param string $currentTahunAjaran - Current academic year in the format "YYYYYYYY"
     * @return string - The next academic year
     */
    private function calculateNextTahunAjaran($currentTahunAjaran)
    {
        // Split the current academic year (e.g., "20232024" -> "2023" and "2024")
        $startYear = (int) substr($currentTahunAjaran, 0, 4); // Extract first 4 digits (e.g., "2023")
        $endYear   = (int) substr($currentTahunAjaran, 4);    // Extract last 4 digits (e.g., "2024")

        // Increment both years to get the next academic year
        $nextStartYear = $startYear + 1;  // e.g., "2023" -> "2024"
        $nextEndYear   = $endYear + 1;    // e.g., "2024" -> "2025"

        // Combine the incremented years back into the format "YYYYYYYY"
        return $nextStartYear . $nextEndYear; // e.g., "20242025"
    }

}
