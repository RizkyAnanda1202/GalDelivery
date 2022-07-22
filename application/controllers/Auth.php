<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        redirect('/auth/login');
    }

    public function login()
    {
        if ($this->session->userdata('email')) {
            redirect('beranda');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'valid_email' => 'Email Harus Valid',
            'required' => 'Email Wajib diisi',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password Wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = "GalDelivery - Login";
            $this->load->view("auth/vw_login", $data);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->db->get_where('admin', ['admin_email' => $email])->row_array();
            if ($user) {
                if (password_verify($password, $user['admin_password'])) {
                    $data = [
                        'email' => $user['admin_email'],
                        'id' => $user['admin_id'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('beranda');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Belum Terdaftar!</div>');
                redirect('auth/login');
            }
        }
    }

    public function register()
    {
        if ($this->session->userdata('email')) {
            redirect('/');
        }
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'Nama Wajib diisi',
        ]);

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'valid_email' => 'Email Harus Valid',
            'required' => 'Email Wajib diisi',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password Wajib diisi',
        ]);

        $this->form_validation->set_rules('nowa', 'No Wa', 'trim|required', [
            'required' => 'No Wa Wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Pendaftaran - Sikos';
            $this->load->view('auth/vw_register', $data);
        } else {
            $data = [
                'admin_nama' => $this->input->post('nama', true),
                'admin_email' => $this->input->post('email', true),
                'admin_password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ];
            $this->Auth_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat!
                Akunmu telah berhasil terdaftar, Silahkan Login! </div>');
            redirect('auth/login');
        }

    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Logout!</div>');
        redirect('auth/login');
    }

}
