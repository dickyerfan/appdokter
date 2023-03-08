<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_dokter');
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
        $data['title'] = 'Dashboard Dokter';
        $data['pasienDokter'] = $this->Model_dokter->getPasienDokter();

        $this->load->view('templateDokter/header', $data);
        $this->load->view('templateDokter/navbar');
        $this->load->view('templateDokter/sidebar');
        $this->load->view('dokter/dokterView', $data);
        $this->load->view('templateDokter/footer');
    }

    public function inputTindakanDokter()
    {
        $data['title'] = 'Tindakan Dokter';
        $data['tindakan'] = $this->db->get('tindakan')->result();
        $this->form_validation->set_rules('id_tindakan', 'Tindakan 1', 'required|trim');
        // $this->form_validation->set_rules('id_tindakan2', 'Tindakan 2', 'required|trim');
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah tindakan 1', 'required|trim|numeric');
        // $this->form_validation->set_rules('jumlah2', 'Jumlah tindakan 2', 'required|trim|numeric');
        $this->form_validation->set_message('required', '%s masih kosong');
        $this->form_validation->set_message('numeric', '%s harus berupa angka');

        if ($this->form_validation->run() == false) {
            $this->load->view('templateDokter/header', $data);
            $this->load->view('templateDokter/navbar');
            $this->load->view('templateDokter/sidebar');
            $this->load->view('dokter/tindakanDokterView', $data);
            $this->load->view('templateDokter/footer');
        } else {
            $this->Model_dokter->inputTindakan();
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Tindakan Baru berhasil di tambahkan
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('Dokter');
        }
    }

    public function pembayaran()
    {
        $data['title'] = 'Pembayaran';
        // $data['tindakan'] = $this->db->get('tindakan')->result();
        $this->form_validation->set_rules('tagihan', 'Tagihan', 'required|trim');
        $this->form_validation->set_rules('diskon', 'Jumlah Diskon / Potongan', 'required|trim|numeric');
        $this->form_validation->set_message('required', '%s masih kosong');
        $this->form_validation->set_message('numeric', '%s harus berupa angka');

        if ($this->form_validation->run() == false) {
            $this->load->view('templateDokter/header', $data);
            $this->load->view('templateDokter/navbar');
            $this->load->view('templateDokter/sidebar');
            $this->load->view('dokter/pembayaranView', $data);
            $this->load->view('templateDokter/footer');
        } else {
            $this->Model_dokter->pembayaran();
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Pembayaran oleh Pasien
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('Dokter');
        }
    }
}
