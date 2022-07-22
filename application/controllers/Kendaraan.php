<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kendaraan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Kendaraan_model');
    }

    public function index()
    {
        $data['judul'] = "Beranda - GalDelivery";
        $data['user'] = $this->db->get_where('admin', ['admin_email' => $this->session->userdata('email')])->row_array();
        $data['kendaraan'] = $this->Kendaraan_model->get();
        $this->load->view("backend/layout/header", $data);
        $this->load->view("backend/kendaraan/vw_datakendaraan", $data);
        $this->load->view("backend/layout/footer", $data);
    }

    
    public function hapus($id)
    {
        $result = $this->Kendaraan_model->delete($id);
        if (!$result) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i> Data Kendaraan tidak dapat dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i> Data Kendaraan Berhasil Dihapus!</div>');
        }
        redirect('kendaraan');
    }

    public function tambah()
    {
        $data['judul'] = "Tambah Kendaraan - GalDelivery";
        $data['user'] = $this->db->get_where('admin', ['admin_email' => $this->session->userdata('email')])->row_array();
        
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Nama Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('jenis', 'Jenis', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Jenis Wajib diisi!</div>',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("backend/layout/header", $data);
            $this->load->view("backend/kendaraan/vw_tambahkendaraan", $data);
            $this->load->view("backend/layout/footer", $data);
        } else {


            $data = [
                'nama_kendaraan' => $this->input->post('nama'),
                'jenis_kendaraan' => $this->input->post('jenis'),
            ];

                $result = $this->Kendaraan_model->insert($data);
                if($result){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kendaraan Berhasil Ditambah!</div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Kendaraan Gagal Ditambah!</div>');
                }
                redirect('kendaraan');
        }
    }

    public function edit($id)
    {
        $data['judul'] = "Tambah Kendaraan - GalDelivery";
        $data['user'] = $this->db->get_where('admin', ['admin_email' => $this->session->userdata('email')])->row_array();
        $data['kendaraan'] = $this->Kendaraan_model->getById($id);
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Nama Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('jenis', 'Jenis', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Jenis Wajib diisi!</div>',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("backend/layout/header", $data);
            $this->load->view("backend/kendaraan/vw_editkedaraan", $data);
            $this->load->view("backend/layout/footer", $data);
        } else {


            $data = [
                'nama_kendaraan' => $this->input->post('nama'),
                'jenis_kendaraan' => $this->input->post('jenis'),
            ];

                $result = $this->Kendaraan_model->update(['id_kendaraan' => $id], $data);
                if($result){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kendaraan Berhasil Ditambah!</div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Kendaraan Gagal Ditambah!</div>');
                }
                redirect('kendaraan');
        }
    }

    public function editKendaraan($id)
    {
        $data['judul'] = "Tambah Kendaraan - SiKendaraan";
        $data['user'] = $this->db->get_where('tbl_user', ['user_email' => $this->session->userdata('email')])->row_array();
        $data['Kendaraan'] = $this->Kendaraan_model->getMyKendaraanById($id);
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
            $this->load->view("backend/vw_editKendaraan", $data);
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
                'Kendaraan_nama' => $this->input->post('nama'),
                'Kendaraan_jenis' => $this->input->post('jenis'),
                'Kendaraan_harga' => $this->input->post('harga'),
                'Kendaraan_alamat' => $this->input->post('alamat'),
                'Kendaraan_diskripsi' => $this->input->post('deskripsi'),
                'user_id' => $this->session->userdata('id'),
                'Kendaraan_gambar' => $upload_image,
            ];
                $id = $this->input->post('id');
                $result = $this->Kendaraan_model->update(['kendaraan_id' => $id], $data);
                if($result){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kendaraan Berhasil Disimpan!</div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Kendaraan Gagal Disimpan!</div>');
                }
                redirect('beranda/myKendaraan');
        }
    }


}
