<?php

namespace App\Models;

use CodeIgniter\Model;

class insert_model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect(); // Inisialisasi hanya sekali
    }

    public function insert_data($table, $data)
    {
        $builder = $this->db->table($table);
        $query = $builder->insert($data);
        return $query;
    }
}
