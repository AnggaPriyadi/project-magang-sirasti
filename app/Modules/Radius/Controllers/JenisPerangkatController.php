<?php

namespace App\Controllers;

use App\Models\JenisPerangkat;
use CodeIgniter\Controller;

class JenisPerangkatController extends Controller
{
    public function index()
    {
        $model = new JenisPerangkat();
        $data['jenis_perangkat'] = $model->findAll();
        return view('/perangkat/view', $data);
    }

    public function create()
    {
        return view('perangkat/create');
    }

    public function store()
    {
        $model = new JenisPerangkat();
        
    
        // Simpan data jika validasi berhasil
        $model->save([
            'nama_perangkat' =>$this->request->getPost('nama_perangkat'),
        ]);
        return redirect()->to('/perangkat');
    }

    public function edit($id)
    {
        $model = new JenisPerangkat();
        $data['jenis_perangkat'] = $model->find($id);
        return view('perangkat/edit', $data);
    }

    public function update($id)
    {
        $model = new JenisPerangkat();
    
        // Update data jika validasi berhasil
        $model->update($id, [
            'nama_perangkat' => $this->request->getPost('nama_perangkat'),
        ]);
        return redirect()->to('/perangkat'); 
    }

    public function delete($id)
    {
        $model = new JenisPerangkat();
        $model->delete($id);
        return redirect()->to('/perangkat');
    }
}
