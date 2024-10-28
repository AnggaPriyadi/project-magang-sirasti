<?php

namespace App\Modules\AssetManagement\Controllers;

use App\Modules\AssetManagement\Models\AssetManagementModel;
use App\Modules\AssetManagement\Models\LokasiPerangkatModel;
use App\Modules\AssetManagement\Models\StatusAssetModel;
use App\Modules\MasterData\Models\JenisPerangkatModel;
use App\Modules\MasterData\Models\MerkPerangkatModel;
use App\Modules\User\Models\UserModel;
use CodeIgniter\Controller;

class AssetManagementController extends Controller
{
    protected $helpers = ['form'];
    protected $assetmanagementModel;
    protected $jenisperangkatModel;
    protected $merkperangkatModel;
    protected $lokasiperangkatModel;
    protected $statusassetModel;
    protected $userModel;

    public function __construct()
    {
        $this->assetmanagementModel = new AssetManagementModel();
        $this->jenisperangkatModel  = new JenisPerangkatModel();
        $this->merkperangkatModel   = new MerkPerangkatModel();
        $this->lokasiperangkatModel = new LokasiPerangkatModel();
        $this->statusassetModel     = new StatusAssetModel();
        $this->userModel            = new UserModel();
    }

    public function index()
    {
        $data['asset_management']   = $this->assetmanagementModel->getAll();
        // print_r($data['asset_management']);
        // die();
        $data['jenis_perangkat']    = $this->jenisperangkatModel->findAll();
        $data['merk_perangkat']     = $this->merkperangkatModel->findAll();

        $data['lokasi_pemasangan']  = $this->lokasiperangkatModel->findAll();
        $data['ruang_shaft']        = $this->lokasiperangkatModel->getRuangShaft();
        $data['gkp']                = $this->lokasiperangkatModel->getGkp();
        $data['gudang']             = $this->lokasiperangkatModel->getGudang();

        $data['status_asset']       = $this->statusassetModel->findAll();
        return view('\App\Modules\AssetManagement\Views\index', $data);
    }

    public function displayData()
    {
        $assetManagement = $this->assetmanagementModel->getAll();


        // $arrayUser =  session('isLoggedIn');

        $roleUser = session('role');

        $output = '';
        $no = 1;


        foreach ($assetManagement as $data) {
            $catatan = $data->catatan;

            if ($catatan == '') {
                $catatan = '-';
            }

            if ($roleUser == 'admin') {
                $display = '';
            } else {
                $display = 'style="display:none"';
            }

            $output .= '<tr id="' . $data->id_asset . '">';
            $output .= '<td class="table-plus">' . $no++ . '</td>';
            $output .= '<td><h5 class="font-16">' . $data->nama_jenis_perangkat . '</h5></td>';
            $output .= '<td>' . $data->nama_merk . '</td>';
            $output .= '<td>' . $data->tipe . '</td>';
            $output .= '<td>' . $data->serial_no . '</td>';
            $output .= '<td>' . $data->no_asset . '</td>';
            $output .= '<td>' . $data->nama_lokasi . '</td>';
            $output .= '<td>' . $data->nama_status . '</td>';
            $output .= '<td>' . $catatan . '</td>';
            $output .= '<td ' . $display . '>';
            $output .= '<button ' . $display . ' type="button" class="btn btn-info btn-sm editAsset" 
            data-id="' . $data->id_asset . '" 
            data-jenis_perangkat="' . $data->jenis_perangkat . '" 
            data-nama_jenis_perangkat="' . $data->nama_jenis_perangkat . '"
            data-merk="' . $data->merk . '"
            data-nama_merk="' . $data->nama_merk . '" 
            data-tipe="' . $data->tipe . '" 
            data-serial_no="' . $data->serial_no . '" 
            data-no_asset="' . $data->no_asset . '" 
            data-lokasi_perangkat="' . $data->lokasi_perangkat . '"
            data-nama_lokasi="' . $data->nama_lokasi . '" 
            data-status="' . $data->status . '"
            data-nama_status="' . $data->nama_status . '"
            data-catatan="' . $data->catatan . '"><i class="dw dw-edit-2"></i> Edit</button>';
            $output .= '<button ' . $display . ' type="button" class="btn btn-danger btn-sm deleteAsset" data-id="' . $data->id_asset . '"><i class="dw dw-delete-3"></i> Hapus</button>';
            $output .= '</td>';
            $output .= '</tr>';
        }

        echo $output;
    }

    public function displayDataExport()
    {
        $assetManagement = $this->assetmanagementModel->getAll();

        $output = '';
        $no = 1;

        foreach ($assetManagement as $data) {
            $catatan = $data->catatan;

            if ($catatan == '') {
                $catatan = '-';
            }

            $output .= '<tr id="' . $data->id_asset . '">';
            $output .= '<td class="table-plus">' . $no++ . '</td>';
            $output .= '<td>' . $data->nama_jenis_perangkat . '</td>';
            $output .= '<td>' . $data->nama_merk . '</td>';
            $output .= '<td>' . $data->tipe . '</td>';
            $output .= '<td>' . $data->serial_no . '</td>';
            $output .= '<td>' . $data->no_asset . '</td>';
            $output .= '<td>' . $data->nama_lokasi . '</td>';
            $output .= '<td>' . $data->nama_status . '</td>';
            $output .= '<td>' . $catatan . '</td>';
            $output .= '</tr>';
        }

        echo $output;
    }

    public function create()
    {
        return view('/asset-management');
    }

    // fungsi untuk menyimpan data ketika tambah data
    public function store()
    {
        // simpan data jika validasi berhasil
        $this->assetmanagementModel->save([
            'jenis_perangkat' => $this->request->getPost('jenis_perangkat'),
            'merk' => $this->request->getPost('merk'),
            'tipe' => $this->request->getPost('tipe'),
            'serial_no' => $this->request->getPost('serial_no'),
            'no_asset' => $this->request->getPost('no_asset'),
            'lokasi_perangkat' => $this->request->getPost('lokasi_perangkat'),
            'status' => $this->request->getPost('status'),
            'catatan' => $this->request->getPost('catatan')
        ]);
        return redirect()->to('/asset-management');
    }


    public function edit($id)
    {
        $data['asset_management'] = $this->merkperangkatModel->find($id);
        return view('/asset-management', $data);
    }

    // fungsi untuk update data
    public function update($id)
    {
        // Update data jika validasi berhasil
        $this->assetmanagementModel->update($id, [
            'jenis_perangkat' => $this->request->getPost('jenis_perangkat'),
            'merk' => $this->request->getPost('merk'),
            'tipe' => $this->request->getPost('tipe'),
            'serial_no' => $this->request->getPost('serial_no'),
            'no_asset' => $this->request->getPost('no_asset'),
            'lokasi_perangkat' => $this->request->getPost('lokasi_perangkat'),
            'status' => $this->request->getPost('status'),
            'catatan' => $this->request->getPost('catatan')
        ]);
        return redirect()->to('/asset-management');
    }


    // fungsi untuk delete/hapus data
    public function delete($id)
    {
        $this->assetmanagementModel->delete($id);

        return redirect()->to('/asset-management');
    }
}
