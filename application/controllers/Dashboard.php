<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    private function _cekRole()
    {
        if ($this->session->userdata('role') === 'STAFF') {
            redirect('dashboard/jual');
        }
    }

    public function index()
    {
        $this->_cekRole();
        $data['title'] = 'Mitra Cell | Dashboard';
        $data['active_navbar'] = 'dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index');
        $this->load->view('templates/footer');
    }
    public function kategori()
    {
        $this->_cekRole();
        $data['title'] = 'Mitra Cell | Kategori';
        $data['active_navbar'] = 'kategori';
        $data['kategori'] = $this->ModelKategori->getKategori();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/kategori', $data);
        $this->load->view('templates/footer');
    }
    public function addKategori()
    {
        $this->_cekRole();
        $this->form_validation->set_rules(
            'nama_kategori',
            'nama kategori',
            'required|min_length[3]|is_unique[kategori.kategori_nama]',
            [
                'required' => 'Nama Kategori Harus diisi',
                'min_length' => 'Nama Kategori terlalu pendek',
                'is_unique' => 'Nama Kategori Sudah Ada'
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->kategori();
        } else {
            $data = [
                'kategori_nama' => $this->input->post('nama_kategori')
            ];
            $this->ModelKategori->addKategori($data);
            $this->session->set_flashdata('pesan_tambah', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menambah Kategori<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
            redirect('dashboard/kategori');
        }
    }

    public function updateKategori()
    {
        $this->_cekRole();
        $this->form_validation->set_rules(
            'update_nama_kategori',
            'nama kategori',
            'required|min_length[3]|is_unique[kategori.kategori_nama]',
            [
                'required' => 'Nama Kategori Harus diisi',
                'min_length' => 'Nama Kategori terlalu pendek',
                'is_unique' => 'Nama Kategori Sudah Ada'
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->kategori();
        } else {
            $data = [
                'kategori_nama' => $this->input->post('update_nama_kategori')
            ];
            $this->ModelKategori->updateKategori($data, ['id' => $this->input->post('id')]);
            $this->session->set_flashdata('pesan_update', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Mengubah Kategori <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
            redirect('dashboard/kategori');
        }
    }

    public function hapusKategori($id)
    {
        $this->_cekRole();
        $this->ModelKategori->deleteKategori(['id' => $id]);
        $this->session->set_flashdata('pesan_delete', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menghapus Kategori<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
        redirect('dashboard/kategori');
    }

    private function ToNumber($currencyString)
    {
        // Hilangkan karakter non-angka, termasuk "Rp" dan tanda titik
        $cleanedString = preg_replace("/[^0-9]/", "", $currencyString);
        // Konversi ke tipe data integer
        $number = (int) $cleanedString;

        return $number;
    }

    public function jual()
    {
        $data['title'] = 'Mitra Cell | Jual';
        $data['active_navbar'] = 'jual';
        $data['barang'] = $this->ModelBarang->getBarang();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/jual', $data);
        $this->load->view('templates/footer');
    }

    public function addJual()
    {
        $this->form_validation->set_rules(
            'kode[]',
            'Kode',
            'required',
            [
                'required' => 'Tidak Ada Barang Di Table Jual',
            ]
        );
        $this->form_validation->set_rules(
            'diskon[]',
            'diskon',
            'required',
            [
                'required' => 'Masukan Diskon Setidaknya 0 Atau Lebih',
            ]
        );
        $this->form_validation->set_rules(
            'qty[]',
            'qty',
            'required',
            [
                'required' => 'Masukan Qty Setidaknya 1',
            ]
        );
        $this->form_validation->set_rules(
            'jumlah_uang',
            'Jumlah Uang',
            'required',
            [
                'required' => 'Jumlah Uang Harus',
            ]
        );
        $this->form_validation->set_rules(
            'total_harga',
            'total harga',
            'required',
            [
                'required' => 'Total Harga Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'kembalian',
            'kembalian',
            'required',
            [
                'required' => 'Kembalian Harus Ada',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->jual();
        } else {
            $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
            $kode_values = $this->input->post('kode');
            $nama_barang_values = $this->input->post('nama_barang');
            $harpok_values = $this->input->post('harpok');
            $harjul_values = $this->input->post('harjul');
            $stok_values = $this->input->post('stok');
            $qty_values = $this->input->post('qty');
            $diskon_values = $this->input->post('diskon');
            $total_values = $this->input->post('total');
            $total_harga = $this->input->post('total_harga');
            $jumlah_uang = $this->input->post('jumlah_uang');
            $kembalian = $this->input->post('kembalian');
            $tanggal_sekarang = date('YmdHis');
            $data_detail_jual = [];
            $data_stok = [];
            $data_jual = [
                'nofak' => $tanggal_sekarang . $getId->user_id,
                'total' => $this->toNumber($total_harga),
                'jml_uang' => $this->toNumber($jumlah_uang),
                'kembalian' => $this->toNumber($kembalian),
                'user_id' => $getId->user_id
            ];

            foreach ($kode_values as $index => $kode) {
                $nama_barang = $nama_barang_values[$index];
                $harpok = $this->toNumber($harpok_values[$index]);
                $harjul = $this->toNumber($harjul_values[$index]);
                $stok = $stok_values[$index];
                $qty = $qty_values[$index];
                $diskon = $diskon_values[$index];
                $total = $this->toNumber($total_values[$index]);
                $data_detail_jual[] = [
                    'jual_nofak' => $tanggal_sekarang . $getId->user_id,
                    'barang_kode' => $kode,
                    'nama' => $nama_barang,
                    'harpok' => $harpok,
                    'harjul' => $harjul,
                    'qty' => $qty,
                    'diskon' => $diskon,
                    'total' => $total,
                ];
                $data_stok[] = [
                    'stok' => $stok - $qty,
                    'kode' => $kode,
                ];
            }
            $this->ModelBarang->updateBarangBatch($data_stok);
            $this->ModelJual->addJual($data_jual);
            $this->ModelJual->addDetailJual($data_detail_jual);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Jual<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('dashboard/jual');
        }
    }


    public function barang()
    {
        $this->_cekRole();
        $data['title'] = 'Mitra Cell | Barang';
        $data['active_navbar'] = 'barang';
        $data['barang'] = $this->ModelBarang->getBarang();
        $data['kategori'] = $this->ModelKategori->getKategori();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/barang', $data);
        $this->load->view('templates/footer');
    }
    public function addBarang()
    {
        $this->_cekRole();
        $this->form_validation->set_rules(
            'kode',
            'Kode',
            'required|min_length[3]|is_unique[barang.kode]',
            [
                'required' => 'Kode Harus diisi',
                'min_length' => 'Kode terlalu pendek',
                'is_unique' => 'Kode Sudah Ada'
            ]
        );
        $this->form_validation->set_rules(
            'nama_barang',
            'nama barang',
            'required|min_length[3]|is_unique[barang.nama]',
            [
                'required' => 'Nama Barang Harus diisi',
                'min_length' => 'Nama Barang terlalu pendek',
                'is_unique' => 'Nama Barang Sudah Ada'
            ]
        );
        $this->form_validation->set_rules(
            'harpok',
            'harga pokok',
            'required|min_length[1]|numeric',
            [
                'required' => 'Harga Pokok Harus diisi',
                'min_length' => 'Harga Pokok terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'harjul',
            'harga Jual',
            'required|min_length[1]|numeric',
            [
                'required' => 'Harga Jual Harus diisi',
                'min_length' => 'Harga Jual terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'harjul',
            'harga Jual',
            'required|min_length[1]|numeric',
            [
                'required' => 'Harga Jual Harus diisi',
                'min_length' => 'Harga Jual terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'stok',
            'Stok',
            'required|min_length[1]|numeric',
            [
                'required' => 'Stok Harus diisi',
                'min_length' => 'Stok terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'id_kategori',
            'Kategori',
            'required|min_length[1]|numeric',
            [
                'required' => 'Kategori Harus diisi',
                'min_length' => 'Kategori terlalu pendek',
                'numeric' => 'Kategori Harus diisi'
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->barang();
        } else {
            $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
            $data = [
                'kode' => 'BR-' . $this->input->post('kode'),
                'nama' => $this->input->post('nama_barang'),
                'harpok' => $this->input->post('harpok'),
                'harjul' => $this->input->post('harjul'),
                'stok' => $this->input->post('stok'),
                'kategori_id' => $this->input->post('id_kategori'),
                'user_id' => $getId->user_id,

            ];
            $this->ModelBarang->addBarang($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menambah Barang<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
            redirect('dashboard/barang');
        }
    }

    public function updateBarang()
    {
        $this->_cekRole();
        $kode = $this->input->post('kode-old');
        $nama_barang = $this->input->post('nama-old');
        $query_kode = $this->ModelBarang->getWhereBarang(['kode' => $kode])->row()->kode;
        $query_nama_barang = $this->ModelBarang->getWhereBarang(['nama' => $nama_barang])->row()->nama;
        $query_kode != $this->input->post('kode') &&
            $this->form_validation->set_rules(
                'kode',
                'Kode',
                'required|min_length[3]|is_unique[barang.kode]',
                [
                    'required' => 'Kode Harus diisi',
                    'min_length' => 'Kode terlalu pendek',
                    'is_unique' => 'Kode Sudah Ada'
                ]
            );

        $query_nama_barang != $this->input->post('nama_barang') &&
            $this->form_validation->set_rules(
                'nama_barang',
                'nama barang',
                'required|min_length[3]|is_unique[barang.nama]',
                [
                    'required' => 'Nama Barang Harus diisi',
                    'min_length' => 'Nama Barang terlalu pendek',
                    'is_unique' => 'Nama Barang Sudah Ada'
                ]
            );
        $this->form_validation->set_rules(
            'harpok',
            'harga pokok',
            'required|min_length[1]|numeric',
            [
                'required' => 'Harga Pokok Harus diisi',
                'min_length' => 'Harga Pokok terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'harjul',
            'harga Jual',
            'required|min_length[1]|numeric',
            [
                'required' => 'Harga Jual Harus diisi',
                'min_length' => 'Harga Jual terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'harjul',
            'harga Jual',
            'required|min_length[1]|numeric',
            [
                'required' => 'Harga Jual Harus diisi',
                'min_length' => 'Harga Jual terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'stok',
            'Stok',
            'required|min_length[1]|numeric',
            [
                'required' => 'Stok Harus diisi',
                'min_length' => 'Stok terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'id_kategori',
            'Kategori',
            'required|min_length[1]|numeric',
            [
                'required' => 'Kategori Harus diisi',
                'min_length' => 'Kategori terlalu pendek',
                'numeric' => 'Kategori Harus diisi'
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->barang();
        } else {
            $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama_barang'),
                'harpok' => $this->input->post('harpok'),
                'harjul' => $this->input->post('harjul'),
                'stok' => $this->input->post('stok'),
                'kategori_id' => $this->input->post('id_kategori'),
                'user_id_last_updated' => $getId->user_id,
                'updatedAt' => date("Y-m-d H:i:s"),
            ];
            $this->ModelBarang->updateBarang($data, ['id' => $this->input->post('id')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Update Barang<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('dashboard/barang');
        }
    }

    public function deleteBarang($id)
    {
        $this->_cekRole();
        $this->ModelBarang->deleteBarang(['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Hapus Barang<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('dashboard/barang');
    }

    public function supplier()
    {
        $this->_cekRole();
        $data['title'] = 'Mitra Cell | Supplier';
        $data['active_navbar'] = 'supplier';
        $data['supplier'] = $this->ModelSupplier->getSupplier();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/supplier', $data);
        $this->load->view('templates/footer');
    }
    public function addSupplier()
    {
        $this->_cekRole();
        $this->form_validation->set_rules(
            'kode',
            'Kode',
            'required|min_length[3]|is_unique[supplier.kode]',
            [
                'required' => 'Kode Harus diisi',
                'min_length' => 'Kode terlalu pendek',
                'is_unique' => 'Kode Sudah Ada'
            ]
        );
        $this->form_validation->set_rules(
            'nama_supplier',
            'Nama Supplier',
            'required|min_length[3]|is_unique[supplier.nama]',
            [
                'required' => 'Nama Supplier Harus diisi',
                'min_length' => 'Nama Supplier terlalu pendek',
                'is_unique' => 'Nama Suplier Sudah Ada'
            ]
        );
        $this->form_validation->set_rules(
            'alamat',
            'alamat',
            'required|min_length[3]',
            [
                'required' => 'Alamat Harus diisi',
                'min_length' => 'Alamat terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'no_telp',
            'No Telp',
            'required|min_length[3]|numeric',
            [
                'required' => 'No Telp Harus diisi',
                'min_length' => 'No Telp terlalu pendek',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->supplier();
        } else {
            $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama_supplier'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'user_id' => $getId->user_id,
            ];
            $this->ModelSupplier->addSupplier($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menambah Supplier<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('dashboard/supplier');
        }
    }
    public function updateSupplier()
    {
        $this->_cekRole();
        $kode = $this->input->post('kode-old');
        $nama_supplier = $this->input->post('nama-old');
        $query_kode = $this->ModelSupplier->getWhereSupplier(['kode' => $kode])->row()->kode;
        $query_nama_supplier = $this->ModelSupplier->getWhereSupplier(['nama' => $nama_supplier])->row()->nama;
        $query_kode != $this->input->post('kode') &&
            $this->form_validation->set_rules(
                'kode',
                'Kode',
                'required|min_length[3]|is_unique[supplier.kode]',
                [
                    'required' => 'Kode Harus diisi',
                    'min_length' => 'Kode terlalu pendek',
                    'is_unique' => 'Kode Sudah Ada'
                ]
            );
        $query_nama_supplier != $this->input->post('nama_supplier') &&
            $this->form_validation->set_rules(
                'nama_supplier',
                'Nama Supplier',
                'required|min_length[3]|is_unique[supplier.nama]',
                [
                    'required' => 'Nama Supplier Harus diisi',
                    'min_length' => 'Nama Supplier terlalu pendek',
                    'is_unique' => 'Nama Supplier Sudah Ada'
                ]
            );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required|min_length[3]',
            [
                'required' => 'Alamat Harus diisi',
                'min_length' => 'Alamat terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required|min_length[3]',
            [
                'required' => 'Alamat Harus diisi',
                'min_length' => 'Alamat terlalu pendek',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->supplier();
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama_supplier'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'updatedAt' => date("Y-m-d H:i:s"),
            ];
            $this->ModelSupplier->updateSupplier($data, ['kode' => $this->input->post('kode-old')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Mengubah Supplier <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
            redirect('dashboard/supplier');
        }
    }
    public function deleteSupplier($kode)
    {
        $this->_cekRole();
        $this->ModelSupplier->deleteSupplier(['kode' => $kode]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menghapus Supplier<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
        redirect('dashboard/supplier');
    }

    public function beli (){
        $this->_cekRole();
        $data['title'] = 'Mitra Cell | beli';
        $data['active_navbar'] = 'beli';
        $data['barang'] = $this->ModelBarang->getBarang();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/beli', $data);
        $this->load->view('templates/footer');
    }
}
