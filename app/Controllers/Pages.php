<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = ['page_title' => 'Dashboard'];
        return view('backend/dashboard/index', $data);
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
