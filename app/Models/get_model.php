<?php

namespace App\Models;

use CodeIgniter\Model;

class get_model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect(); // Inisialisasi hanya sekali
    }

    function get_data_row($query)
    {
        $builder = $this->db->query($query);
        $result = $builder->getRow();
        return $result;
    }

    function get_data_array($query)
    {
        $builder = $this->db->query($query);
        $result = $builder->getResult();
        return $result;
    }
}
