<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }


        $data = [
            'title' => 'Home | Kendali Uang'
        ];
        return view('home/index', $data);
    }

    public function get_saldo_rekening()
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

        $data = [
            'success' => true,
            'data' => $saldo
        ];
        echo json_encode($data);
    }

    public function get_rekap_bulan_ini()
    {
        $id_user = session()->get('id_user');
        $bulan_ini = date('m');
        $tahun_ini = date('Y');

        $query = "SELECT 
        SUM(CASE WHEN type = 1 THEN jumlah ELSE 0 END) AS total_pemasukan,
        SUM(CASE WHEN type = 2 THEN jumlah ELSE 0 END) AS total_pengeluaran
        FROM transaksi
        WHERE id_user = $id_user AND MONTH(waktu_transaksi) = '$bulan_ini' AND YEAR(waktu_transaksi) = '$tahun_ini'";

        $rekap = $this->get_model->get_data_row($query);

        $data = [
            'success' => true,
            'data' => $rekap
        ];
        echo json_encode($data);
    }

    public function get_chart_data()
    {
        $id_user = session()->get('id_user');

        $query = "SELECT 
                MONTH(waktu_transaksi) AS bulan,
                YEAR(waktu_transaksi) AS tahun,
                SUM(CASE WHEN type = 1 THEN jumlah ELSE 0 END) AS total_pemasukan,
                SUM(CASE WHEN type = 2 THEN jumlah ELSE 0 END) AS total_pengeluaran
            FROM transaksi
            WHERE id_user = $id_user
            AND waktu_transaksi >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
            GROUP BY tahun, bulan
            ORDER BY tahun, bulan";

        $results = $this->get_model->get_data_array($query);

        $bulan_nama = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];

        $labels = [];
        $pemasukan = [];
        $pengeluaran = [];

        foreach ($results as $row) {
            $labels[] = $bulan_nama[(int)$row->bulan] . ' ' . $row->tahun;
            $pemasukan[] = (int)$row->total_pemasukan;
            $pengeluaran[] = (int)$row->total_pengeluaran;
        }

        echo json_encode([
            'success' => true,
            'data' => [
                'labels' => $labels,
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran,
            ]
        ]);
    }
}
