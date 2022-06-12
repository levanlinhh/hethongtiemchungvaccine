<?php

namespace App\Controllers;

class Home extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = model('App\Models\HomeModel');
    }

    public function index()
    {
        $header = view('template/header', array('isLogin' => $this->model->isLogin(), 'isAdmin' => $this->model->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->model->isLogin()
        );
        return view('index', $data);
    }

    public function Login_Page()
    {
        $header = view('template/header', array('isLogin' => $this->model->isLogin(), 'isAdmin' => $this->model->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->model->isLogin()
        );
        return view('login', $data);
    }

    public function Registration_Page()
    {
        $header = view('template/header', array('isLogin' => $this->model->isLogin(), 'isAdmin' => $this->model->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->model->isLogin(),
            'listVaccine' => $this->model->getListVaccine(),
            'listPlace' => $this->model->getListPlace(),
        );
        return view('registration', $data);
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

    public function contact()
    {
        $header = view('template/header', array('isLogin' => $this->model->isLogin(), 'isAdmin' => $this->model->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->model->isLogin()
        );
        return view('contact', $data);
    }

    public function Dashboard_Page()
    {
        $header = view('template/header', array('isLogin' => $this->model->isLogin(), 'isAdmin' => $this->model->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->model->isLogin(),
            'listVaccine' => $this->model->getListVaccine(),
            'listPlace' => $this->model->getListPlace(),
        );
        
        return view('/admin/index', $data);
    }
    public function history()
    {
        $header = view('template/header', array('isLogin' => $this->model->isLogin(), 'isAdmin' => $this->model->isAdmin()));
        $data = array(
            'header' => $header,
            'isLogin' => $this->model->isLogin(),
            'isAdmin' => $this->model->isAdmin(),
        );
        
        return view('/admin/index', $data);
    }

    public function Logout()
    {
        $this->model->Logout();
        return redirect()->to(site_url('/'));
    }

    public function Register_API()
    {
        if ($this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng xuất và thực hiện lại',
                'data' => ''
            ));
            return;
        }

        if (!isset($_POST['user']) || 
            !isset($_POST['pass']) || 
            !isset($_POST['email']) )
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin',
                'data' => ''
            ));
            return;
        }

        if (strlen($_POST['user']) < 5 || strlen($_POST['user']) > 12)
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Độ dài tên đăng nhập từ 5-12 ký tự',
                'data' => ''
            ));
            return;
        }

        if (strlen($_POST['pass']) < 5 || strlen($_POST['pass']) > 30)
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Độ dài mật khẩu từ 5-30 ký tự',
                'data' => ''
            ));
            return;
        }

        if (!$this->isEmail($_POST['email']))
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Email không hợp lệ',
                'data' => ''
            ));
            return;
        }

        $user = strtolower($_POST['user']);
        $pass = $_POST['pass'];
        $email = $_POST['email'];

        $this->model->Register($user, $pass, $email);
    }

    public function Login_API()
    {
        if ($this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng xuất và thực hiện lại',
                'data' => ''
            ));
            return;
        }

        if (!isset($_POST['user']) || 
            !isset($_POST['pass']) )
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin',
                'data' => ''
            ));
            return;
        }

        $user = strtolower($_POST['user']);
        $pass = md5($_POST['pass']);

        $this->model->Login($user, $pass);
    }

    public function Registration_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }

        if (!isset($_POST['name']) ||
            !isset($_POST['cccd']) ||
            !isset($_POST['birthday']) ||
            !isset($_POST['gender']) ||
            !isset($_POST['injection_times']) ||
            !isset($_POST['vaccine_id']) ||
            !isset($_POST['place_id']) ||
            !isset($_POST['registration_date']))                                                                                                                                                                                                                                                                                                            
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

        if (!$this->isDate($_POST['birthday'], 'Y-m-d'))
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Định dạng ngày sinh không hợp lệ',
                'data' => ''
            ));
            return;
        }

        if (!is_numeric($_POST['gender']) || ($_POST['gender'] != 0 && $_POST['gender'] != 1))
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Định dạng giới tính không hợp lệ',
                'data' => ''
            ));
            return;
        }

        if (!is_numeric($_POST['injection_times']) || $_POST['injection_times'] < 1)
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Số lần tiêm không hợp lệ',
                'data' => ''
            ));
            return;
        }

        if (!$this->isDate($_POST['registration_date'], 'Y-m-d'))
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Định dạng ngày đăng ký tiêm không hợp lệ',
                'data' => ''
            ));
            return;
        }

        $name = $_POST['name'];
        $cccd = $_POST['cccd'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];
        $injection_times = $_POST['injection_times'];
        $vaccine_id = $_POST['vaccine_id'];
        $place_id = $_POST['place_id'];
        $registration_date = $_POST['registration_date'];

        $this->model->Registration($name, $cccd, $birthday, $gender, $injection_times, $vaccine_id, $place_id, $registration_date);
    }

    

    public function Add_Vaccine_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }
        if (!isset($_POST['vaccine']) || empty($_POST['vaccine']))                                                                                                                                                                                                                                                                                                            
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin',
                'data' => ''
            ));
            return;
        }

        $this->model->Add_Vaccine($_POST['vaccine']);
    }

    public function Update_Vaccine_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }
        if (!isset($_POST['vaccine']) || empty($_POST['vaccine']) || !isset($_POST['id']) || empty($_POST['id']))                                                                                                                                                                                                                                                                                                            
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin',
                'data' => ''
            ));
            return;
        }

        $this->model->Update_Vaccine($_POST['vaccine'], $_POST['id']);
    }

    public function Delete_Vaccine_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }
        if (!isset($_POST['id']) || empty($_POST['id']))                                                                                                                                                                                                                                                                                                            
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin',
                'data' => ''
            ));
            return;
        }

        $this->model->Delete_Vaccine($_POST['id']);
    }

    public function Add_Place_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }
        if (!isset($_POST['address']) || empty($_POST['address']))                                                                                                                                                                                                                                                                                                            
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin',
                'data' => ''
            ));
            return;
        }

        $this->model->Add_Place($_POST['address']);
    }

    public function Update_Place_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }
        if (!isset($_POST['address']) || empty($_POST['address']) || !isset($_POST['id']) || empty($_POST['id']))                                                                                                                                                                                                                                                                                                            
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin',
                'data' => ''
            ));
            return;
        }

        $this->model->Update_Place($_POST['address'], $_POST['id']);
    }

    public function Delete_Place_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }
        if (!isset($_POST['id']) || empty($_POST['id']))                                                                                                                                                                                                                                                                                                            
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin',
                'data' => ''
            ));
            return;
        }

        $this->model->Delete_Place($_POST['id']);
    }


    public function Update_Information_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }

        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }

        if (!isset($_POST['id']) ||
            !isset($_POST['name']) ||
            !isset($_POST['cccd']) ||
            !isset($_POST['birthday']) ||
            !isset($_POST['gender']) ||
            !isset($_POST['injection_times']) ||
            !isset($_POST['vaccine_id']) ||
            !isset($_POST['place_id']) ||
            !isset($_POST['registration_date']) ||
            !isset($_POST['confirm']))                                                                                                                                                                                                                                                                                                            
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

        if (!$this->isDate($_POST['birthday'], 'Y-m-d'))
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Định dạng ngày sinh không hợp lệ',
                'data' => ''
            ));
            return;
        }

        if (!is_numeric($_POST['gender']) || ($_POST['gender'] != 0 && $_POST['gender'] != 1))
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Định dạng giới tính không hợp lệ',
                'data' => ''
            ));
            return;
        }

        if (!is_numeric($_POST['injection_times']) || $_POST['injection_times'] <=1)
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Số lần tiêm không hợp lệ',
                'data' => ''
            ));
            return;
        }

        if (!$this->isDate($_POST['registration_date'], 'Y-m-d'))
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Định dạng ngày đăng ký tiêm không hợp lệ',
                'data' => ''
            ));
            return;
        }

        if (!is_numeric($_POST['confirm']) || ($_POST['confirm'] != 0 && $_POST['confirm'] != 1))
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Định dạng xác nhận tiêm không hợp lệ',
                'data' => ''
            ));
            return;
        }

        $id = $_POST['id'];
        $name = $_POST['name'];
        $cccd = $_POST['cccd'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];
        $injection_times = $_POST['injection_times'];
        $vaccine_id = $_POST['vaccine_id'];
        $place_id = $_POST['place_id'];
        $registration_date = $_POST['registration_date'];
        $confirm = $_POST['confirm'];

        $this->model->Update_Information($id, $name, $cccd, $birthday, $gender, $injection_times, $vaccine_id, $place_id, $registration_date, $confirm);
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

    public function Delete_Information_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }
        if (!isset($_POST['id']) || empty($_POST['id']))                                                                                                                                                                                                                                                                                                            
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin',
                'data' => ''
            ));
            return;
        }

        $this->model->Delete_Information($_POST['id']);
    }

    public function Total_Vaccine_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }

        $this->model->Total_Vaccine();
    }

    public function Total_Injected_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }

        $this->model->Total_Injected();
    }

    public function Total_Not_Injected_Yet_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }

        $this->model->Total_Not_Injected_Yet();
    }

    public function Total_People_Injecting_API()
    {
        if (!$this->model->isLogin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Vui lòng đăng nhập và thực hiện lại',
                'data' => ''
            ));
            return;
        }
        if (!$this->model->isAdmin())
        {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không có quyền truy cập',
                'data' => ''
            ));
            return;
        }

        $this->model->Total_People_Injecting();
    }

    public function isEmail($email) :bool
    {
        $email = trim($email);
        $email = stripslashes($email);
        $email = htmlspecialchars($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return false;
        return true;
    }

    public function isDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}
