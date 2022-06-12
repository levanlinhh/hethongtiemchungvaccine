<?php

namespace App\Models;
class AddressModel
{
    public $db;
    public $session;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = session();
    }

    public function getAll()
    {
        $query = $this->db->table('place')
            ->get()
            ->getResultArray();
            return json_encode(array(
                'data' => $query
            )); 
                     
    }

    public function getList()
    {
        $query = $this->db->table('place')
            ->select('*')
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

    public function create($data)
    {
        $query = $this->db->table('place')
            ->insert($data);

        return json_encode(array(
            'status' => true,
            'message' => 'Thêm thông tin thành công',
            'data' => ''
        ));
    }

    public function update($id, $place)
    {
        $query = $this->db->table('place')
            ->where('id', $id)
            ->get()
            ->getResultArray();
        if (count($query) == 0) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy address này',
                'data' => ''
            ));
            return;
        }

        $query = $this->db->table('place')
            ->where('id', $id)
            ->update($place);

        echo json_encode(array(
            'status' => true,
            'message' => 'Cập nhật tên address thành công',
            'data' => $query
        ));
        return;
    }

    public function delete($id)
    {
        $query = $this->db->table('place')
            ->where('id', $id)
            ->get()
            ->getResultArray();
        if (count($query) == 0) {
            return json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy address này',
                'data' => ''
            ));
        }

        $query = $this->db->table('place')
            ->where('id', $id)
            ->delete();

        if ($query) {
            return json_encode(array(
                'status' => true,
                'message' => 'Xóa address thành công',
                'data' => $query
            ));
        }
        else {
            return json_encode(array(
                'status' => true,
                'message' => 'Xóa address không thành công. address đã được sử dụng',
                'data' => $query
            ));
        }
    }

    public function getById($id)
    {
        $query = $this->db->table('place')
        ->where('id', $id)
        ->get()
        ->getResultArray();
        if (count($query) == 0) {
            return json_encode(array(
                'status' => false,
                'message' => 'Không tìm thấy address này',
                'data' => ''
            ));
        }

        return json_encode(array(
            'status' => true,
            'message' => 'Đã tìm thấy thông tin',
            'data' => $query
        ));
    }

}