<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $session = session();
        $session->set('IdJabatan', '4');
        $session->set('IdTahunAjaran', '20222023');
        $session->set('IdKelas', 'SD2');
        $session->set('IdTpq', '411221010225');
        $session->set('IdGuru', '2101075810760001'); //2101156110810001 agung 2101075010760002 leni

        $data = ['page_title' => 'Dashboard'];
        return view('backend/dashboard/index', $data);
        // Menginisialisasi session dan menyimpan data

    }

    public function about()
    {
        $data = ['pages_title' => 'About Me | MyPrograming'];
        return view('backend/dashboard/about', $data);
    }
    public function contact()
    {

        $data = [
            'page_title' => 'About Me | MyPrograming',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Perumahan Lobam Mas Asri Blok T13',
                    'kota' => 'Kabupaten Bintan'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Kawasan Industri Lobam',
                    'kota' => 'Kabupaten Bintan'
                ]
            ],
        ];
        return view('backend/dashboard/contact', $data);
    }

    public function login()
    {
        $data = ['page_title' => 'Login'];
        return view('backend/login/login', $data);
    }
}
