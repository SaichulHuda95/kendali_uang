<?php

namespace App\Controllers;

class Rekening extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }


        $data = [
            'title' => 'Rekening | Kendali Uang'
        ];
        return view('rekening/index', $data);
    }

    public function get_saldo()
    {
        $id_user = session()->get('id_user');
        $query = "SELECT 
                r.id_rekening,
                r.nama_rekening,
                COALESCE(SUM(CASE WHEN t.type = 1 THEN t.jumlah ELSE 0 END), 0) AS total_pemasukan,
                COALESCE(SUM(CASE WHEN t.type = 2 THEN t.jumlah ELSE 0 END), 0) AS total_pengeluaran,
                COALESCE(SUM(CASE WHEN t.type = 1 THEN t.jumlah ELSE 0 END), 0) -
                COALESCE(SUM(CASE WHEN t.type = 2 THEN t.jumlah ELSE 0 END), 0) AS sisa_saldo
                FROM 
                kat_rekening r
                LEFT JOIN 
                transaksi t ON r.id_rekening = t.id_rekening
                WHERE 
                r.id_user = $id_user
                GROUP BY 
                r.id_rekening, r.nama_rekening;";
        $saldo = $this->get_model->get_data_array($query);

        $data = array();
        $no = 1;
        foreach ($saldo as $row) {
            $total_pemasukan = '<span class="text-success text-right">' . number_format($row->total_pemasukan, 0, ',', '.') . '</span>';
            $total_pengeluaran = '<span class="text-danger text-right">' . number_format($row->total_pengeluaran, 0, ',', '.') . '</span>';
            $sisa_saldo = '<span class="text-right">' . number_format($row->sisa_saldo, 0, ',', '.') . '</span>';
            $data[] = [
                'no' => $no++,
                'nama_rekening' => $row->nama_rekening,
                'total_pemasukan' => $total_pemasukan,
                'total_pengeluaran' => $total_pengeluaran,
                'sisa_saldo' => $sisa_saldo,
            ];
        }
        return $this->response->setJSON([
            'data' => $data
        ]);
    }
}
