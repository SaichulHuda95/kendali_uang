<?php

namespace App\Controllers;

class Pengaturan extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }



        $data = [
            'title' => 'Pengaturan | Kendali Uang'
        ];
        return view('pengaturan/index', $data);
    }

    public function data_kat_pemasukan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }



        $data = [
            'title' => 'Kategori Pemasukan | Kendali Uang'
        ];
        return view('pengaturan/data_kat_pemasukan', $data);
    }

    public function get_kat_pemasukan()
    {
        $id_user = session()->get('id_user');
        $query = "SELECT * FROM kat_pemasukan WHERE id_user=$id_user";
        $kat_pemasukan = $this->get_model->get_data_array($query);

        $data = array();
        $no = 1;
        foreach ($kat_pemasukan as $row) {
            $aksi = '
                    <button type="button" class="btn btn-xs btn-warning" title="Edit Data" onclick="edit_kat_pemasukan(\'' . $row->id_pemasukan . '\')">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" title="Hapus Data" onclick="hapus_kat_pemasukan(\'' . $row->id_pemasukan . '\', \'' . $row->nama_pemasukan . '\')">
                        <i class="bi bi-trash"></i>
                    </button>';
            $data[] = [
                'no' => $no++,
                'nama_pemasukan' => $row->nama_pemasukan,
                'aksi' => $aksi
            ];
        }
        return $this->response->setJSON([
            'data' => $data
        ]);
    }

    public function tambah_kat_pemasukan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $msg = [
            'data' => view('pengaturan/modaltambahkatpemasukan')
        ];

        echo json_encode($msg);
    }

    public function simpan_kat_pemasukan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_pemasukan = $this->request->getVar('nama_pemasukan');
            $data = [
                'id_user' => session()->get('id_user'),
                'nama_pemasukan' => $nama_pemasukan,
            ];
            $simpan_kat_pemasukan = $this->insert_model->insert_data('kat_pemasukan', $data);

            if ($simpan_kat_pemasukan) {
                $response = [
                    'success' => true,
                    'message' => 'Kategori Pemasukan berhasil ditambahkan'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Kategori Pemasukan gagal ditambahkan'
                ];
            }
        }

        echo json_encode($response);
    }

    public function edit_kat_pemasukan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_pemasukan = $this->request->getVar('id_pemasukan');
        $query = "SELECT * FROM kat_pemasukan WHERE id_pemasukan=$id_pemasukan";
        $data_kat_pemasukan = $this->get_model->get_data_row($query);
        $data = [
            'id_pemasukan' => $id_pemasukan,
            'data_kat_pemasukan' => $data_kat_pemasukan
        ];
        $msg = [
            'data' => view('pengaturan/modaleditkatpemasukan', $data)
        ];
        echo json_encode($msg);
    }

    public function update_kat_pemasukan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_pemasukan = $this->request->getVar('id_pemasukan');
        $nama_pemasukan = $this->request->getVar('nama_pemasukan');
        $data = [
            'nama_pemasukan' => $nama_pemasukan
        ];
        $update_kat_pemasukan = $this->update_model->update_data('kat_pemasukan', 'id_pemasukan', $id_pemasukan, $data);

        if ($update_kat_pemasukan) {
            $response = [
                'success' => true,
                'message' => 'Kategori Pemasukan berhasil diupdate'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Kategori Pemasukan gagal diupdate'
            ];
        }

        echo json_encode($response);
    }

    public function hapus_kat_pemasukan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_pemasukan = $this->request->getVar('id_pemasukan');

        $delete_kat_pemasukan = $this->delete_model->delete_data('kat_pemasukan', 'id_pemasukan', $id_pemasukan);

        if ($delete_kat_pemasukan) {
            $response = [
                'success' => true,
                'message' => 'Kategori Pemasukan berhasil dihapus'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Kategori Pemasukan gagal dihapus'
            ];
        }

        echo json_encode($response);
    }

    public function data_kat_pengeluaran()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }



        $data = [
            'title' => 'Kategori Pengeluaran | Kendali Uang'
        ];
        return view('pengaturan/data_kat_pengeluaran', $data);
    }

    public function get_kat_pengeluaran()
    {
        $id_user = session()->get('id_user');
        $query = "SELECT * FROM kat_pengeluaran WHERE id_user=$id_user";
        $kat_pengeluaran = $this->get_model->get_data_array($query);

        $data = array();
        $no = 1;
        foreach ($kat_pengeluaran as $row) {
            $aksi = '
                    <button type="button" class="btn btn-xs btn-warning" title="Edit Data" onclick="edit_kat_pengeluaran(\'' . $row->id_pengeluaran . '\')">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" title="Hapus Data" onclick="hapus_kat_pengeluaran(\'' . $row->id_pengeluaran . '\', \'' . $row->nama_pengeluaran . '\')">
                        <i class="bi bi-trash"></i>
                    </button>';
            $data[] = [
                'no' => $no++,
                'nama_pengeluaran' => $row->nama_pengeluaran,
                'aksi' => $aksi
            ];
        }
        return $this->response->setJSON([
            'data' => $data
        ]);
    }

    public function tambah_kat_pengeluaran()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $msg = [
            'data' => view('pengaturan/modaltambahkatpengeluaran')
        ];

        echo json_encode($msg);
    }

    public function simpan_kat_pengeluaran()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_pengeluaran = $this->request->getVar('nama_pengeluaran');
            $data = [
                'id_user' => session()->get('id_user'),
                'nama_pengeluaran' => $nama_pengeluaran,
            ];
            $simpan_kat_pengeluaran = $this->insert_model->insert_data('kat_pengeluaran', $data);

            if ($simpan_kat_pengeluaran) {
                $response = [
                    'success' => true,
                    'message' => 'Kategori Pengeluaran berhasil ditambahkan'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Kategori Pengeluaran gagal ditambahkan'
                ];
            }
        }

        echo json_encode($response);
    }

    public function edit_kat_pengeluaran()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_pengeluaran = $this->request->getVar('id_pengeluaran');
        $query = "SELECT * FROM kat_pengeluaran WHERE id_pengeluaran=$id_pengeluaran";
        $data_kat_pengeluaran = $this->get_model->get_data_row($query);
        $data = [
            'id_pengeluaran' => $id_pengeluaran,
            'data_kat_pengeluaran' => $data_kat_pengeluaran
        ];
        $msg = [
            'data' => view('pengaturan/modaleditkatpengeluaran', $data)
        ];
        echo json_encode($msg);
    }

    public function update_kat_pengeluaran()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_pengeluaran = $this->request->getVar('id_pengeluaran');
        $nama_pengeluaran = $this->request->getVar('nama_pengeluaran');
        $data = [
            'nama_pengeluaran' => $nama_pengeluaran
        ];
        $update_kat_pengeluaran = $this->update_model->update_data('kat_pengeluaran', 'id_pengeluaran', $id_pengeluaran, $data);

        if ($update_kat_pengeluaran) {
            $response = [
                'success' => true,
                'message' => 'Kategori Pengeluaran berhasil diupdate'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Kategori Pengeluaran gagal diupdate'
            ];
        }

        echo json_encode($response);
    }

    public function hapus_kat_pengeluaran()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_pengeluaran = $this->request->getVar('id_pengeluaran');

        $delete_kat_pengeluaran = $this->delete_model->delete_data('kat_pengeluaran', 'id_pengeluaran', $id_pengeluaran);

        if ($delete_kat_pengeluaran) {
            $response = [
                'success' => true,
                'message' => 'Kategori Pengeluaran berhasil dihapus'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Kategori Pengeluaran gagal dihapus'
            ];
        }

        echo json_encode($response);
    }

    public function data_kat_rekening()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }



        $data = [
            'title' => 'Kategori Rekening | Kendali Uang'
        ];
        return view('pengaturan/data_kat_rekening', $data);
    }

    public function get_kat_rekening()
    {
        $id_user = session()->get('id_user');
        $query = "SELECT * FROM kat_rekening WHERE id_user=$id_user";
        $kat_rekening = $this->get_model->get_data_array($query);

        $data = array();
        $no = 1;
        foreach ($kat_rekening as $row) {
            $aksi = '
                    <button type="button" class="btn btn-xs btn-warning" title="Edit Data" onclick="edit_kat_rekening(\'' . $row->id_rekening . '\')">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" title="Hapus Data" onclick="hapus_kat_rekening(\'' . $row->id_rekening . '\', \'' . $row->nama_rekening . '\')">
                        <i class="bi bi-trash"></i>
                    </button>';
            $data[] = [
                'no' => $no++,
                'nama_rekening' => $row->nama_rekening,
                'aksi' => $aksi
            ];
        }
        return $this->response->setJSON([
            'data' => $data
        ]);
    }

    public function tambah_kat_rekening()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $msg = [
            'data' => view('pengaturan/modaltambahkatrekening')
        ];

        echo json_encode($msg);
    }

    public function simpan_kat_rekening()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_rekening = $this->request->getVar('nama_rekening');
            $data = [
                'id_user' => session()->get('id_user'),
                'nama_rekening' => $nama_rekening,
            ];
            $simpan_kat_rekening = $this->insert_model->insert_data('kat_rekening', $data);

            if ($simpan_kat_rekening) {
                $response = [
                    'success' => true,
                    'message' => 'Kategori Rekening berhasil ditambahkan'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Kategori Rekening gagal ditambahkan'
                ];
            }
        }

        echo json_encode($response);
    }

    public function edit_kat_rekening()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_rekening = $this->request->getVar('id_rekening');
        $query = "SELECT * FROM kat_rekening WHERE id_rekening=$id_rekening";
        $data_kat_rekening = $this->get_model->get_data_row($query);
        $data = [
            'id_rekening' => $id_rekening,
            'data_kat_rekening' => $data_kat_rekening
        ];
        $msg = [
            'data' => view('pengaturan/modaleditkatrekening', $data)
        ];
        echo json_encode($msg);
    }

    public function update_kat_rekening()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_rekening = $this->request->getVar('id_rekening');
        $nama_rekening = $this->request->getVar('nama_rekening');
        $data = [
            'nama_rekening' => $nama_rekening
        ];
        $update_kat_rekening = $this->update_model->update_data('kat_rekening', 'id_rekening', $id_rekening, $data);

        if ($update_kat_rekening) {
            $response = [
                'success' => true,
                'message' => 'Kategori Rekening berhasil diupdate'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Kategori Rekening gagal diupdate'
            ];
        }

        echo json_encode($response);
    }

    public function hapus_kat_rekening()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_rekening = $this->request->getVar('id_rekening');

        $delete_kat_rekening = $this->delete_model->delete_data('kat_rekening', 'id_rekening', $id_rekening);

        if ($delete_kat_rekening) {
            $response = [
                'success' => true,
                'message' => 'Kategori Rekening berhasil dihapus'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Kategori Rekening gagal dihapus'
            ];
        }

        echo json_encode($response);
    }
}
