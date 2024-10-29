<?php

namespace App\Modules\MasterData\Controllers;

use App\Modules\MasterData\Models\MerkPerangkatModel;
use CodeIgniter\Controller;

class MerkPerangkatController extends Controller
{
    protected $merkperangkatModel;

    public function __construct()
    {
        $this->merkperangkatModel = new MerkPerangkatModel();
    }
    public function index()
    {

        $data['merk_perangkat'] = $this->merkperangkatModel->findAll();
        return view('\App\Modules\MasterData\Views\merk-perangkat\index', $data);  // Mengarahkan ke folder Modules/AssetManagement/Views/jenis-perangkat/index.php
    }

    public function displayData()
    {
        $merkPerangkat = $this->merkperangkatModel->findAll();


        // $arrayUser =  session('isLoggedIn');

        $roleUser = session('role');

        $output = '';
        $no = 1;


        foreach ($merkPerangkat as $data) {
            if ($roleUser == 'admin') {
                $display = '';
            } else {
                $display = 'style="display:none"';
            }

            $output .= '<tr id="' . $data->id_merk . '">';
            $output .= '<td class="table-plus">' . $no++ . '</td>';
            $output .= '<td>' . $data->nama_merk . '</td>';
            $output .= '<td ' . $display . '>';
            $output .= '<button ' . $display . ' type="button" class="btn btn-info btn-sm editMerk" style="margin-right: 5px;" data-id="' . $data->id_merk . '" data-nama_merk="' . $data->nama_merk . '"><i class="dw dw-edit-2"></i> Edit</button>';
            $output .= '<button ' . $display . ' type="button" class="btn btn-danger btn-sm deleteMerk" data-id="' . $data->id_merk . '"><i class="dw dw-delete-3"></i> Hapus</button>';
            $output .= '</td>';
            $output .= '</tr>';
            // $output .= '<tr> <td>' . $data['nama_merk'] . '</td></tr>';

        }

        echo $output;
    }

    public function create()
    {
        return view('/merk-perangkat');
    }

    public function store()
    {
        // simpan data jika validasi berhasil
        $this->merkperangkatModel->save([
            'nama_merk' => $this->request->getPost('nama_merk'),
        ]);

        return redirect()->to('/merk-perangkat');
    }

    public function edit($id)
    {
        $data['merk_perangkat'] = $this->merkperangkatModel->find($id);
        return view('/merk-perangkat', $data);
    }

    public function update($id)
    {
        $this->merkperangkatModel->update($id, [
            'nama_merk' => $this->request->getPost('nama_merk'),
        ]);

        return redirect()->to('/merk-perangkat');
    }

    public function delete($id)
    {
        $this->merkperangkatModel->delete($id);

        return redirect()->to('/merk-perangkat');
    }
}
