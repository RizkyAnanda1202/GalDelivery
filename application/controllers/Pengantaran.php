<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengantaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Pengantaran_model');
    }

    public function index()
    {
        $data['judul'] = "Pengantaran - GalDelivery";
        $data['user'] = $this->db->get_where('admin', ['admin_email' => $this->session->userdata('email')])->row_array();
        $data['pengiriman'] = $this->Pengantaran_model->get();
        $this->load->view("backend/layout/header", $data);
        $this->load->view("backend/pengantaran/vw_datapengantaran", $data);
        $this->load->view("backend/layout/footer", $data);
    }

    
    public function hapus($id)
    {
        $result = $this->Pengantaran_model->delete($id);
        if (!$result) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i> Data Pengantaran tidak dapat dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i> Data Pengantaran Berhasil Dihapus!</div>');
        }
        redirect('pengantaran');
    }

    public function tambah()
    {
        $data['judul'] = "Tambah Kendaraan - GalDelivery";
        $data['user'] = $this->db->get_where('admin', ['admin_email' => $this->session->userdata('email')])->row_array();
        $data['staff'] = $this->Pengantaran_model->getstaff();
        $data['kendaraan'] = $this->Pengantaran_model->getkendaraan();
        $this->form_validation->set_rules('staff', 'Staff', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Staff Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('kendaraan', 'Kendaraan', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Kendaraan Wajib diisi!</div>',
        ]);

        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required', [
            'required' => '<div class="alert alert-danger" role="alert">Jumlah Wajib diisi!</div>',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("backend/layout/header", $data);
            $this->load->view("backend/pengantaran/vw_tambahpengantaran", $data);
            $this->load->view("backend/layout/footer", $data);
        } else {


            $data = [
                'id_staff' => $this->input->post('staff'),
                'id_kendaraan' => $this->input->post('kendaraan'),
                'jumlah_galon' => $this->input->post('jumlah'),
                'tgl_pengiriman' => date('Y-m-d'),
            ];

                $result = $this->Pengantaran_model->insert($data);
                if($result){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengantaran Berhasil Ditambah!</div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Pengantaran Gagal Ditambah!</div>');
                }
                redirect('pengantaran');
        }
    }


}
