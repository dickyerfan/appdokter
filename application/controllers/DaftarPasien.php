<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarPasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_daftarPasien');
        $this->load->library('form_validation');

        if (!$this->session->userdata('level')) {
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
        $data['title'] = 'Daftar Semua Pasien';
        $data['allPasien'] = $this->Model_daftarPasien->getAllPasien();

        if ($this->session->userdata('level') == 'Dokter') {
            $this->load->view('templateDokter/header', $data);
            $this->load->view('templateDokter/navbar');
            $this->load->view('templateDokter/sidebar');
            $this->load->view('daftarPasien/daftarPasien', $data);
            $this->load->view('templateDokter/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('daftarPasien/daftarPasien', $data);
            $this->load->view('templates/footer');
        }
    }

    public function inputPasien()
    {
        $data['title'] = 'Tambah Pasien Baru';
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('alamat_pasien', 'Alamat Pasien', 'required|trim');
        $this->form_validation->set_rules('telepon_pasien', 'Telepon Pasien', 'required|trim|numeric|min_length[10]');
        $this->form_validation->set_rules('jenkel_pasien', 'Jenis Kelamin Pasien', 'required|trim');
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim|numeric|exact_length[16]|is_unique[data_pasien.no_ktp]');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('bpjs', 'No BPJS', 'trim|numeric|regex_match[/^[0-9]{13}+$/]|is_unique[data_pasien.bpjs]');
        $this->form_validation->set_message('required', '%s masih kosong');
        $this->form_validation->set_message('exact_length', '%s harus 16 angka');
        $this->form_validation->set_message('min_length', '%s minimal 10 angka');
        $this->form_validation->set_message('numeric', '%s harus berupa angka');
        $this->form_validation->set_message('regex_match', '%s harus 13 angka');
        $this->form_validation->set_message('is_unique', '%s sudah terdaftar');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('daftarPasien/inputPasien', $data);
            $this->load->view('templates/footer');
        } else {
            $data['tambah'] = $this->Model_daftarPasien->tambahData();
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Pasien baru berhasil di tambahkan
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('DaftarPasien');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Form Edit Data Pasien';
        $data['editPasien'] = $this->Model_daftarPasien->getIdPasien($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('daftarPasien/editPasien', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $this->Model_daftarPasien->updateData();
        if ($this->db->affected_rows() <= 0) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> tidak ada perubahan data
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                      </div>'
            );
            redirect('DaftarPasien');
        } else {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses,</strong> Data Pasien berhasil di update
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                      </div>'
            );
            redirect('DaftarPasien');
        }
    }

    public function hapus($id)
    {
        $this->Model_daftarPasien->hapusData($id);
        $this->session->set_flashdata(
            'info',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Data Pasien berhasil di Hapus
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>'
        );
        redirect('DaftarPasien');
    }

    public function detail($id)
    {
        $data['title'] = 'Riwayat Kunjungan Pasien';
        $data['allPasien'] = $this->Model_daftarPasien->getDetailPasien($id);
        $data['pasienDetail'] = $this->Model_daftarPasien->getPasienDetail($id);

        if ($this->session->userdata('level') == 'Dokter') {
            $this->load->view('templateDokter/header', $data);
            $this->load->view('templateDokter/navbar');
            $this->load->view('templateDokter/sidebar');
            $this->load->view('daftarPasien/daftarPasienDetail', $data);
            $this->load->view('templateDokter/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('daftarPasien/daftarPasienDetail', $data);
            $this->load->view('templates/footer');
        }
    }
}
