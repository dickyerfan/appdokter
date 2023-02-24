<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JadwalPeriksa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_jadwalPeriksa');
        $this->load->library('form_validation');

        if ($this->session->userdata('level') == 'Dokter') {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Anda harus login sebagai Resepsionis...
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
        $data['title'] = 'Jadwal Tanggal Periksa Pasien';
        $data['jadwalPeriksa'] = $this->Model_jadwalPeriksa->getAllJadwalPeriksa();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('jadwalPeriksa/jadwalPeriksaView', $data);
        $this->load->view('templates/footer');
    }

    public function inputTanggal()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim|is_unique[tanggal_pasien.tanggal]');
        $this->form_validation->set_message('required', '%s masih kosong');
        $this->form_validation->set_message('is_unique', '%s sudah terdaftar');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error,</strong> Tanggal Praktek Gagal di tambahkan
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('JadwalPeriksa');
        } else {
            $data['tambah'] = $this->Model_jadwalPeriksa->tambahData();
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Tanggal Praktek berhasil di tambahkan
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('JadwalPeriksa');
        }
    }

    public function detailPraktek($id_tanggal)
    {
        $data['title'] = 'Detail Jadwal Praktek';
        $data['detailPasien'] = $this->Model_jadwalPeriksa->getJadwalPasien($id_tanggal);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('jadwalPeriksa/detailPeriksaView', $data);
        $this->load->view('templates/footer');
    }

    // public function inputPasien()
    // {
    //     $this->form_validation->set_rules('id_pasien', 'id_pasien', 'required|trim|is_unique[data_pasien.id_pasien]');
    //     $this->form_validation->set_rules('id_jam', 'id_jam', 'required|trim|is_unique[jam_periksa.id_jam]');
    //     $this->form_validation->set_rules('id_tanggal', 'id_tanggal', 'required|trim');
    //     $this->form_validation->set_message('required', '%s masih kosong');
    //     $this->form_validation->set_message('is_unique', '%s sudah terdaftar');

    //     if ($this->form_validation->run() == false) {
    //         $this->session->set_flashdata(
    //             'info',
    //             '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //                 <strong>Error,</strong> Jadwal Pasien baru Gagal di tambahkan
    //                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    //                 </button>
    //             </div>'
    //         );
    //         redirect('JadwalPeriksa');
    //     } else {
    //         $data['tambah'] = $this->Model_jadwalPeriksa->tambahJadwalPasien();
    //         $this->session->set_flashdata(
    //             'info',
    //             '<div class="alert alert-primary alert-dismissible fade show" role="alert">
    //                 <strong>Sukses,</strong> Jadwal Pasien baru berhasil di tambahkan
    //                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    //                 </button>
    //             </div>'
    //         );
    //         redirect('JadwalPeriksa');
    //     }
    // }

    public function inputJadwalPasien()
    {
        $data['title'] = 'Tambah Jadwal Pasien Baru';
        $this->form_validation->set_rules('id_pasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('id_jam', 'Jam Praktek', 'required|trim');
        $this->form_validation->set_rules('id_tanggal', 'Tanggal Praktek', 'required|trim');
        $this->form_validation->set_message('required', '%s masih kosong');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidebar');
            $this->load->view('jadwalPeriksa/inputJadwalPasienView', $data);
            $this->load->view('templates/footer');
        } else {
            $cekNamaPasien = $this->db->get_where('jadwal_periksa', ['id_tanggal' => $this->input->post('id_tanggal'), 'id_pasien' => $this->input->post('id_pasien')])->row();
            if ($cekNamaPasien) {
                $this->session->set_flashdata(
                    'info',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> Nama Pasien sudah terdaftar
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>'
                );
                redirect('JadwalPeriksa');
            } else {
                $cekJam = $this->db->get_where('jadwal_periksa', ['id_tanggal' => $this->input->post('id_tanggal'), 'id_jam' => $this->input->post('id_jam')])->row();
                if ($cekJam) {
                    $this->session->set_flashdata(
                        'info',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Maaf,</strong> Jam Praktek sudah digunakan
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>'
                    );
                    redirect('JadwalPeriksa');
                } else {
                    $data['tambah'] = $this->Model_jadwalPeriksa->inputJadwalPasien();
                    $this->session->set_flashdata(
                        'info',
                        '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>Sukses,</strong> Jadwal Pasien baru berhasil di tambahkan
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>'
                    );
                    redirect('JadwalPeriksa');
                }
            }
        }
    }

    public function editTanggal()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim|is_unique[tanggal_pasien.tanggal]');
        // $this->form_validation->set_rules('ket_tanggal', 'Keterangan', 'required|trim');
        $this->form_validation->set_message('required', '%s masih kosong');
        $this->form_validation->set_message('is_unique', '%s sudah terdaftar');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error,</strong> Tanggal Praktek Gagal di edit
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('JadwalPeriksa');
        } else {
            $this->Model_jadwalPeriksa->editData();
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Tanggal Praktek berhasil di edit
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('JadwalPeriksa');
        }
    }

    // public function hapus($id)
    // {
    //     $this->Model_jadwalPasien->hapusData($id);
    //     $this->session->set_flashdata(
    //         'info',
    //         '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //                 <strong>Sukses,</strong> Data Pasien berhasil di Hapus
    //                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    //                 </button>
    //               </div>'
    //     );
    //     redirect('JadwalPasien');
    // }
}
