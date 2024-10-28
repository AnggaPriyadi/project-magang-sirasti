<?php

namespace App\Modules\Radius\Models;

use CodeIgniter\Model;

class UserinfoModel extends Model
{
    protected $DBGroup      = 'rds';
    protected $table        = 'userinfo';
    protected $primaryKey   = 'id'; // Sesuaikan dengan primary key tabel userinfo

    protected $allowedFields = ['username', 'firstname', 'lastname', 'department_id', 'jenis_perangkat_id'];

    // Metode untuk mengambil data
    public function searchMACAllFields($keyword)
{
    return $this->table('userinfo')
                ->like('username', $keyword)
                ->orLike('firstname', $keyword)
                ->orLike('lastname', $keyword)
                ->orLike('department_id', $keyword)
                ->orLike('jenis_perangkat_id', $keyword)
                ->get()
                ->getResultArray();
}


    public function getMAC()
    {
        return $this->findAll();
    }

    // Metode untuk menyimpan data
    public function saveMAC($data)
    {
        return $this->insert($data);
    }

    // Metode untuk mengupdate data
    public function updateMAC($id, $data)
    {
        // Ambil username (MAC Address) berdasarkan id
        $userInfo = $this->find($id);
        $oldUsername = $userInfo['username'];

        // Mulai transaksi
        $db = db_connect();
        $db->transStart();

        try {
            // Update data di tabel userinfo
            $this->update($id, $data);

            // Update data di tabel radcheck
            $db->table('radcheck')->where('username', $oldUsername)->update(['username' => $data['username']]);

            // Update data di tabel radreply
            $db->table('radreply')->where('username', $oldUsername)->update(['username' => $data['username']]);

            // Commit transaksi jika berhasil
            $db->transCommit();
            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $db->transRollback();
            return false;
        }
    }

    // Metode untuk menghapus data
    public function deleteMAC($id)
    {
        // Ambil username (MAC Address) berdasarkan id
        $userInfo = $this->find($id);
        $username = $userInfo['username'];

        // Mulai transaksi
        $db = db_connect();
        $db->transStart();

        try {
            // Hapus dari tabel userinfo
            $this->delete($id);

            // Hapus dari tabel radcheck
            $db->table('radcheck')->where('username', $username)->delete();

            // Hapus dari tabel radreply
            $db->table('radreply')->where('username', $username)->delete();

            // Commit transaksi jika berhasil
            $db->transCommit();
            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $db->transRollback();
            return false;
        }
    }

    // Metode untuk menghapus data berdasarkan array ID
    public function deleteMultipleMAC($ids)
    {
        // Mulai transaksi
        $db = db_connect();
        $db->transStart();

        try {
            foreach ($ids as $id) {
                // Ambil username (MAC Address) berdasarkan id
                $userInfo = $this->find($id);
                $username = $userInfo['username'];

                // Hapus dari tabel userinfo
                $this->delete($id);

                // Hapus dari tabel radcheck
                $db->table('radcheck')->where('username', $username)->delete();

                // Hapus dari tabel radreply
                $db->table('radreply')->where('username', $username)->delete();
            }

            // Commit transaksi jika berhasil
            $db->transCommit();
            return true;
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $db->transRollback();
            return false;
        }
    }
    
    public function saveRadCheck($macAddress, $status)
    {
        // Menyimpan data ke tabel radcheck
        $db = db_connect();
        $builder = $db->table('radcheck');
        $data = [
            'username' => $macAddress,
            'attribute' => 'Auth-Type',
            'op' => ':=',
            'value' => 'Accept'
        ];
        return $builder->insert($data);
    }

    public function saveRadReply($macAddress, $attribute, $value)
    {
        // Menyimpan data ke tabel radreply
        $db = db_connect();
        $builder = $db->table('radreply');
        $data = [
            'username' => $macAddress,
            'attribute' => 'Mikrotik-Mark-Id',
            'op' => '=',
            'value' => 'Proxy-AOD'
        ];
        return $builder->insert($data);
    }

}
