<?php

namespace App\Models;

class AdminModel
{
    public $db;
    public $session;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = session();
    }

    public function getAllAccount()
    {
        $query = $this->db->table('account')
            ->get()
            ->getResultArray();
            return json_encode(array(
                'data' => $query
            )); 
                     
    }
    public function Search($cccd)
    {
        $query = $this->db->table('registration')
            ->select('*, place.address, vaccine.name_vaccine')
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
    public function getListPeople()
    {
        $query = $this->db->table('registration')
            ->select('registration.*, place.address, vaccine.name_vaccine')
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

    public function update($id, $registration)
    {
        $query = $this->db->table('registration')
            ->where('id', $id)
            ->get()
            ->getResultArray();
            
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy registration này',
                'data' => ''
            ));
            return;
        }

        $query = $this->db->table('registration')
            ->where('id', $id)
            ->update($registration);

        echo json_encode(array(
            'status' => true,
            'message' => 'Cập nhật tên registration thành công',
            'data' => $query
        ));
        return;
    }
    
}
