<?php

namespace App\Models;

use CodeIgniter\Model;

class delete_model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect(); // Inisialisasi hanya sekali
    }

    public function delete_data($table, $param, $id)
    {
        $builder = $this->db->table($table);
        $builder->where([$param => $id]);
        $query = $builder->delete();
        return $query;
    }
}
