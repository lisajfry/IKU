<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DosenModel;

class Dosen extends ResourceController
{
    use ResponseTrait;

    public function register()
    {
        $email_dosen = $this->request->getPost('email_dosen');

        if (strpos($email_dosen, '@staff.uns.ac.id') === false) {
            return redirect()->back()->with('error', 'email_dosen harus menggunakan domain @staff.uns.ac.id');
        }
    }

    public function index()
    {
        $model = new DosenModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function get($NIDN = null)
    {
        $model = new DosenModel();
        $data = $model->find($NIDN);
        if (!$data) {
            return $this->failNotFound('No Data Found');
        } else {
            return $this->respond($data);
        }
    }

    public function show($NIDN = null)
    {
        $model = new DosenModel();
        $data = $model->find(['NIDN' => $NIDN]);
        if (!$data) return $this->failNotFound('No Data Found');
        return $this->respond($data[0]);
    }

    public function create()
    {
        helper(['form']);
        $rules = [
            'NIDN'             => 'required',
            'nama_dosen'  => 'required',
            'email_dosen'           => 'required',
        ];
        
        $data = [
            'NIDN'             => $this->request->getVar('NIDN'),
            'nama_dosen'  => $this->request->getVar('nama_dosen'),
            'email_dosen'           => $this->request->getVar('email_dosen'),
        ];

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        
        $model = new DosenModel();
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
 
    public function update($NIDN = null)
    {
        helper(['form']);
        
        $rules = [
            'nama_dosen'  => 'required',
            'email_dosen'           => 'required',
        ];
        
        $data = [
            'nama_dosen'  => $this->request->getVar('nama_dosen'),
            'email_dosen'           => $this->request->getVar('email_dosen'),
        ];

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        
        $model = new DosenModel();
        $findById = $model->find($NIDN);

        if (!$findById) return $this->failNotFound('No Data Found');
        
        $model->update($NIDN, $data);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];

        return $this->respond($response);
    }

    public function delete($NIDN = null)
    {
        $model = new DosenModel();
        $findById = $model->find($NIDN);

        if (!$findById) return $this->failNotFound('No Data Found');
        
        $model->delete($NIDN);

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
