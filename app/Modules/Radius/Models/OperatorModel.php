<?php

namespace App\Modules\Radius\Models;

use CodeIgniter\Model;

class OperatorModel extends Model
{
    protected $DBGroup          = 'rds';
    protected $table = 'operators';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'nama', 'password'];
}
