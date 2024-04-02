<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MahasiswaModel;

class Mahasiswa extends ResourceController
{
    use ResponseTrait;

    public function register()
    {
        $email = $this->request->getPost('email');

        if (strpos($email, '@student.uns.ac.id') === false) {
            return redirect()->back()->with('error', 'Email harus menggunakan domain @student.uns.ac.id');
        }
    }

    public function index()
    {
        $model = new MahasiswaModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function get($NIM = null)
    {
        $model = new MahasiswaModel();
        $data = $model->find($NIM);
        if (!$data) {
            return $this->failNotFound('No Data Found');
        } else {
            return $this->respond($data);
        }
    }

    public function show($NIM = null)
    {
        $model = new MahasiswaModel();
        $data = $model->find(['NIM' => $NIM]);
        if (!$data) return $this->failNotFound('No Data Found');
        return $this->respond($data[0]);
    }

    public function create()
    {
        helper(['form']);
        $rules = [
            'NIM'             => 'required',
            'nama_mahasiswa'  => 'required',
            'email'           => 'required',
        ];
        
        $data = [
            'NIM'             => $this->request->getVar('NIM'),
            'nama_mahasiswa'  => $this->request->getVar('nama_mahasiswa'),
            'email'           => $this->request->getVar('email'),
        ];

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        
        $model = new MahasiswaModel();
        $model->save($data);

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Inserted'
            ]
        ];

        return $this->respondCreated($response);
    }

    public function update($NIM = null)
    {
        helper(['form']);
        
        $rules = [
            'nama_mahasiswa'  => 'required',
            'email'           => 'required',
        ];
        
        $data = [
            'nama_mahasiswa'  => $this->request->getVar('nama_mahasiswa'),
            'email'           => $this->request->getVar('email'),
        ];

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        
        $model = new MahasiswaModel();
        $findById = $model->find($NIM);

        if (!$findById) return $this->failNotFound('No Data Found');
        
        $model->update($NIM, $data);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];

        return $this->respond($response);
    }

    public function delete($NIM = null)
    {
        $model = new MahasiswaModel();
        $findById = $model->find($NIM);

        if (!$findById) return $this->failNotFound('No Data Found');
        
        $model->delete($NIM);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Deleted'
            ]
        ];

        return $this->respond($response);
    }
}
