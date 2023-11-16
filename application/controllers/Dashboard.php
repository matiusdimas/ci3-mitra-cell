<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        _cekRole();
        $data['title'] = 'Mitra Cell | Dashboard';
        $data['active_navbar'] = 'dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index');
        $this->load->view('templates/footer');
    }

    // Profile
    public function profile()
    {
        $data['title'] = 'Mitra Cell | Profile';
        $data['active_navbar'] = 'profile';
        $data['profile'] = $this->ModelUser->cekData(['username' => $this->session->userdata('username')])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/profile', $data);
        $this->load->view('templates/footer');
    }
    public function updateProfile()
    {
        $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
        $username_old = $this->session->userdata('username');
        $username_new = $this->input->post('username');
        $username_old != $username_new && $this->form_validation->set_rules(
            'username',
            'username',
            'required|trim|min_length[3]|is_unique[user.username]',
            [
                'required' => 'Username Harus Ada',
                'min_length' => 'Username Tidak Boleh Pendek',
                'is_unique' => 'Username Telah Ada',
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'password',
            'required|trim|min_length[3]',
            [
                'required' => 'Password Harus Ada',
                'min_length' => 'Password Tidak Boleh Pendek',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->profile();
        } else {
            $data = [
                'username' => $username_new,
                'password' => $this->input->post('password')
            ];
            $this->session->set_userdata(['username' => $username_new]);
            $this->ModelUser->updateUser($data, ['user_id' => $getId->user_id]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Update Profile<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('dashboard/profile');
        }
    }
    public function kategori()
    {
        _cekRole();
        $data['title'] = 'Mitra Cell | Kategori';
        $data['active_navbar'] = 'kategori';
        $data['kategori'] = $this->ModelKategori->getKategori();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/kategori', $data);
        $this->load->view('templates/footer');
    }
    public function addKategori()
    {
        _cekRole();
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
        _cekRole();
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
        _cekRole();
        $this->ModelKategori->deleteKategori(['id' => $id]);
        $this->session->set_flashdata('pesan_delete', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menghapus Kategori<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
        redirect('dashboard/kategori');
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
            'intTotalHarga',
            'total harga',
            'required',
            [
                'required' => 'Total Harga Harus Ada',
            ]
        );

        $this->form_validation->set_rules(
            'intKembalian',
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
            $nama_barang_values = $this->input->post('namaBarang');
            $harpok_values = $this->input->post('harpok');
            $harjul_values = $this->input->post('harjul');
            $stok_values = $this->input->post('stok');
            $qty_values = $this->input->post('qty');
            $diskon_values = $this->input->post('diskon');
            $total_values = $this->input->post('total');
            $total_harga = $this->input->post('intTotalHarga');
            $jumlah_uang = $this->input->post('intJumlahUang');
            $kembalian = $this->input->post('intKembalian');
            $tanggal_sekarang = date('YmdHis');
            $data_detail_jual = [];
            $data_stok = [];

            if ($jumlah_uang < $total_harga) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">Jumlah Uang Kurang<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                return redirect('dashboard/jual');
            }
            $data_jual = [
                'nofak' => $tanggal_sekarang . $getId->user_id,
                'total' => $total_harga,
                'jml_uang' => $jumlah_uang,
                'kembalian' => $kembalian,
                'user_id' => $getId->user_id
            ];

            foreach ($kode_values as $index => $kode) {
                $nama_barang = $nama_barang_values[$index];
                $harpok = $harpok_values[$index];
                $harjul = $harjul_values[$index];
                $stok = $stok_values[$index];
                $qty = $qty_values[$index];
                $diskon = $diskon_values[$index];
                $total = $total_values[$index];
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
                if ($stok < $qty) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">Qty Melebihi Stok<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                    return redirect('dashboard/jual');
                }
                if ($qty == 0) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">Qty Tidak Boleh 0<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                    return redirect('dashboard/jual');
                }
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
        _cekRole();
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
        _cekRole();
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
                'harpok' => 0,
                'harjul' => 0,
                'stok' => 0,
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
        _cekRole();
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
            $this->ModelBarang->updateBarang($data, ['kode' => $kode]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Update Barang<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('dashboard/barang');
        }
    }

    public function deleteBarang($kode)
    {
        _cekRole();
        $this->ModelBarang->deleteBarang(['kode' => $kode]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Hapus Barang<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('dashboard/barang');
    }

    public function supplier()
    {
        _cekRole();
        $data['title'] = 'Mitra Cell | Supplier';
        $data['active_navbar'] = 'supplier';
        $data['supplier'] = $this->ModelSupplier->getSupplier();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/supplier', $data);
        $this->load->view('templates/footer');
    }
    public function addSupplier()
    {
        _cekRole();
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
        _cekRole();
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
        _cekRole();
        $this->ModelSupplier->deleteSupplier(['kode' => $kode]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menghapus Supplier<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
        redirect('dashboard/supplier');
    }

    public function beli()
    {
        _cekRole();
        $data['title'] = 'Mitra Cell | Beli';
        $data['active_navbar'] = 'beli';
        $data['supplier'] = $this->ModelSupplier->getSupplier();
        $data['barang'] = $this->ModelBarang->getBarang();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/beli', $data);
        $this->load->view('templates/footer');
    }
    public function addBeli()
    {
        $this->form_validation->set_rules(
            'kodeSupplier[]',
            'Kode Supplier',
            'required',
            [
                'required' => 'Kode Supplier Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'kodeBarang[]',
            'Kode Barang',
            'required',
            [
                'required' => 'Kode Barang Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'harga[]',
            'Harga Barang',
            'required',
            [
                'required' => 'Harga Barang Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'jumlah[]',
            'Jumlah Barang',
            'required',
            [
                'required' => 'Jumlah Barang Harus Ada',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->beli();
        } else {
            $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
            $kode_supplier_values = $this->input->post('kodeSupplier');
            $kode_barang_values = $this->input->post('kodeBarang');
            $nama_barang_values = $this->input->post('namaBarang');
            $harga_values = $this->input->post('harga');
            $jumlah_values = $this->input->post('jumlah');
            $total_values = $this->input->post('total');
            $total_values = $this->input->post('total');
            $total_harga = $this->input->post('intTotalHarga');
            $tanggal_sekarang = date('YmdHis');
            $data_detail_beli = [];
            $data_stok = [];
            if ($total_harga < 1) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">Total Tidak Boleh 0<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                return redirect('dashboard/beli');
            }
            $data_beli = [
                'nofak' => 'B' . $tanggal_sekarang . $kode_supplier_values[0] . $getId->user_id,
                'createdAt' => $tanggal_sekarang,
                'supplier_kode' => $kode_supplier_values[0],
                'user_id' => $getId->user_id,
                'total' => $total_harga,
            ];
            foreach ($kode_supplier_values as $index => $kode) {
                $beli_nofak = 'B' . $tanggal_sekarang . $kode_supplier_values[0] . $getId->user_id;
                $barang_id = $kode_barang_values[$index];
                $nama_barang = $nama_barang_values[$index];
                $harga = $harga_values[$index];
                $jumlah = $jumlah_values[$index];
                $total = $total_values[$index];
                if ($jumlah < 1) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">Jumlah Tidak Boleh 0<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                    return redirect('dashboard/beli');
                }
                $data_detail_beli[] = [
                    'beli_nofak' => $beli_nofak,
                    'barang_kode' => $barang_id,
                    'nama' => $nama_barang,
                    'harga' => $harga,
                    'jumlah' => $jumlah,
                    'total' => $total,
                ];
                $stok = $this->ModelBarang->getWhereBarang(['kode' => $barang_id])->row()->stok;
                $data_stok[] = [
                    'stok' => $stok + $jumlah,
                    'kode' => $barang_id,
                ];
            }
            $this->ModelBarang->updateBarangBatch($data_stok);
            $this->ModelBeli->addBeli($data_beli);
            $this->ModelBeli->addDetailBeli($data_detail_beli);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Beli<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('dashboard/Beli');
        }
    }

    // user
    public function user()
    {
        _cekRole();
        $data['title'] = 'Mitra Cell | User';
        $data['active_navbar'] = 'user';
        $data['user'] = $this->ModelUser->getUser();
        $data['staff'] = $this->ModelStaff->getStaff();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/user', $data);
        $this->load->view('templates/footer');
    }
    public function addUser()
    {
        _cekRole();
        $this->form_validation->set_rules(
            'username',
            'username',
            'required|trim|min_length[3]|is_unique[user.username]',
            [
                'required' => 'Username Harus Ada',
                'min_length' => 'Username Terlalu Pendek',
                'is_unique' => 'Username Sudah Ada',
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'password',
            'required|trim',
            [
                'required' => 'Passoword Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'role',
            'role',
            'required|min_length[3]',
            [
                'required' => 'Role Harus Ada',
                'min_length' => 'Role Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'staffId',
            'staff Id',
            'required|numeric|is_unique[user.staff_id]',
            [
                'required' => 'Staff Id Harus Ada',
                'numeric' => 'Staff Id Harus Ada',
                'is_unique' => 'Staff Sudah Punya Akun'
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->user();
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role'),
                'staff_id' => $this->input->post('staffId'),
            ];
            $this->ModelUser->addUser($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Tambah User<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('dashboard/User');
        }
    }
    public function resetUser($id)
    {
        _cekRole();
        $this->ModelUser->updateUser(['password' => 'mitra123'], ['user_id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Reset Password<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('dashboard/User');
    }
    public function updateUser()
    {
        _cekRole();
        $this->form_validation->set_rules(
            'user_id',
            'user id',
            'required',
            [
                'required' => 'User Id Harus Ada',
            ]
        );
        $username = $this->input->post('username-old');
        $usernameCheck = $this->ModelUser->cekData(['username' => $username])->row()->username;
        $usernameCheck != $this->input->post('upt_username') && $this->form_validation->set_rules(
            'upt_username',
            'Username',
            'required|trim|min_length[3]|is_unique[user.username]',
            [
                'required' => 'Username Harus Ada',
                'is_unique' => 'Username Sudah Ada',
                'min_length' => 'Username Terlalu Pendek',
            ]
        );
        $this->form_validation->set_rules(
            'upt_role',
            'Role',
            'required|min_length[3]',
            [
                'required' => 'Role Harus Ada',
                'min_length' => 'Role Harus Ada',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->user();
        } else {
            $data = [
                'username' => $this->input->post('upt_username'),
                'role' => $this->input->post('upt_role')
            ];
            $this->ModelUser->updateUser($data, ['user_id' => $this->input->post('user_id')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Update User<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('dashboard/User');
        }
    }
    public function deleteUser($id)
    {
        _cekRole();
        $this->ModelUser->deleteUser(['user_id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Delete User<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('dashboard/User');
    }

    // staff
    public function staff()
    {
        _cekRole();
        $data['title'] = 'Mitra Cell | Staff';
        $data['active_navbar'] = 'staff';
        $data['staff'] = $this->ModelStaff->getStaff();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/staff', $data);
        $this->load->view('templates/footer');
    }
    public function addStaff()
    {
        _cekRole();
        $this->form_validation->set_rules(
            'nama',
            'nama',
            'required|min_length[3]',
            [
                'required' => 'Nama Harus Ada',
                'min_length' => 'Nama Terlalu Pendek',
            ]
        );
        $this->form_validation->set_rules(
            'noKtp',
            'No Ktp',
            'required|trim|is_unique[staff.no_ktp]',
            [
                'required' => 'No Ktp Harus Ada',
                'is_unique' => 'No Ktp Sudah Ada',
            ]
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required|min_length[3]',
            [
                'required' => 'Alamat Harus Ada',
                'min_length' => 'Alamat Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'noHp',
            'No Hp',
            'required|numeric',
            [
                'required' => 'No Hp Harus Ada',
                'numeric' => 'No Hp Tidak Benar',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->staff();
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'no_ktp' => $this->input->post('noKtp'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('noHp'),
                'createdAt' => date('YmdHis'),
            ];
            $this->ModelStaff->addStaff($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Tambah Staff<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('dashboard/staff');
        }
    }
    public function updateStaff()
    {
        _cekRole();
        $this->form_validation->set_rules(
            'upt_nama',
            'nama',
            'required|min_length[3]',
            [
                'required' => 'Nama Harus Ada',
                'min_length' => 'Nama Terlalu Pendek',
            ]
        );
        $no_ktp = $this->input->post('noKtp-old');
        $no_ktpCheck = $this->ModelStaff->getWhereStaff(['no_ktp' => $no_ktp])->row()->no_ktp;
        $no_ktpCheck != $this->input->post('upt_noKtp') && $this->form_validation->set_rules(
            'upt_noKtp',
            'No Ktp',
            'required|trim|is_unique[staff.no_ktp]',
            [
                'required' => 'No Ktp Harus Ada',
                'is_unique' => 'No Ktp Sudah Ada',
            ]
        );
        $this->form_validation->set_rules(
            'upt_alamat',
            'alamat',
            'required|min_length[3]',
            [
                'required' => 'Alamat Harus Ada',
                'min_length' => 'Alamat Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'upt_noHp',
            'No Hp',
            'required|numeric',
            [
                'required' => 'No Hp Harus Ada',
                'numeric' => 'No Hp Tidak Benar',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->staff();
        } else {
            $data = [
                'nama' => $this->input->post('upt_nama'),
                'no_ktp' => $this->input->post('upt_noKtp'),
                'alamat' => $this->input->post('upt_alamat'),
                'no_hp' => $this->input->post('upt_noHp'),
                'updatedAt' => date('YmdHis'),
            ];
            $this->ModelStaff->updateStaff($data, ['no_ktp' => $no_ktpCheck]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Update Staff<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('dashboard/staff');
        }
    }
    public function deleteStaff($id)
    {
        _cekRole();
        $this->ModelStaff->deleteStaff(['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Delete Staff<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('dashboard/staff');
    }
}
