<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Iku2Model;

class Iku2 extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new Iku2Model();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function show($iku2_id = null)
    {
        $model = new Iku2Model();
        $data = $model->find($iku2_id);
        if (!$data) {
            return $this->failNotFound('No Data Found');
        } else {
            return $this->respond($data);
        }
    }

    public function create()
    {
        $model = new Iku2Model();
        $data = [
            'NIM'              => $this->request->getVar('NIM'),
            'aktivitas'        => $this->request->getVar('aktivitas'),
            'sks'              => $this->request->getVar('sks'),
            'prestasi'         => $this->request->getVar('prestasi'),
            'tingkat_lomba'    => $this->request->getVar('tingkat_lomba'),
            'dosen_pembimbing' => $this->request->getVar('dosen_pembimbing')
        ];
        
        $model->insert($data);

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Inserted'
            ]
        ];

        return $this->respondCreated($response);
    }

    public function update($iku2_id = null)
    {
        $model = new Iku2Model();
        $data = [
            'NIM'              => $this->request->getVar('NIM'),
            'aktivitas'        => $this->request->getVar('aktivitas'),
            'sks'              => $this->request->getVar('sks'),
            'prestasi'         => $this->request->getVar('prestasi'),
            'tingkat_lomba'    => $this->request->getVar('tingkat_lomba'),
            'dosen_pembimbing' => $this->request->getVar('dosen_pembimbing')
        ];

        $model->update($iku2_id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];

        return $this->respond($response);
    }

    public function delete($iku2_id = null)
    {
        $model = new Iku2Model();
        $model->delete($iku2_id);
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
