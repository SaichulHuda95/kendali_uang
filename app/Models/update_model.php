<?php

namespace App\Models;

use CodeIgniter\Model;

class update_model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect(); // Inisialisasi hanya sekali
    }

    public function update_data($table, $param, $id, $data)
    {
        $builder = $this->db->table($table);
        $builder->where([$param => $id]);
        $query = $builder->update($data);
        return $query;
    }
}
