<?php

namespace App\Controllers;

class Transaksi extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }


        $data = [
            'title' => 'Transaksi | Kendali Uang'
        ];
        return view('transaksi/index', $data);
    }

    public function get_transaksi()
    {
        $id_user = session()->get('id_user');
        $query = "SELECT a.*, b.nama_pemasukan, c.nama_pengeluaran, d.nama_rekening FROM transaksi a 
                LEFT JOIN kat_pemasukan b ON a.id_pemasukan=b.id_pemasukan
                LEFT JOIN kat_pengeluaran c ON a.id_pengeluaran=c.id_pengeluaran
                LEFT JOIN kat_rekening d ON a.id_rekening=d.id_rekening
                WHERE a.id_user=$id_user
                ORDER BY a.waktu_transaksi DESC";
        $transaksi = $this->get_model->get_data_array($query);

        $data = array();
        $no = 1;
        foreach ($transaksi as $row) {
            $aksi = '
                    <button type="button" class="btn btn-xs btn-warning" title="Edit Data" onclick="edit_transaksi(\'' . $row->id_transaksi . '\')">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" title="Hapus Data" onclick="hapus_transaksi(\'' . $row->id_transaksi . '\', \'' . $row->judul . '\')">
                        <i class="bi bi-trash"></i>
                    </button>';
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
                'desc' => $row->desc,
                'aksi' => $aksi
            ];
        }
        return $this->response->setJSON([
            'data' => $data
        ]);
    }

    public function tambah_transaksi()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $type = $this->request->getVar('type');
        $id_user = session()->get('id_user');

        if ($type == '1') {
            $query_kategori = "SELECT * FROM kat_pemasukan WHERE id_user=$id_user";
        } else {
            $query_kategori = "SELECT * FROM kat_pengeluaran WHERE id_user=$id_user";
        }

        $kategori = $this->get_model->get_data_array($query_kategori);
        $query_kat_rekening = "SELECT * FROM kat_rekening WHERE id_user=$id_user";
        $kat_rekening = $this->get_model->get_data_array($query_kat_rekening);

        $data = [
            'type' => $type,
            'kategori' => $kategori,
            'kat_rekening' => $kat_rekening
        ];

        $msg = [
            'data' => view('transaksi/modaltambahtransaksi', $data)
        ];

        echo json_encode($msg);
    }

    public function simpan_transaksi()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $waktu_transaksi = $this->request->getVar('waktu_transaksi');
            $type = $this->request->getVar('type');
            $id_rekening = $this->request->getVar('id_rekening');
            $jumlah = preg_replace('/[^0-9]/', '', $this->request->getVar('jumlah'));
            $judul = $this->request->getVar('judul');
            $desc = $this->request->getVar('desc');

            if ($type == '1') {
                $id_pemasukan = $this->request->getVar('id_pemasukan');
                $data = [
                    'waktu_transaksi' => $waktu_transaksi,
                    'type' => $type,
                    'id_pemasukan' => $id_pemasukan,
                    'id_rekening' => $id_rekening,
                    'id_user' => session()->get('id_user'),
                    'jumlah' => $jumlah,
                    'judul' => $judul,
                    'desc' => $desc
                ];
            } else {
                $id_pengeluaran = $this->request->getVar('id_pengeluaran');
                $data = [
                    'waktu_transaksi' => $waktu_transaksi,
                    'type' => $type,
                    'id_pengeluaran' => $id_pengeluaran,
                    'id_rekening' => $id_rekening,
                    'id_user' => session()->get('id_user'),
                    'jumlah' => $jumlah,
                    'judul' => $judul,
                    'desc' => $desc
                ];
            }
            $simpan_transaksi = $this->insert_model->insert_data('transaksi', $data);

            if ($simpan_transaksi) {
                $response = [
                    'success' => true,
                    'message' => 'Transaksi berhasil ditambahkan'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Transaksi gagal ditambahkan'
                ];
            }
        }

        echo json_encode($response);
    }

    public function edit_transaksi()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_transaksi = $this->request->getVar('id_transaksi');
        $query = "SELECT a.*, b.nama_pemasukan, c.nama_pengeluaran, d.nama_rekening FROM transaksi a 
                LEFT JOIN kat_pemasukan b ON a.id_pemasukan=b.id_pemasukan
                LEFT JOIN kat_pengeluaran c ON a.id_pengeluaran=c.id_pengeluaran
                LEFT JOIN kat_rekening d ON a.id_rekening=d.id_rekening
                WHERE id_transaksi=$id_transaksi";
        $data_transaksi = $this->get_model->get_data_row($query);

        if ($data_transaksi->type == '1') {
            $query_kategori = "SELECT * FROM kat_pemasukan WHERE id_user=$data_transaksi->id_user";
        } else {
            $query_kategori = "SELECT * FROM kat_pengeluaran WHERE id_user=$data_transaksi->id_user";
        }

        $kategori = $this->get_model->get_data_array($query_kategori);
        $query_kat_rekening = "SELECT * FROM kat_rekening WHERE id_user=$data_transaksi->id_user";
        $kat_rekening = $this->get_model->get_data_array($query_kat_rekening);
        $data = [
            'id_transaksi' => $id_transaksi,
            'data_transaksi' => $data_transaksi,
            'kategori' => $kategori,
            'kat_rekening' => $kat_rekening
        ];
        $msg = [
            'data' => view('transaksi/modaledittransaksi', $data)
        ];
        echo json_encode($msg);
    }

    public function update_transaksi()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_transaksi = $this->request->getVar('id_transaksi');
        $waktu_transaksi = $this->request->getVar('waktu_transaksi');
        $type = $this->request->getVar('type');
        $id_rekening = $this->request->getVar('id_rekening');
        $jumlah = preg_replace('/[^0-9]/', '', $this->request->getVar('jumlah'));
        $judul = $this->request->getVar('judul');
        $desc = $this->request->getVar('desc');

        if ($type == '1') {
            $id_pemasukan = $this->request->getVar('id_pemasukan');
            $data = [
                'waktu_transaksi' => $waktu_transaksi,
                'type' => $type,
                'id_pemasukan' => $id_pemasukan,
                'id_rekening' => $id_rekening,
                'id_user' => session()->get('id_user'),
                'jumlah' => $jumlah,
                'judul' => $judul,
                'desc' => $desc
            ];
        } else {
            $id_pengeluaran = $this->request->getVar('id_pengeluaran');
            $data = [
                'waktu_transaksi' => $waktu_transaksi,
                'type' => $type,
                'id_pengeluaran' => $id_pengeluaran,
                'id_rekening' => $id_rekening,
                'id_user' => session()->get('id_user'),
                'jumlah' => $jumlah,
                'judul' => $judul,
                'desc' => $desc
            ];
        }

        $update_transaksi = $this->update_model->update_data('transaksi', 'id_transaksi', $id_transaksi, $data);

        if ($update_transaksi) {
            $response = [
                'success' => true,
                'message' => 'Transaksi berhasil diupdate'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Transaksi gagal diupdate'
            ];
        }

        echo json_encode($response);
    }

    public function hapus_transaksi()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_transaksi = $this->request->getVar('id_transaksi');

        $delete_transaksi = $this->delete_model->delete_data('transaksi', 'id_transaksi', $id_transaksi);

        if ($delete_transaksi) {
            $response = [
                'success' => true,
                'message' => 'Transaksi berhasil dihapus'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Transaksi gagal dihapus'
            ];
        }

        echo json_encode($response);
    }
}
