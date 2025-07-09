<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->back();
        }

        $data = [
            'title' => 'Login | Kendali Uang',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/register', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|max_length[30]|trim',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'max_length' => 'Username tidak boleh lebih dari 30 karakter'
                ],
            ],
            'password' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Password harus diisi'
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/login')->withInput()->with('validation', $validation);
        } else {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $user = $this->auth_model->get_user($username);
            // jika user ada
            if ($user) {
                session()->setFlashdata('error', 'Username sudah terdaftar');
                return redirect()->to('/register');
            } else {
                // Data tambahan
                $ipAddress     = $this->request->getIPAddress();
                $userAgent     = $this->request->getUserAgent();
                $platform      = $userAgent->getPlatform();
                $browser       = $userAgent->getBrowser();
                $browserVer    = $userAgent->getVersion();

                // Data yang dikirim dari JS (timezone browser)
                $timezone = $this->request->getVar('timezone');
                $data = [
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'ip_address'   => $ipAddress,
                    'user_agent'   => $userAgent->getAgentString(),
                    'platform'     => $platform,
                    'browser'      => $browser . ' ' . $browserVer,
                    'timezone'     => $timezone,
                ];

                $this->insert_model->insert_data('user', $data);
                session()->setFlashdata('success', 'Registrasi berhasil, silahkan login');
                return redirect()->to('/login');
            }
        }
    }
}
