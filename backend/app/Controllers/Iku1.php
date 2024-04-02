<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Iku1Model;

class Iku1 extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new Iku1Model();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function get($id_alumni = null)
    {
        $model = new Iku1Model();
        $data = $model->find($id_alumni);
        if (!$data) {
            return $this->failNotFound('No Data Found');
        } else {
            return $this->respond($data);
        }
    }

    public function show($id_alumni = null)
    {
        $model = new Iku1Model();
        $data = $model->find($id_alumni);
        if (!$data) {
            return $this->failNotFound('No Data Found');
        } else {
            return $this->respond($data);
        }
    }

    public function create()
    {
        helper(['form']);
        $rules = [
            'nama_alumni' => 'required',
            'status'      => 'required',
            'gaji'        => 'required',
            'masa_tunggu' => 'required'
        ];
        
        $data = [
            'nama_alumni' => $this->request->getVar('nama_alumni'),
            'status'      => $this->request->getVar('status'),
            'gaji'        => $this->request->getVar('gaji'),
            'masa_tunggu' => $this->request->getVar('masa_tunggu')
        ];

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors(), 400);
        
        $model = new Iku1Model();
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

    public function update($id_alumni = null)
    {
        helper(['form']);
        $rules = [
            'nama_alumni' => 'required',
            'status'      => 'required',
            'gaji'        => 'required',
            'masa_tunggu' => 'required'
        ];
        
        $data = [
            'nama_alumni' => $this->request->getVar('nama_alumni'),
            'status'      => $this->request->getVar('status'),
            'gaji'        => $this->request->getVar('gaji'),
            'masa_tunggu' => $this->request->getVar('masa_tunggu')
        ];

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors(), 400);
        
        $model = new Iku1Model();
        $dataToUpdate = $model->find($id_alumni);

        if (!$dataToUpdate) return $this->failNotFound('No Data Found');
        
        $model->update($id_alumni, $data);

        // Kode untuk menampilkan view setelah update
        return view('edit_iku1', $data);
    }

    public function delete($id_alumni = null)
    {
        $model = new Iku1Model();
        $dataToDelete = $model->find($id_alumni);

        if (!$dataToDelete) return $this->failNotFound('No Data Found');
        
        $model->delete($id_alumni);

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
