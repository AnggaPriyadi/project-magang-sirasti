<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DivisiModel;
use App\Models\JenisPerangkat;
use App\Models\UserInfoModel;

class Dashboard extends Controller
{
    public function index(): string
    {
        $session = session();
        $username = $session->get('username');
        
        // Inisialisasi model
        $model = new UserInfoModel();
        // $divisiModel = new DivisiModel();
        // $jenisPerangkatModel = new JenisPerangkat();
        
        // Ambil data dan hitung
        $data['mac_count'] = count($model->getMAC()); // Jumlah MAC Address
        // $data['divisi_count'] = count($divisiModel->findAll()); // Jumlah Divisi
        // $data['jenis_perangkat_count'] = count($jenisPerangkatModel->findAll()); // Jumlah Jenis Perangkat

        // Oper data ke view
        return view('layouts/dashboard', [
            'username' => $username,
            'mac_count' => $data['mac_count'],
            'divisi_count' => $data['divisi_count'],
            'jenis_perangkat_count' => $data['jenis_perangkat_count']
        ]);
    }
}
