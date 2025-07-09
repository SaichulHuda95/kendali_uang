<?php

namespace App\Models;

use CodeIgniter\Model;

class auth_model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect(); // Inisialisasi hanya sekali
    }

    public function get_user($username)
    {
        $query = "SELECT * FROM user WHERE username = '$username'";
        $builder = $this->db->query($query);
        $result = $builder->getRow();
        return $result;
    }
}
