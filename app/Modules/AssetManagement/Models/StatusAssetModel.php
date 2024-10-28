<?php

namespace App\Modules\AssetManagement\Models;


use CodeIgniter\Model;

class StatusAssetModel extends Model
{
    protected $table = 'status_asset';
    protected $returnType    = 'object';

    // Validation
    protected $validationRules      = [
        'status_asset'      => 'required',
        'merk'              => 'required'
    ];


    public function getAll()
    {
        return $this->findAll();
    }
}
