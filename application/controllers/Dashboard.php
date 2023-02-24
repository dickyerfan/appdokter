<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_dashboard');
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
        $data['title'] = 'Dashboard';
        $data['pasien'] = $this->Model_dashboard->getPasien();
        $data['jam'] = $this->Model_dashboard->getJam();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function inputJam()
    {
        $this->form_validation->set_rules('jam', 'Jam Praktek', 'required|trim');
        $this->form_validation->set_rules('ket_jam', 'Keterangan', 'required|trim');
        $this->form_validation->set_message('required', '%s masih kosong');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error,</strong> Jam Praktek Gagal di tambahkan
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('Dashboard');
        } else {
            $this->Model_dashboard->tambahDataJam();
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Sukses,</strong> Jam Praktek berhasil di tambahkan
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('Dashboard');
        }
    }

    public function editJam()
    {
        $this->form_validation->set_rules('jam', 'Jam Praktek', 'required|trim');
        $this->form_validation->set_rules('ket_jam', 'Keterangan', 'required|trim');
        $this->form_validation->set_message('required', '%s masih kosong');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error,</strong> Jam Praktek Gagal di edit
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('Dashboard');
        } else {
            $this->Model_dashboard->editDataJam();
            if ($this->db->affected_rows() <= 0) {
                $this->session->set_flashdata(
                    'info',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> tidak ada perubahan data
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>'
                );
                redirect('Dashboard');
            } else {
                $this->session->set_flashdata(
                    'info',
                    '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Sukses,</strong> Jam Praktek berhasil di edit
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>'
                );
                redirect('Dashboard');
            }
        }
    }

    public function editStatus()
    {
        $this->form_validation->set_rules('status_pasien', 'Status Pasien', 'required|trim');
        $this->form_validation->set_message('required', '%s masih kosong');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'info',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error,</strong> Status Pasien Gagal di edit
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>'
            );
            redirect('Dashboard');
        } else {
            $this->Model_dashboard->editStatus();
            if ($this->db->affected_rows() <= 0) {
                $this->session->set_flashdata(
                    'info',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf,</strong> tidak ada perubahan data
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>'
                );
                redirect('Dashboard');
            } else {
                $cekStatus = $this->db->get_where('jadwal_periksa', ['id_jadwal' => $this->input->post('id_jadwal')])->row();
                if ($cekStatus->status_pasien == 2) {
                    $this->Model_dashboard->updateTindakanPasien();
                }
                $this->session->set_flashdata(
                    'info',
                    '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Sukses,</strong> Status Pasien berhasil di edit
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>'
                );
                redirect('Dashboard');
            }
        }
    }


    // public function ekspor(){
    //     $tanggal = date('d');
    //     $bulan = date('m');
    //     $tahun = date('Y');

    //     switch ($bulan) {
    //         case '01':
    //             $bulan = "Januari";
    //             break;
    //         case '02':
    //             $bulan = "Februari";
    //             break;
    //         case '03':
    //             $bulan = "Maret";
    //             break;
    //         case '04':
    //             $bulan = "April";
    //             break;
    //         case '05':
    //             $bulan = "Mei";
    //             break;
    //         case '06':
    //             $bulan = "Juni";
    //             break;
    //         case '07':
    //             $bulan = "Juli";
    //             break;
    //         case '08':
    //             $bulan = "Agustus";
    //             break;
    //         case '09':
    //             $bulan = "September";
    //             break;
    //         case '10':
    //             $bulan = "Oktober";
    //             break;
    //         case '11':
    //             $bulan = "November";
    //             break;
    //         case '12':
    //             $bulan = "Desember";
    //             break;
    //     }


    //     $this->load->library('pdf');
    //     $pdf = new FPDF('p', 'mm', [325, 215]);
    //     $pdf->AddFont('scada', '', 'scada.php');
    //     $pdf->AddPage();
    //     $pdf->SetFillColor(32, 87, 328,);
    //     // $pdf->Rect(10, 9, 190, 20, 'F');
    //     $pdf->SetFont('scada', '', 11);
    //     $pdf->Image(base_url('assets/img/yrsb.jpg'), 15, 12, 35, 10);
    //     $pdf->Cell(5, 4, '', 0, 0, 'C');
    //     $pdf->Cell(190, 4, 'Yayasan Rumah Sedekah Bondowoso/Aksi Bersama Yatim', 0, 1, 'C');
    //     $pdf->SetFont('scada', '', 13);
    //     $pdf->Cell(5, 7, '', 0, 0, 'C');
    //     $pdf->Cell(190, 7, 'LAPORAN KEUANGAN ', 0, 1, 'C');
    //     $pdf->Image(base_url('assets/img/aby.png'), 170, 10, 30, 12);
    //     $pdf->SetFont('scada', '', 10);
    //     $pdf->Cell(5, 4, '', 0, 0, 'C');
    //     $pdf->Cell(190, 4, 'PER '. $tanggal.' ' . $bulan . ' '  . $tahun, 0, 1, 'C');

    //     $pdf->Cell(10, 1, '', 0, 1);
    //     $pdf->SetFont('scada', '', 9);
    //     $pdf->SetFillColor(29, 117, 240,);
    //     $pdf->Rect(15, 26, 185, 7, 'F');
    //     $pdf->Cell(5, 1, '', 0, 0, 'C',);
    //     $pdf->Cell(185, 1, '', 1, 1, 'C');

    //     $pdf->Cell(5, 6, '', 0, 0, 'C');
    //     $pdf->Cell(10, 6, 'No', 1, 0, 'C');
    //     $pdf->Cell(85, 6, 'Nama Program', 1, 0, 'C');
    //     $pdf->Cell(30, 6, 'Penerimaan', 1, 0, 'C');
    //     $pdf->Cell(30, 6, 'Pengeluaran', 1, 0, 'C');
    //     $pdf->Cell(30, 6, 'Saldo', 1, 1, 'C');

    //     $pdf->SetFont('scada', '', 9);

    //     $jumatMasuk = $this->db->query("SELECT sum(jml_transaksi) as jumatMasuk FROM sedekah_jumat WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0")->result();
    //     foreach ($jumatMasuk as $row) {
    //         $jumatMasuk = $row->jumatMasuk;
    //     }                                          
    //     $jumatKeluar = $this->db->query("SELECT sum(jml_transaksi) as jumatKeluar FROM sedekah_jumat WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0")->result();
    //     foreach ($jumatKeluar as $row) {
    //         $jumatKeluar = $row->jumatKeluar;
    //     }
    //     $saldoJumat = $jumatMasuk - $jumatKeluar; 

    //     $pdf->Cell(5, 6, '', 0, 0, 'C');
    //     $pdf->Cell(10, 6, '1', 1, 0, 'C');
    //     $pdf->Cell(85, 6, 'Sedekah Jum\'at', 1, 0, 'L');
    //     $pdf->Cell(30, 6, number_format($jumatMasuk, '0', ',', '.') , 1, 0, 'R');
    //     $pdf->Cell(30, 6, number_format($jumatKeluar, '0', ',', '.') , 1, 0, 'R');
    //     $pdf->Cell(30, 6, number_format($saldoJumat, '0', ',', '.') , 1, 1, 'R');

    //     $totalTabungan = $this->db->query("SELECT sum(jml_tabungan) as totalTabungan FROM taqur JOIN detail_taqur ON taqur.id_penabung = detail_taqur.id_penabung WHERE detail_taqur.status_tabungan = 1")->result();
    //     foreach ($totalTabungan as $row) {
    //         $totalTabungan = $row->totalTabungan;
    //     } 

    //     $pdf->Cell(5, 6, '', 0, 0, 'C');
    //     $pdf->Cell(10, 6, '2', 1, 0, 'C');
    //     $pdf->Cell(85, 6, 'Tabungan Qurban', 1, 0, 'L');
    //     $pdf->Cell(30, 6, number_format($totalTabungan, '0', ',', '.') , 1, 0, 'R');
    //     $pdf->Cell(30, 6, '0', 1, 0, 'R');
    //     $pdf->Cell(30, 6, number_format($totalTabungan, '0', ',', '.') , 1, 1, 'R');

    //     $transaksi = $this->db->query("SELECT * FROM donasi ")->result();

    //     $no = 2;
    //     foreach ($transaksi as $row) {
    //         $namaDonasi = $row->nama_donasi;
    //         $namaDonasi = preg_replace("/[^a-zA-Z&\']/", " ", $namaDonasi);
    //         $no++;
    //         $pdf->Cell(5, 6, '', 0, 0, 'C');
    //         $pdf->Cell(10, 6, $no, 1, 0, 'C');
    //         $pdf->Cell(85, 6, $namaDonasi, 1, 0, 'L');

    //         $id = $row->id_donasi;
    //         $masuk = $this->db->query("SELECT sum(jml_transaksi) AS masuk FROM donasi JOIN transaksi ON donasi.id_donasi = transaksi.id_donasi WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0 AND transaksi.id_donasi = $id")->result();
    //         foreach ($masuk as $row) {
    //             $masuk = $row->masuk;
    //         }
    //         $keluar = $this->db->query("SELECT sum(jml_transaksi) AS keluar FROM donasi JOIN transaksi ON donasi.id_donasi = transaksi.id_donasi WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0 AND transaksi.id_donasi = $id")->result();
    //         foreach ($keluar as $row) {
    //             $keluar = $row->keluar;
    //         }
    //         $saldo = $masuk - $keluar;
    //         $masuk = number_format($masuk,'0',',','.');
    //         $keluar = number_format($keluar,'0',',','.');
    //         $saldo = number_format($saldo,'0',',','.');

    //         $pdf->Cell(30, 6, $masuk, 1, 0, 'R');
    //         $pdf->Cell(30, 6, $keluar, 1, 0, 'R');
    //         $pdf->Cell(30, 6, $saldo, 1, 1, 'R');
    //     }
    //         $masuk = $this->db->query("SELECT sum(jml_transaksi) AS masuk FROM donasi JOIN transaksi ON donasi.id_donasi = transaksi.id_donasi WHERE jenis_transaksi = 'Penerimaan' AND kode_saldo = 0")->result();
    //         foreach ($masuk as $row) {
    //             $masuk = $row->masuk;
    //         }
    //         $keluar = $this->db->query("SELECT sum(jml_transaksi) AS keluar FROM donasi JOIN transaksi ON donasi.id_donasi = transaksi.id_donasi WHERE jenis_transaksi = 'Pengeluaran' AND kode_saldo = 0")->result();
    //         foreach ($keluar as $row) {
    //             $keluar = $row->keluar;
    //         }

    //         $masuk = $masuk + $jumatMasuk + $totalTabungan;
    //         $keluar = $keluar + $jumatKeluar;
    //         $saldo = $masuk - $keluar;

    //     $pdf->SetFillColor(29, 117, 240,);
    //     $pdf->Cell(5, 6, '', 0, 0, 'C');
    //     $pdf->Cell(95, 6, 'Total', 1, 0, 'C',[29, 117, 240]);
    //     $pdf->Cell(30, 6, number_format($masuk, '0', ',', '.') . ',-', 1, 0, 'R',[29, 117, 240]);
    //     $pdf->Cell(30, 6, number_format($keluar, '0', ',', '.') . ',-', 1, 0, 'R',[29, 117, 240]);
    //     $pdf->Cell(30, 6, number_format($saldo, '0', ',', '.') . ',-', 1, 0, 'R',[29, 117, 240]);
    //     $pdf->Cell(5, 6, '', 0, 1, 'C');
    //     $pdf->Cell(5, 1, '', 0, 0, 'C');
    //     $pdf->Cell(185, 1, '', 1, 1, 'C',[29, 117, 240]);

    //     $pdf->Cell(190, 2, '', 0, 1, 'C');
    //     $pdf->Cell(95, 6, '', 0, 0, 'C');
    //     $pdf->Cell(95, 6, 'Bondowoso,'.' '. $tanggal.' '.$bulan.' '.$tahun, 0, 1, 'C');
    //     $pdf->Cell(95, 6, 'Mengetahui', 0, 0, 'C');
    //     $pdf->Cell(95, 6, 'Dibuat Oleh,', 0, 1, 'C');
    //     $pdf->Cell(95, 6, 'Ketua Yayasan', 0, 0, 'C');
    //     $pdf->Cell(95, 6, 'Bendahara', 0, 1, 'C');
    //     $pdf->Cell(190, 10, '', 0, 1, 'C');
    //     $pdf->Cell(95, 6, 'Abu Fulan', 0, 0, 'C');
    //     $pdf->Cell(95, 6, 'Abu Fulan', 0, 1, 'C');
    //     $pdf->Output('I', 'Laporan Keuangan ABY '.$tanggal . ' '. $bulan . ' ' . $tahun . '.pdf');
    // }

}
