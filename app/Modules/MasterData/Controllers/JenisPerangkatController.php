<?php

namespace App\Modules\MasterData\Controllers;

use App\Modules\MasterData\Models\JenisPerangkatModel;
use CodeIgniter\Controller;

class JenisPerangkatController extends Controller
{
    protected $jenisperangkatModel;

    public function __construct()
    {
        $this->jenisperangkatModel = new JenisPerangkatModel();
    }

    public function index()
    {
        $data['jenis_perangkat'] = $this->jenisperangkatModel->findAll();
        return view('\App\Modules\MasterData\Views\jenis-perangkat\index', $data);  // Mengarahkan ke folder Modules/AssetManagement/Views/jenis-perangkat/index.php
    }

    public function displayData()
    {
        $jenisPerangkat = $this->jenisperangkatModel->findAll();


        // $arrayUser =  session('isLoggedIn');


        $roleUser = session('role');

        $output = '';
        $no = 1;


        foreach ($jenisPerangkat as $data) {
            if ($roleUser == 'admin') {
                $display = '';
            } else {
                $display = 'style="display:none"';
            }

            $output .= '<tr id="' . $data->id_jenis . '">';
            $output .= '<td class="table-plus">' . $no++ . '</td>';
            $output .= '<td>' . $data->nama_jenis_perangkat . '</td>';
            $output .= '<td ' . $display . '>';
            $output .= '<button ' . $display . ' type="button" class="btn btn-info btn-sm editJenis" style="margin-right: 5px;" data-id="' . $data->id_jenis . '" data-nama_jenis_perangkat="' . $data->nama_jenis_perangkat . '"><i class="dw dw-edit-2"></i> Edit</button>';
            $output .= '<button ' . $display . ' type="button" class="btn btn-danger btn-sm deleteJenis" data-id="' . $data->id_jenis . '"><i class="dw dw-delete-3"></i> Hapus</button>';
            $output .= '</td>';
            $output .= '</tr>';
            // $output .= '<tr> <td>' . $data['nama_merk'] . '</td></tr>';
        }

        echo $output;
    }

    public function create()
    {
        return view('/jenis-perangkat');
    }

    public function store()
    {
        // simpan data jika validasi berhasil
        $this->jenisperangkatModel->save([
            'nama_jenis_perangkat' => $this->request->getPost('nama_jenis_perangkat')
        ]);
    }

    public function edit($id)
    {
        $data['nama_jenis_perangkat'] = $this->jenisperangkatModel->find($id);
        return view('/jenis-perangkat', $data);
    }

    public function update($id)
    {
        // Update data jika validasi berhasil
        $this->jenisperangkatModel->update($id, [
            'nama_jenis_perangkat' => $this->request->getPost('nama_jenis_perangkat'),
        ]);
        return redirect()->to('/jenis-perangkat');
    }

    public function delete($id)
    {
        // hapus data
        $this->jenisperangkatModel->delete($id);
        return redirect()->to('/jenis-perangkat');
    }
}
