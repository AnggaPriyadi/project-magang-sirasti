<?php

namespace App\Modules\User\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup      = 'default';
    protected $table        = 'users';
    protected $primaryKey   = 'id'; // Sesuaikan dengan primary key tabel userinfo

    protected $allowedFields = ['username', 'password', 'last_login', 'is_active', 'ip_address'];

    // Mengaktifkan fitur timestamps
    protected $useTimestamps = false;

    // Kolom yang digunakan untuk mencatat waktu pembuatan dan pembaruan
    protected $createdField  = 'created_at';

    public function updateLoginInfo($id, $ipAddress)
    {
        return $this->update($id, [
            'last_login' => date('Y-m-d H:i:s'),
            'ip_address' => $ipAddress,
        ]);
    }
}
