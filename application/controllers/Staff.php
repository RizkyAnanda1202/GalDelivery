<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Staff_model');
    }

    public function index()
    {
        $data['judul'] = "Beranda - GalDelivery";
        $data['user'] = $this->db->get_where('admin', ['admin_email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->Staff_model->get();
        $this->load->view("backend/layout/header", $data);
        $this->load->view("backend/staff/vw_datastaff", $data);
        $this->load->view("backend/layout/footer", $data);
    }

    
    public function hapus($id)
    {
        $result = $this->Staff_model->delete($id);
        if (!$result) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i> Data Staff tidak dapat dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i> Data Staff Berhasil Dihapus!</div>');
        }
        redirect('staff');
    }

    public function tambah()
    {
        $data['judul'] = "Tambah Staff - GalDelivery";
        $data['user'] = $this->db->get_where('admin', ['admin_email' => $this->session->userdata('email')])->row_array();
        
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Nama Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Jenis Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('nohp', 'NoHp', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Jenis Wajib diisi!</div>',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("backend/layout/header", $data);
            $this->load->view("backend/staff/vw_tambahstaff", $data);
            $this->load->view("backend/layout/footer", $data);
        } else {


            $data = [
                'nama_staff' => $this->input->post('nama'),
                'alamat_staff' => $this->input->post('alamat'),
                'nohp_staff' => $this->input->post('nohp'),
            ];

                $result = $this->Staff_model->insert($data);
                if($result){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Staff Berhasil Ditambah!</div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Staff Gagal Ditambah!</div>');
                }
                redirect('staff');
        }
    }

    public function edit($id)
    {
        $data['judul'] = "Edit Staff - GalDelivery";
        $data['user'] = $this->db->get_where('admin', ['admin_email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->Staff_model->getById($id);
        
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Nama Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Jenis Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('nohp', 'NoHp', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Jenis Wajib diisi!</div>',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("backend/layout/header", $data);
            $this->load->view("backend/staff/vw_editstaff", $data);
            $this->load->view("backend/layout/footer", $data);
        } else {


            $data = [
                'nama_staff' => $this->input->post('nama'),
                'alamat_staff' => $this->input->post('alamat'),
                'nohp_staff' => $this->input->post('nohp'),
            ];

                $result = $this->Staff_model->update(['id_staff' => $id], $data);
                if($result){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Staff Berhasil Ditambah!</div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Staff Gagal Ditambah!</div>');
                }
                redirect('staff');
        }
    }


}
