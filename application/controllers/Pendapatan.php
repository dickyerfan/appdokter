<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendapatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Pendapatan');
        $this->load->library('form_validation');

        if ($this->session->userdata('level') == 'Resepsionis') {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Anda harus login sebagai Dokter...
                      </div>'
            );
            redirect('auth');
        } elseif (!$this->session->userdata('level')) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Anda harus login... 
                      </div>'
            );
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Pendapatan';
        $data['pendapatan'] = $this->Model_Pendapatan->getPendapatanPerbulan();
        $data['totalBulan'] = $this->Model_Pendapatan->totalBulan();

        $this->load->view('templateDokter/header', $data);
        $this->load->view('templateDokter/navbar');
        $this->load->view('templateDokter/sidebar');
        $this->load->view('pendapatan/pendapatanView', $data);
        $this->load->view('templateDokter/footer');
    }
}
