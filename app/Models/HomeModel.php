<?php

namespace App\Models;

class HomeModel
{
    public $db;
    public $session;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = session();
    }

    public function Register($user, $pass, $email)
    {
        $query = $this->db->table('account')
            ->where('user', $user)
            ->get()
            ->getResultArray();
        if (count($query) > 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Tài khoản đã tồn tại',
                'data' => ''
            ));
            return;
        }
        $data = array(
            'user' => $user,
            'pass' => md5($pass),
            'email' => $email
        );
        $query = $this->db->table('account')
            ->insert($data);
        echo json_encode(array(
            'status' => true,
            'message' => 'Đăng ký tài khoản thành công',
            'data' => ''
        ));
        return;
    }
    
    
    public function Login($user, $pass)
    {
        $query = $this->db->table('account')
            ->where(array(
                'user' => $user,
                'pass' => $pass
            ))->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Tài khoản hoặc mật khẩu không chính xác',
                'data' => ''
            ));
            return;
        }

        $this->session->set(array(
            'user' => $user
        ));

        echo json_encode(array(
            'status' => true,
            'message' => 'Đăng nhập tài khoản thành công',
            'data' => ''
        ));
    }

    public function Registration($name, $cccd, $birthday, $gender, $injection_times, $vaccine_id, $place_id, $registration_date)
    {
        $query = $this->db->table('vaccine')
            ->where(array(
                'id' => $vaccine_id,
            ))->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy Vaccine này',
                'data' => ''
            ));
            return;
        }

        $query = $this->db->table('place')
            ->where(array(
                'id' => $place_id,
            ))->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy địa điểm này',
                'data' => ''
            ));
            return;
        }

        $user = $this->session->get('user');

        $query = $this->db->table('account')
            ->where(array(
                'user' => $user,
            ))->get()
            ->getResultArray();
        $user_id = $query[0]['id'];

        $data = array(
            'account_id' => $user_id,
            'name' => $name,
            'cccd' => $cccd,
            'birthday' => $birthday,
            'gender' => $gender,
            'injection_times' => $injection_times,
            'vaccine_id' => $vaccine_id,
            'place_id' => $place_id,
            'registration_date' => $registration_date,
        );

        $query = $this->db->table('registration')
            ->insert($data);

        echo json_encode(array(
            'status' => true,
            'message' => 'Đăng ký thông tin thành công',
            'data' => ''
        ));
    }

    public function Search($cccd)
    {
        $query = $this->db->table('registration')
            ->select('registration.*, place.address, vaccine.name_vaccine')
            ->where('cccd', $cccd)
            ->join('place', 'place.id = registration.place_id')
            ->join('vaccine', 'vaccine.id = registration.vaccine_id')
            ->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy thông tin',
                'data' => ''
            ));
            return;
        }

        echo json_encode(array(
            'status' => true,
            'message' => 'Đã tìm thấy thông tin',
            'data' => $query
        ));
        return;
    }
   
    public function Add_Place($address)
    {
        $query = $this->db->table('place')
            ->insert(array('address' => $address));

        echo json_encode(array(
            'status' => true,
            'message' => 'Thêm địa điểm thành công',
            'data' => $query
        ));
        return;
    }

    public function Update_Place($address, $id)
    {
        $query = $this->db->table('place')
            ->where('id', $id)
            ->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy địa điểm này',
                'data' => ''
            ));
            return;
        }

        $query = $this->db->table('place')
            ->where('id', $id)
            ->update(array('address' => $address));

        echo json_encode(array(
            'status' => true,
            'message' => 'Cập nhật địa điểm thành công',
            'data' => $query
        ));
        return;
    }

    public function Delete_Place($id)
    {
        $query = $this->db->table('place')
            ->where('id', $id)
            ->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy địa điểm này',
                'data' => ''
            ));
            return;
        }

        $query = $this->db->table('place')
            ->where('id', $id)
            ->delete();

        echo json_encode(array(
            'status' => true,
            'message' => 'Xóa địa điểm thành công',
            'data' => $query
        ));
        return;
    }

    public function Update_Information($id, $name, $cccd, $birthday, $gender, $injection_times, $vaccine_id, $place_id, $registration_date, $confirm)
    {
        $query = $this->db->table('vaccine')
            ->where(array(
                'id' => $vaccine_id,
            ))->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy Vaccine này',
                'data' => ''
            ));
            return;
        }

        $query = $this->db->table('place')
            ->where(array(
                'id' => $place_id,
            ))->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy địa điểm này',
                'data' => ''
            ));
            return;
        }

        $query = $this->db->table('registration')
            ->where(array(
                'id' => $id,
            ))->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy người này này',
                'data' => ''
            ));
            return;
        }

        $data = array(
            'name' => $name,
            'cccd' => $cccd,
            'birthday' => $birthday,
            'gender' => $gender,
            'injection_times' => $injection_times,
            'vaccine_id' => $vaccine_id,
            'place_id' => $place_id,
            'registration_date' => $registration_date,
            'confirm' => $confirm
        );

        $query = $this->db->table('registration')
            ->where('id', $id)
            ->update($data);

        echo json_encode(array(
            'status' => true,
            'message' => 'Cập nhật thông tin thành công',
            'data' => ''
        ));
    }

    public function Delete_Information($id)
    {
        $query = $this->db->table('registration')
            ->where(array(
                'id' => $id,
            ))->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy người này này',
                'data' => ''
            ));
            return;
        }

        $query = $this->db->table('registration')
            ->where('id', $id)
            ->delete();

        echo json_encode(array(
            'status' => true,
            'message' => 'Xóa thông tin thành công thành công',
            'data' => $query
        ));
        return;
    }

    public function Total_Vaccine()
    {
        $query = $this->db->table('vaccine')
            ->get()
            ->getResultArray();

        echo json_encode(array(
            'status' => true,
            'message' => 'Lấy thông tin thành công',
            'data' => array('count' => count($query))
        )); 
        return;
    }

    public function Total_Injected()
    {
        $query = $this->db->table('registration')
            ->where('confirm', '1')
            ->get()
            ->getResultArray();
        echo json_encode(array(
            'status' => true,
            'message' => 'Lấy thông tin thành công',
            'data' => array('count' => count($query))
        )); 
        return;
    }

    public function Total_Not_Injected_Yet()
    {
        $query = $this->db->table('registration')
            ->where('confirm', '0')
            ->get()
            ->getResultArray();
        echo json_encode(array(
            'status' => true,
            'message' => 'Lấy thông tin thành công',
            'data' => array('count' => count($query))
        )); 
        return;
    }

    public function Total_People_Injecting()
    {
        $query = $this->db->table('registration')
            ->get()
            ->getResultArray();
        echo json_encode(array(
            'status' => true,
            'message' => 'Lấy thông tin thành công',
            'data' => array('count' => count($query))
        )); 
        return;
    }

    public function Logout()
    {
        $this->session->destroy();
    }

    public function isLogin(): bool
    {
        if ($this->session->has('user'))
            return true;
        return false;
    }

    public function isAdmin(): bool
    {
        if (!$this->session->has('user'))
            return false;
        $query = $this->db->table('account')
            ->where(array(
                'user' => $this->session->get('user'),
                'user_type' => '1'
            ))
            ->get()
            ->getResultArray();
        if (count($query) > 0)
            return true;
        return false;
    }

    public function getListVaccine()
    {
        $query = $this->db->table('vaccine')
            ->get()
            ->getResultArray();
        return $query;
    }

    public function getListPlace()
    {
        $query = $this->db->table('place')
            ->get()
            ->getResultArray();
        return $query;
    }
}
