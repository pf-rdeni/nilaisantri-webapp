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
        $data['kelas'] = $this->kelasModel->findAll();
        
        // Load the view and pass the data
        return view('kelas/index', $data);
    }

    public function showSantriKelasBaru()
    {
        $dataKelas = $this->kelasModel->getNamaKelas();
        $dataSantri = $this->santriModel->getDataSantriStatus("Baru");

        // Add logic to get recommended class
        foreach ($dataSantri as &$santri) {
            $santri['nextKelas'] = $this->getNextKelas($santri['Tingkat']);
        }

        $data = [
            'page_title' => 'Data Santri',
            'santri' => $dataSantri,
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

        $idKelasArray = $this->request->getVar('IdKelas');
        $idTpqArray = $this->request->getVar('IdTpq');
        $dataSantriBaru = [];

        foreach ($idKelasArray as $idSantri => $idKelas) {
            $dataSantriBaru = [
                'IdSantri' => $idSantri,
                'IdKelas' => $idKelas,
                'IdTpq' => $idTpqArray[$idSantri],
                'IdTahunAjaran' => $idTahunAjaran
            ];
            $this->store($dataSantriBaru);
        }

        $dataKelas = $this->kelasModel->getNamaKelas();
        $dataSantri = $this->santriModel->getDataSantriStatus("Baru1");

        $data = [
            'page_title' => 'Data Santri',
            'santri' => $dataSantri,
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
        $this->kelasModel->save([
            'IdKelas' => $data['IdKelas'],
            'IdTpq' => $data['IdTpq'],
            'IdSantri' => $data['IdSantri'],
            'IdTahunAjaran' => $data['IdTahunAjaran']
        ]);
    }

    // Function to edit an existing record (Read)
    public function edit($id)
    {
        $data['kelas'] = $this->kelasModel->find($id);

        return view('kelas/edit', $data);  // Load the form to edit the record
    }

    // Function to update the record in the database (Update)
    public function update($id)
    {
        if ($this->validate([
            'IdKelas' => 'required',
            'IdTpq' => 'required',
            'IdSantri' => 'required',
            'IdTahunAjaran' => 'required'
        ])) {
            $this->kelasModel->update($id, [
                'IdKelas' => $this->request->getPost('IdKelas'),
                'IdTpq' => $this->request->getPost('IdTpq'),
                'IdSantri' => $this->request->getPost('IdSantri'),
                'IdTahunAjaran' => $this->request->getPost('IdTahunAjaran')
            ]);

            return redirect()->to('/kelas');  // Redirect to the list of records
        } else {
            return view('kelas/edit', ['kelas' => $this->kelasModel->find($id)]);
        }
    }

    // Function to delete a record from the database (Delete)
    public function delete($id)
    {
        $this->kelasModel->delete($id);

        return redirect()->to('/kelas');  // Redirect to the list of records
    }

    public function showListSantriPerKelas($idTahunAjaran = null)
    {
        $currentYear = date('Y');
        $currentMonth = date('n');

        // Determine the current and previous academic years
        $previousAcademicYear = ($currentMonth >= 7) ? ($currentYear - 1) . $currentYear : ($currentYear - 2) . ($currentYear - 1);
        $currentAcademicYear = ($currentMonth >= 7) ? $currentYear . ($currentYear + 1) : ($currentYear - 1). ($currentYear + 1);

        // Query for both academic years
        $this->kelasModel->select('tbl_kelas_santri.IdTahunAjaran, tbl_kelas_santri.IdKelas, tbl_kelas.NamaKelas, COUNT(tbl_kelas_santri.IdSantri) AS SumIdKelas')
                        ->join('tbl_kelas', 'tbl_kelas_santri.IdKelas = tbl_kelas.IdKelas')
                        ->groupBy('tbl_kelas_santri.IdTahunAjaran, tbl_kelas_santri.IdKelas')
                        ->orderBy('tbl_kelas_santri.IdTahunAjaran', 'ASC')
                        ->orderBy('tbl_kelas_santri.IdKelas', 'ASC')
                        ->where('tbl_kelas_santri.status', true)
                        ->whereIn('tbl_kelas_santri.IdTahunAjaran', [$previousAcademicYear, $currentAcademicYear]);

        $dataKelas = $this->kelasModel->get()->getResultArray();

        // Separate data into current and previous academic years
        $kelas_previous = array_filter($dataKelas, function($item) use ($previousAcademicYear) {
            return $item['IdTahunAjaran'] === $previousAcademicYear;
        });

        $kelas_current = array_filter($dataKelas, function($item) use ($currentAcademicYear) {
            return $item['IdTahunAjaran'] === $currentAcademicYear;
        });

        // Prepare the data to be sent to the view
        $data = [
            'page_title' => 'Daftar Naik Kelas',
            'kelas_previous' => $kelas_previous,
            'kelas_current' => $kelas_current,
            'current_tahun_ajaran' => $currentAcademicYear,
            'previous_tahun_ajaran' => $previousAcademicYear
        ];

        return view('backend/kelas/naikKelas', $data);
    }


    public function updateNaikKelas($idTahunAjaran, $idKelas)
    {
        $santriList = $this->kelasModel->where('IdTahunAjaran', $idTahunAjaran)
                            ->where('IdKelas', $idKelas)
                            ->where('Status', 1)
                            ->findAll();

        $newTahunAjaran = $this->calculateNextTahunAjaran($idTahunAjaran);

        foreach ($santriList as $santri) {
            $idKelasLama = $santri['IdKelas'];
            $idKelasBaru = $this->getNextKelas($santri['IdKelas']);
            $idTpq = $santri['IdTpq'];
            $idSantri = $santri['IdSantri'];

            $this->kelasModel->insert([
                'IdKelas' => $idKelasBaru,
                'IdTpq' => $idTpq,
                'IdSantri' => $idSantri,
                'IdTahunAjaran' => $newTahunAjaran
            ]);

            $this->kelasModel->update($santri['Id'], ['Status' => 0]);

            $listMateriPelajaran = $this->kelasMateriPelajaranModel->getMateriPelajaranByKelasAndTpq($idKelasBaru, $idTpq);

            foreach ($listMateriPelajaran['materi'] as $materiPelajaran) {
                $data = [
                    'IdSantri' => $idSantri,
                    'IdTpq' => $idTpq,
                    'IdKelas' => $materiPelajaran['IdKelas'],
                    'IdTahunAjaran' => $newTahunAjaran,
                    'IdMateri' => $materiPelajaran['IdMateri'],
                    'Semester' => $materiPelajaran['Semester']
                ];
                $this->nilaiModel->insertNilai($data);
            }
        }

        return redirect()->to('/kelas/showListSantriPerKelas/' . $idTahunAjaran);
    }

    private function getNextKelas($idKelas)
    {
        $classMapping = [
            'TK1' => 'TK2',
            'TK2' => 'SD1',
            'TK' => 'SD1',
            'SD1' => 'SD2',
            'SD2' => 'SD3',
            'SD3' => 'SD4',
            'SD4' => 'SD5',
            'SD5' => 'SD6',
            'SD6' => 'SMP1',
            'SMP1' => 'SMP2',
            'SMP2' => 'SMP3',
            'SMP3' => 'Alumni'
        ];

        return $classMapping[$idKelas] ?? 'Alumni';
    }

    private function calculateNextTahunAjaran($currentTahunAjaran)
    {
        $startYear = (int) substr($currentTahunAjaran, 0, 4);
        $endYear = (int) substr($currentTahunAjaran, 4);

        $nextStartYear = $startYear + 1;
        $nextEndYear = $endYear + 1;

        return $nextStartYear . $nextEndYear;
    }
}
