<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        $data['judul'] = "Beranda - GalDelivery";
        $data['user'] = $this->db->get_where('admin', ['admin_email' => $this->session->userdata('email')])->row_array();
        $this->load->view("backend/layout/header", $data);
        $this->load->view("backend/vw_beranda", $data);
        $this->load->view("backend/layout/footer", $data);
    }

    public function mykos()
    {
        $data['judul'] = "Kos Saya - Sikos";
        $data['user'] = $this->db->get_where('tbl_user', ['user_email' => $this->session->userdata('email')])->row_array();
        $data['kos'] = $this->Beranda_model->getMykos();
        $this->load->view("backend/layout/header", $data);
        $this->load->view("backend/vw_mykos", $data);
        $this->load->view("backend/layout/footer", $data);
    }

    public function tambahkos()
    {
        $data['judul'] = "Tambah Kos - Sikos";
        $data['user'] = $this->db->get_where('tbl_user', ['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Nama Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('jenis', 'Jenis', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Jenis Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('harga', 'Harga', 'required|integer', [
            'required' => '<div class="alert alert-danger" role="alert">Harga Wajib diisi!</div>',
            'integer' => '<div class="alert alert-danger" role="alert">Format Harga tidak valid!</div>',
        ]);
        
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Alamat Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Deskripsi Wajib diisi!</div>',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("backend/layout/header", $data);
            $this->load->view("backend/vw_tambahkos", $data);
            $this->load->view("backend/layout/footer", $data);
        } else {
            $upload_image = $_FILES['gambar']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg|jfif';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/images/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')){
                        $this->upload->data('file_name');
                }
            }else{
                $upload_image = "default.jpg";
            }


            $data = [
                'kos_nama' => $this->input->post('nama'),
                'kos_jenis' => $this->input->post('jenis'),
                'kos_harga' => $this->input->post('harga'),
                'kos_alamat' => $this->input->post('alamat'),
                'kos_diskripsi' => $this->input->post('deskripsi'),
                'user_id' => $this->session->userdata('id'),
                'kos_gambar' => $upload_image,
            ];

                $result = $this->Beranda_model->insertKos($data);
                if($result){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kos Berhasil Ditambah!</div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Kos Gagal Ditambah!</div>');
                }
                redirect('beranda/mykos');
        }
    }

    public function editkos($id)
    {
        $data['judul'] = "Tambah Kos - Sikos";
        $data['user'] = $this->db->get_where('tbl_user', ['user_email' => $this->session->userdata('email')])->row_array();
        $data['kos'] = $this->Beranda_model->getMykosById($id);
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Nama Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('jenis', 'Jenis', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Jenis Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('harga', 'Harga', 'required|integer', [
            'required' => '<div class="alert alert-danger" role="alert">Harga Wajib diisi!</div>',
            'integer' => '<div class="alert alert-danger" role="alert">Format Harga tidak valid!</div>',
        ]);
        
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Alamat Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Deskripsi Wajib diisi!</div>',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("backend/layout/header", $data);
            $this->load->view("backend/vw_editkos", $data);
            $this->load->view("backend/layout/footer", $data);
        } else {
            $upload_image = $_FILES['gambar']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg|jfif';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/images/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')){
                        $this->upload->data('file_name');
                }
            }else{
                $upload_image = $this->input->post('oldimage');
            }


            $data = [
                'kos_nama' => $this->input->post('nama'),
                'kos_jenis' => $this->input->post('jenis'),
                'kos_harga' => $this->input->post('harga'),
                'kos_alamat' => $this->input->post('alamat'),
                'kos_diskripsi' => $this->input->post('deskripsi'),
                'user_id' => $this->session->userdata('id'),
                'kos_gambar' => $upload_image,
            ];
                $id = $this->input->post('id');
                $result = $this->Beranda_model->updateKos(['kos_id' => $id], $data);
                if($result){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kos Berhasil Disimpan!</div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Kos Gagal Disimpan!</div>');
                }
                redirect('beranda/mykos');
        }
    }

    public function hapusKos($id)
    {
        $result = $this->Beranda_model->deleteKos($id);
        if (!$result) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i> Data Kos tidak dapat dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i> Data Kos Berhasil Dihapus!</div>');
        }
        redirect('beranda/mykos');
    }

}
