<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public $model;
    public $homeModel;

    public function __construct()
    {
        $this->model = model('App\Models\AdminModel');
        $this->homeModel = model('App\Models\HomeModel');
    }

    public function index()
    {
        $header = view('template/header', array('isLogin' => $this->homeModel->isLogin(), 'isAdmin' => $this->homeModel->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->homeModel->isLogin()
        );
        return view('admin/index', $data);
    }

    public function account()
    {
        $header = view('template/header', array('isLogin' => $this->homeModel->isLogin(), 'isAdmin' => $this->homeModel->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->homeModel->isLogin()
        );
        return view('admin/account', $data);
    }
    
    public function List_People_API()
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

        $this->model->getListPeople();
    }

    public function Search_Page()
    {
        $header = view('template/header', array('isLogin' => $this->model->isLogin(), 'isAdmin' => $this->model->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->model->isLogin()
        );
        return view('search', $data);
    }

    public function Search_API()
    {
        if (!isset($_POST['cccd']))                                                                                                                                                                                                                                                                                                            
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin',
                'data' => ''
            ));
            return;
        }

        if (!is_numeric($_POST['cccd']))
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'CCCD/CMND chỉ được nhập số',
                'data' => ''
            ));
            return;
        }

        $this->model->Search($_POST['cccd']);
    }

    public function contact()
    {
        $header = view('template/header', array('isLogin' => $this->homeModel->isLogin(), 'isAdmin' => $this->homeModel->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->homeModel->isLogin()
        );
        return view('admin/contact', $data);
    }

    public function confirm() {
        $id = $_POST['id'];
        $confirm = $_POST['confirm'];
        $data = array(
            'confirm' => $confirm,
        );
        return $this->model->update($id, $data);
    } 
}
