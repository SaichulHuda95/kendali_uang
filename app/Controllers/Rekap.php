<?php

namespace App\Controllers;

class Rekap extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }


        $data = [
            'title' => 'Rekap | Kendali Uang'
        ];
        return view('rekap/index', $data);
    }

    public function get_rekap()
    {
        $id_user = session()->get('id_user');
        $query = "SELECT 
                MONTH(waktu_transaksi) AS bulan_num,
                YEAR(waktu_transaksi) AS tahun,
                CONCAT(
                    CASE MONTH(waktu_transaksi)
                    WHEN 1 THEN 'Januari'
                    WHEN 2 THEN 'Februari'
                    WHEN 3 THEN 'Maret'
                    WHEN 4 THEN 'April'
                    WHEN 5 THEN 'Mei'
                    WHEN 6 THEN 'Juni'
                    WHEN 7 THEN 'Juli'
                    WHEN 8 THEN 'Agustus'
                    WHEN 9 THEN 'September'
                    WHEN 10 THEN 'Oktober'
                    WHEN 11 THEN 'November'
                    WHEN 12 THEN 'Desember'
                    END, ' ',
                    YEAR(waktu_transaksi)
                ) AS bulan,
                SUM(CASE WHEN type = 1 THEN jumlah ELSE 0 END) AS total_pemasukan,
                SUM(CASE WHEN type = 2 THEN jumlah ELSE 0 END) AS total_pengeluaran,
                SUM(CASE WHEN type = 1 THEN jumlah ELSE 0 END) -
                SUM(CASE WHEN type = 2 THEN jumlah ELSE 0 END) AS sisa_saldo,
                COUNT(*) AS jumlah_transaksi
            FROM 
                transaksi
                WHERE 
                id_user = $id_user
                GROUP BY 
                    bulan_num, tahun, bulan
                ORDER BY 
                    tahun DESC, bulan_num DESC";
        $rekap = $this->get_model->get_data_array($query);

        $data = array();
        $no = 1;
        foreach ($rekap as $row) {
            $aksi = '
                    <a class="btn btn-sm btn-primary border" title="Lihat Detail" href="' . base_url("/rekap/detail/$row->bulan_num/$row->tahun/$row->bulan") . '">
                        Detail Rekap
                    </a>';

            $total_pemasukan = '<span class="text-success text-right">' . number_format($row->total_pemasukan, 0, ',', '.') . '</span>';
            $total_pengeluaran = '<span class="text-danger text-right">' . number_format($row->total_pengeluaran, 0, ',', '.') . '</span>';
            $sisa_saldo = '<span class="text-right">' . number_format($row->sisa_saldo, 0, ',', '.') . '</span>';
            $data[] = [
                'no' => $no++,
                'bulan' => $row->bulan,
                'total_pemasukan' => $total_pemasukan,
                'total_pengeluaran' => $total_pengeluaran,
                'sisa_saldo' => $sisa_saldo,
                'jumlah_transaksi' => $row->jumlah_transaksi,
                'aksi' => $aksi
            ];
        }
        return $this->response->setJSON([
            'data' => $data
        ]);
    }

    public function detail($bulan_num, $tahun, $bulan)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }


        $data = [
            'title' => 'Detil Rekap | Kendali Uang',
            'bulan_num' => $bulan_num,
            'bulan' => $bulan,
            'tahun' => $tahun
        ];
        return view('rekap/detil', $data);
    }

    public function get_detil_rekap()
    {
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $id_user = session()->get('id_user');

        $query = "SELECT a.*, b.nama_pemasukan, c.nama_pengeluaran, d.nama_rekening FROM transaksi a 
                LEFT JOIN kat_pemasukan b ON a.id_pemasukan=b.id_pemasukan
                LEFT JOIN kat_pengeluaran c ON a.id_pengeluaran=c.id_pengeluaran
                LEFT JOIN kat_rekening d ON a.id_rekening=d.id_rekening
                WHERE a.id_user=$id_user
                AND MONTH(a.waktu_transaksi) = '$bulan'
                AND YEAR(a.waktu_transaksi) = '$tahun'
                ORDER BY a.waktu_transaksi DESC";

        $detil_transaksi = $this->get_model->get_data_array($query);

        $data = array();
        $no = 1;
        foreach ($detil_transaksi as $row) {
            switch ($row->type) {
                case '1':
                    $kategori = $row->nama_pemasukan;
                    $jumlah = '<span class="text-success text-right">+ ' . number_format($row->jumlah, 0, ',', '.') . '</span>';
                    break;
                case '2':
                    $kategori = $row->nama_pengeluaran;
                    $jumlah = '<span class="text-danger text-right">- ' . number_format($row->jumlah, 0, ',', '.') . '</span>';
                    break;

                default:
                    # code...
                    break;
            }
            $waktu_transaksi = format_tgl($row->waktu_transaksi);
            $data[] = [
                'no' => $no++,
                'waktu_transaksi' => $waktu_transaksi,
                'judul' => $row->judul,
                'kategori' => $kategori,
                'rekening' => $row->nama_rekening,
                'jumlah' => $jumlah,
                'desc' => $row->desc
            ];
        }
        return $this->response->setJSON([
            'data' => $data
        ]);
    }
}
