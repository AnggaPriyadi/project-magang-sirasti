<?php

namespace App\Modules\User\Controllers;

use App\Controllers\BaseController;
use App\Modules\User\Models\UserModel;

class UserController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel;
    }

    public function index()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        $user = $this->model->where('username', $username)->first();

        // Jika user ditemukan
        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Set session jika password benar
                session()->set([
                    'username'   => $user['username'],
                    'role'   => $user['role'],
                    'isLoggedIn' => true,
                ]);

                // Dapatkan alamat IP user
                $ipAddress = $this->request->getIPAddress();

                // Update last_login dan ip_address di database
                $this->model->updateLoginInfo($user['id'], $ipAddress);

                // Redirect ke dashboard atau halaman lain
                return redirect()->to('/dashboard');
            } else {
                // Password salah, redirect kembali dengan error
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            // Username tidak ditemukan
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }
    }

    public function logout()
    {
        // Logika logout user
        session()->destroy();
        return redirect()->to('auth');
    }
}
