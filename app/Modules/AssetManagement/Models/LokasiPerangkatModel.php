<?php

namespace App\Modules\AssetManagement\Models;


use CodeIgniter\Model;

class LokasiPerangkatModel extends Model
{
    protected $table = 'lokasi_pemasangan';
    protected $returnType       = 'object';

    // Validation
    protected $validationRules      = [
        'lokasi_pemasangan' => 'required',
        'merk'              => 'required'
    ];


    public function getAll()
    {
        return $this->findAll();
    }

    public function getRuangShaft()
    {
        return $this->limit(10, 9)->find();
    }

    public function getGkp()
    {
        return $this->limit(17, 19)->find();
    }

    public function getGudang()
    {
        return $this->limit(1, 37)->find();
    }
}
