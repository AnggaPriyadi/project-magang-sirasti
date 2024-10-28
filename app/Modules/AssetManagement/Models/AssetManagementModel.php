<?php

namespace App\Modules\AssetManagement\Models;


use CodeIgniter\Model;

class AssetManagementModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'asset_management';
    protected $primaryKey       = 'id_asset';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['jenis_perangkat', 'merk', 'tipe', 'serial_no', 'no_asset', 'lokasi_perangkat', 'status', 'catatan'];

    public function getAll()
    {
        return $this->select('asset_management.*, jenis_perangkat.nama_jenis_perangkat, merk_perangkat.nama_merk, lokasi_pemasangan.nama_lokasi, status_asset.nama_status')
            ->join('jenis_perangkat', 'jenis_perangkat.id_jenis = asset_management.jenis_perangkat', 'left')
            ->join('merk_perangkat', 'merk_perangkat.id_merk = asset_management.merk', 'left')
            ->join('lokasi_pemasangan', 'lokasi_pemasangan.id_lokasi = asset_management.lokasi_perangkat', 'left')
            ->join('status_asset', 'status_asset.id_status = asset_management.status', 'left')
            ->orderBy('id_asset', 'DESC')
            ->get()
            ->getResult();
    }

    public function getById($id)
    {
        return $this->where('id_asset', $id)->first();
    }

    public function saveAsset($data)
    {
        return $this->save($data);
    }

    public function updateAsset($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteAsset($id)
    {
        return $this->delete($id);
    }

    public function jumlahAsset()
    {
        return $this->select('jenis_perangkat.nama_jenis_perangkat, COUNT(*) as total')
            ->join('jenis_perangkat', 'jenis_perangkat.id_jenis = asset_management.jenis_perangkat')
            ->groupBy('jenis_perangkat.nama_jenis_perangkat')
            ->orderBy('total', 'DESC')
            ->findAll();
    }
}
