<?php

namespace App\Controllers;

class Vaccine extends BaseController
{
    public $model;
    public $homeModel;
    
    public function __construct()
    {
        $this->model = model('App\Models\VaccineModel');
        $this->homeModel = model('App\Models\HomeModel');
    }
    
    public function index()
    {
        $header = view('template/header', array('isLogin' => $this->homeModel->isLogin(), 'isAdmin' => $this->homeModel->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->homeModel->isLogin(),
        );
        return view('admin/vaccine/index', $data);
    }

    public function save()
    {
        $nameVaccine = $_POST['name_vaccine'];
        $quocGia = $_POST['quoc_gia'];
        $id = $_POST['vaccine_id'];
        $operation = $_POST['operation']; 

        $data = array(
            'name_vaccine' => $nameVaccine,
            'quoc_gia' => $quocGia,
        );
        if ($operation == 'update') {
            return $this->model->update($id, $data);
        } else {
            return $this->model->create($data);
        }
    }

    public function getById()
    {
        $id =  $_GET['id'];
        return $this->model->getById($id);
    }

    public function list()
    {
        if (!$this->homeModel->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->homeModel->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }

        $this->model->getList();
    }

    public function delete()
    {
        $id = $_POST['id'];
        return $this->model->delete($id);
    }
}
