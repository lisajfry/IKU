<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Iku3Model;

class Iku3 extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new Iku3Model();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function show($iku3_id = null)
    {
        $model = new Iku3Model();
        $data = $model->find($iku3_id);
        if (!$data) {
            return $this->failNotFound('No Data Found');
        } else {
            return $this->respond($data);
        }
    }

    public function create()
    {
        $model = new Iku3Model();
        $data = [
            'NIDN'               => $this->request->getVar('NIDN'),
            'aktivitas_dosen'    => $this->request->getVar('aktivitas_dosen'),
            'mahasiswa_bimbingan' => $this->request->getVar('mahasiswa_bimbingan'),
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

    public function update($iku3_id = null)
    {
        $model = new Iku3Model();
        $data = [
            'NIDN'               => $this->request->getVar('NIDN'),
            'aktivitas_dosen'    => $this->request->getVar('aktivitas_dosen'),
            'mahasiswa_bimbingan' => $this->request->getVar('mahasiswa_bimbingan'),
        ];

        $model->update($iku3_id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];

        return $this->respond($response);
    }

    public function delete($iku3_id = null)
    {
        $model = new Iku3Model();
        $model->delete($iku3_id);
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
