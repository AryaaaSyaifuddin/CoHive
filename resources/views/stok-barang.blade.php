<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>CoHive</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: poppins;
    }
    .wrapper {
      display: flex;
      min-height: 100vh;
      padding: 15px 15px 15px 0;
      gap: 15px;
      transition: all 0.3s ease;
    }
    .sidebar {
      width: 280px;
      border: 1px solid;
      border-radius: 0 12px 12px 0;
      background: #fff;
      padding: 20px;
      transition: width 0.3s ease;
      position: relative;
    }
    /* Saat sidebar ditutup: mengecilkan lebar */
    .sidebar.closed {
      width: 80px;
    }
    .profile {
      text-align: center;
      margin-bottom: 20px;
      position: relative;
    }
    .profile img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
    }
    .profile h3 {
      margin-top: 10px;
      font-size: 18px;
      transition: opacity 0.3s ease;
    }
    .profile p {
      font-size: 14px;
      color: #666;
      transition: opacity 0.3s ease;
    }
    /* Sembunyikan teks profil saat sidebar ditutup */
    .sidebar.closed .profile h3,
    .sidebar.closed .profile img,
    .sidebar.closed .profile p,
    .sidebar.closed .garis {
      opacity: 0;
      visibility: hidden;
    }
    .garis {
      width: 100%;
      height: 1px;
      background-color: black;
      margin: 25px 0 35px 0;
    }
    .menu {
      list-style: none;
      padding-left: 0;
    }
    .menu li {
      margin-bottom: 10px;
    }
    .menu a {
      display: flex;
      align-items: center;
      text-decoration: none;
      padding: 9px 18px;
      border-radius: 10px;
      font-size: 13px;
      color: #000;
      background: #FFD54F;
      font-weight: bold;
      transition: background 0.3s ease, color 0.3s ease;
    }
    .menu a i {
      margin-right: 10px;
    }
    .menu a:hover {
      background: #333;
      color: whitesmoke;
    }
    .menu .dash {
      background: #333;
      color: #fff;
    }
    /* Sembunyikan teks menu saat sidebar ditutup */
    .sidebar.closed .menu a{
        padding: 12px 12px;
    }

    .sidebar.closed .menu-text {
      display: none;
    }

    .main-container {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 15px;
      position: relative;
    }
    .header {
      position: relative;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid;
      border-radius: 12px;
      padding: 20px;
      overflow: hidden;
    }
    .header h1 {
      font-size: 24px;
      color: #FFD54F;
    }
    .logout-btn {
      position: relative;
      z-index: 2;
      background: transparent;
      border: 0;
      padding: 8px 16px;
      border-radius: 20px;
      font-weight: bold;
      color: #000;
      cursor: pointer;
      font-size: 16px;
    }
    /* Tombol burger tetap di dalam sidebar (di pojok atas profil) */
    .burger-btn {
      position: absolute;
      top: 5px;
      right: 5px;
      z-index: 2;
      background: transparent;
      border: 0;
      padding: 8px 16px;
      border-radius: 20px;
      font-weight: bold;
      color: #000;
      cursor: pointer;
      font-size: 16px;
    }
    .sidebar.closed .burger-btn{
      padding: 8px 9px;
    }
    .content {
      position: relative;
      flex: 1;
      border: 1px solid;
      border-radius: 12px;
      background-color: #fff;
      overflow: hidden;
    }
    .shape {
      position: absolute;
      background-color: #FFD54F;
      opacity: 0.8;
      clip-path: polygon(
        25% 0%,
        75% 0%,
        100% 50%,
        75% 100%,
        25% 100%,
        0% 50%
      );
      z-index: 1;
    }
    .hex1 {
      width: 185px;
      height: 160px;
      top: 70px;
      left: 804px;
    }
    .hex2 {
        width: 275px;
        height: 180px;
        top: -49px;
        left: 86%;
    }
    .hex3 {
      width: 750px;
      height: 630px;
      top: 210px;
      left: -60px;
      transform: rotate(5deg);
    }
    .tilt {
      transform: rotate(-57deg);
    }
    .dashboard-wrapper {
    padding: 30px;
    position: relative;
    z-index: 2;
    }

    .dashboard-box {
    display: flex;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    border: 1px solid #ccc;
    overflow: hidden;
    }

    .dashboard-box .section {
    flex: 1;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    position: relative;
    }

    .dashboard-box .section:not(:last-child)::after {
    content: "";
    position: absolute;
    top: 10%;
    right: 0;
    height: 80%;
    width: 1px;
    background-color: #aaa;
    }

    .dashboard-box h4 {
    font-size: 15px;
    font-weight: 600;
    }

    .dashboard-box h2 {
    font-size: 19px;
    font-weight: bold;
    margin: 5px 0;
    }

    .dashboard-box p {
    font-size: 12px;
    color: #666;
    }

    .text-red {
    color: red;
    }

    .produk-container {
        margin-top: 30px;
        border: 1px solid #ccc;
        border-radius: 12px;
        padding: 40px;
        background: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        font-family: 'Segoe UI', sans-serif;
    }

    .produk-container h2 {
        font-size: 18px;
        font-weight: 600;
    }

    .produk-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    flex-wrap: wrap;
    font-size: 12px;
    }

    .data-select-label select {
    padding: 3px 6px;
    margin-left: 5px;
    margin-right: 5px;
    font-size: 12px;
    }

    .produk-actions {
    display: flex;
    gap: 6px;
    }

    .btn {
    padding: 4px 10px;
    border: none;
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
    }

    .btn-blue {
    background-color: #007bff;
    color: white;
    }

    .btn-gray {
    background-color: #f1f1f1;
    color: black;
    border: 1px solid #ccc;
    }

    .produk-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
    }

    .produk-table th,
    .produk-table td {
    border: 1px solid #333;
    padding: 6px 8px;
    text-align: left;
    }

    .produk-table thead {
    background-color: #f7f7f7;
    }

    .produk-table tbody tr:nth-child(odd) {
    background-color: #fff8d4;
    }

    .produk-tableku {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
    }

    .produk-tableku th,
    .produk-tableku td {
    border: 0px solid #333;
    padding: 6px 8px;
    text-align: left;
    }

    .produk-tableku thead {
    background-color: #f7f7f7;
    }

    .produk-tableku tbody tr:nth-child(odd) {
    background-color: #fff8d4;
    }

    .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    font-size: 12px;
    margin-top: 10px;
    }

    .pagination button {
    background: none;
    border: none;
    font-size: 16px;
    cursor: pointer;
    }


    .btn-blue {
    background-color: #007bff;
    color: white;
    }

    .btn-gray {
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    }

    .btn-yellow {
    background-color: #ffeb3b;
    border: none;
    }

    input:disabled {
        background-color: #f3f3f3;
        cursor: not-allowed;
        opacity: 0.8;
    }

    /* Popup styling */
    .popup-form {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
    z-index: 9999;
    }

    .popup-content {
    background: #fff;
    padding: 24px;
    border-radius: 8px;
    width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    font-size: 12px;
    }

    .popup-content h2 {
    margin-top: 0;
    font-size: 16px;
    font-weight: bold;
    }

    .popup-content label {
    display: block;
    margin-top: 10px;
    margin-bottom: 4px;
    }

    .popup-content input,
    .popup-content select {
    width: 100%;
    padding: 6px;
    margin-bottom: 8px;
    font-size: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    }

    .image-upload {
    display: flex;
    justify-content: center;
    margin: 12px 0;
    }

    .image-box {
    width: 38%;
    height: 163px;
    border: 2px dashed #ccc;
    text-align: center;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f9f9f9;
    }

    .image-box img {
    max-height: 100%;
    object-fit: contain;
    display: block;
    }
    .popup-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 12px;
    }

    /****************************/
/* Popup Overlay & Container*/
/****************************/
.detail-popup {
  position: fixed;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
  display: none; /* default hidden */
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.detail-popup-content {
  background: #fff;
  width: 1100px; /* Lebar konten lebih besar */
  max-width: 95%;
  border-radius: 8px;
  padding: 35px;
  position: relative;
  font-family: "Arial", sans-serif;
  font-size: 12px; /* Font lebih kecil */
  color: #333;
}

/****************************/
/* Header Section           */
/****************************/
.detail-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 20px;
}

.detail-header-left {
  display: flex;
  flex-direction: column;
}

.detail-product-name {
  margin: 0;
  font-size: 18px;
  font-weight: bold;
  letter-spacing: 0.5px;
}

.detail-tabs {
  list-style: none;
  padding: 0;
  margin: 8px 0 0 0;
  display: flex;
  gap: 120px;
}

.detail-tabs li {
  cursor: pointer;
  padding: 4px 0;
  color: #666;
  position: relative;
}

.detail-tabs li.active {
  font-weight: bold;
  color: #000;
  border-bottom: 3px solid #ffc107; /* Garis kuning di tab aktif */
}

.detail-header-right {
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Tombol Edit & Download */
.detail-btn-edit,
.detail-btn-download {
  background-color: #f0f0f0;
  border: none;
  padding: 6px 12px;
  font-size: 12px;
  cursor: pointer;
  border-radius: 4px;
}

/* Tombol Close (X) */
.detail-close-btn {
  background: transparent;
  border: none;
  font-size: 20px;
  cursor: pointer;
  line-height: 1;
}

/****************************/
/* Body Section             */
/****************************/
.detail-body {
  display: flex;
  gap: 50px;
}

/* Bagian Kiri */
.detail-left {
  flex: 1;
  min-width: 320px;
}

.detail-left h3 {
  margin-top: 0;
  margin-bottom: 17px;
  font-size: 14px;
  font-weight: bold;
  color: #333;
}

.detail-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 25px;
}

.detail-row .label {
  color: #666;
  font-weight: 400;
}

.detail-row .value {
  font-weight: 600;
  margin-right: 195px;
}

/* Tabel Lokasi Stok */
.detail-lokasi-stok table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

.detail-lokasi-stok th,
.detail-lokasi-stok td {
  border: 1px solid #ddd;
  padding: 6px;
  text-align: left;
  font-size: 12px;
}

.detail-lokasi-stok th {
  background-color: #f9f9f9;
}

/* Bagian Kanan */
.detail-right {
  flex: 1;
  max-width: 295px;
  display: flex;
  flex-direction: column;
  align-items: end;
}

/****************************/
/* Gambar Produk & Stok     */
/****************************/
.detail-product-image {
    display: flex;
    justify-content: end;
}

.detail-product-image img {
    max-width: 70%;
    border-radius: 4px;
    padding: 25px;
}

.detail-stock-info {
    color: #E9B300;
    width: 75%;
    padding: 10px 12px;
    border-radius: 4px;
}

.stock-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
}

.stock-label {
    margin-bottom: 10px;
    color: #E9B300;
    font-weight: 500;
}

.stock-value {
  font-weight: 600;
}

/* Warna baris aktifitas, khusus untuk tabel di #aktifitas-content */
#aktifitas-content .produk-tableku tbody tr.tipe-masuk {
  background-color: #d4edda; /* hijau lembut */
  color: #155724;            /* teks hijau gelap */
}

#aktifitas-content .produk-tableku tbody tr.tipe-keluar {
  background-color: #f8d7da; /* merah lembut */
  color: #721c24;            /* teks merah gelap */
}

/****************************/
/* Responsive               */
/****************************/
@media (max-width: 768px) {
  .detail-body {
    flex-direction: column;
  }

  .detail-popup-content {
    width: 90%;
    max-width: 600px;
  }
}


  </style>
</head>
<body>
    {{-- Tampilkan pesan SweetAlert jika session error atau success --}}
    @if (session('error'))
    <script>
      Swal.fire({
        title: 'Error!',
        text: '{{ session("error") }}',
        icon: 'error',
        confirmButtonText: 'OK',
        timer: 3000,
        timerProgressBar: true,
      });
    </script>
    @endif

    @if (session('success'))
    <script>
      Swal.fire({
        title: 'Success!',
        text: '{{ session("success") }}',
        icon: 'success',
        confirmButtonText: 'OK',
        timer: 3000,
        timerProgressBar: true,
      });
    </script>
    @endif

    <div class="wrapper">
        <div class="sidebar" id="sidebar">
            <div class="profile">
                <img src="{{ $profile && $profile->photo ? asset('storage/' . $profile->photo) : asset('img/ProfileKosong.jpg') }}"
                    alt="Foto Profil">
                <button class="burger-btn" id="burger-btn"><i class="fa fa-bars"></i></button>
                <h3>{{ $profile->name ?? 'Anonim' }}</h3>
                <p>{{ $users->role ?? 'Anonim' }}</p>
                <div class="garis"></div>
            </div>
            <ul class="menu">
                <li>
                    <a href="/">
                        <i class="fa fa-desktop"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                @if($users->role === 'Admin')
                <li>
                    <a href="/anggota">
                        <i class="fa fa-users"></i>
                        <span class="menu-text">Daftar Anggota</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="/jadwal_anggota">
                        <i class="fa fa-calendar-alt"></i>
                        <span class="menu-text">Jadwal Anggota</span>
                    </a>
                </li>
                <li>
                    <a href="/stok-barang" class="dash">
                        <i class="fa fa-box"></i>
                        <span class="menu-text">Stok Barang</span>
                    </a>
                </li>
                <li>
                    <a href="/keuangan">
                        <i class="fa fa-money-bill-wave"></i>
                        <span class="menu-text">Catatan Keuangan</span>
                    </a>
                </li>
                <li>
                    <a href="/profile">
                        <i class="fa fa-user"></i>
                        <span class="menu-text">Profile</span>
                    </a>
                </li>
        </div>

      <div class="main-container">
        <div class="header">
          <h1>CoHive</h1>
          <a href="{{ route('logout') }}" class="logout-btn" style="text-decoration: none">
            <i class="fa fa-sign-out-alt"></i> Logout
          </a>
          <div class="shape hex2"></div>
        </div>

        <div class="content">
          <div class="shape hex1 tilt"></div>
          <div class="shape hex3"></div>

            <!-- Konten Aktifitas -->

            <div class="dashboard-wrapper" id="wraped-aktifitas" style="display: none">
                <div id="aktifitas-content" style="display: none;">
                    <h2 style="margin-bottom: 10px;">Aktifitas</h2>
                    <button class="btn btn-gray" onclick="kembaliKeProduk()" style="margin-bottom: 9px;">Kembali ke Daftar Produk</button>
                    <table class="produk-tableku">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Varian</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Tanggal Exp</th>
                        <th>User</th>
                        <th>Jumlah</th>
                        <th>Tipe</th>
                        <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($aktifitas as $item)
                        @php
                            // Tentukan kelas berdasarkan tipe aktifitas
                            $rowClass = ($item->tipe === 'masuk') ? 'tipe-masuk' : 'tipe-keluar';
                        @endphp
                        <tr class="{{ $rowClass }}">
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->id_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->varian }}</td>
                            <td>{{ $item->harga_beli }}</td>
                            <td>{{ $item->harga_jual }}</td>
                            <td>{{ $item->tanggal_exp }}</td>
                            <td>{{ $item->user_id }} - {{ $item->username }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ ucfirst($item->tipe) }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <div class="pagination">
                    <button>&#9664;</button>
                    <span>page 1 of 10</span>
                    <button>&#9654;</button>
                    </div>
                </div>
            </div>

          <!-- Tampilan Produk -->
          <div id="produk-content">
            <div class="dashboard-wrapper">
                <h2 style="font-size: 19px; margin-bottom: 15px;">Stock Barang</h2>
                <div class="dashboard-box">
                  <div class="section">
                    <h4>Kategori Barang</h4>
                    <h2>{{ $jumlahKategori }}</h2>
                    <p>Last 7 days</p>
                  </div>
                  <div class="section">
                    <h4>Total Barang Masuk</h4>
                    <div>
                      <h2>{{ $totalBarangMasuk }}</h2>
                      <p>Last 7 days</p>
                      <h2>Rp {{ number_format($nilaiTotalMasuk, 0, ',', '.') }}</h2>
                      <p>nilai Harga</p>
                    </div>
                  </div>
                  <div class="section">
                    <h4>Data Barang Keluar</h4>
                    <div>
                      <h2>{{ $totalBarangKeluar }}</h2>
                      <p>Last 7 days</p>
                      <h2>Rp {{ number_format($nilaiTotalKeluar, 0, ',', '.') }}</h2>
                      <p>nilai Harga</p>
                    </div>
                  </div>
                  <div class="section">
                    <h4 class="text-red">Stok Rendah</h4>
                    <div>
                      <h2>{{ $totalStokDipesan }}</h2>
                      <p>Dipesan</p>
                      <h2>{{ $stokTersedia }}</h2>
                      <p>Stok Tersedia saat ini</p>
                    </div>
                  </div>
                </div>


            <div class="produk-container">
                <div class="produk-header" style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 10px;">
                  <h2>Daftar Produk</h2>
                  <button class="btn btn-gray" onclick="tampilkanAktifitas()">Lihat Aktifitas</button>
                </div>

                <div class="produk-controls">
                  <label class="data-select-label">
                    Tampilkan
                    <select>
                      <option>10</option>
                      <option>25</option>
                      <option>50</option>
                    </select>
                    Data
                  </label>

                  <div class="produk-actions">
                    <button class="btn btn-blue" onclick="openPopup()">Barang Masuk</button>
                    <button class="btn btn-blue" onclick="openBarangKeluarPopup()">Barang Keluar</button>
                    <button class="btn btn-gray" onclick="openFilterModal()">Filters</button>
                  </div>
                </div>

            <table class="produk-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Varian</th>
                    <th>Stok</th>
                    <th>Tanggal Masuk</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Tanggal Exp</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="produkTableBody">
                    @foreach ($barangs as $index => $barang)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->id_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->varian }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>{{ $barang->tanggal_masuk }}</td>
                        <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $barang->tanggal_exp }}</td>
                        <td>
                          <button style="padding: 2px 15px; font-size: 12px; background-color: #fbda70; border: 1px solid; border-radius: 5px;"
                              onclick="openDetailPopup(this)"
                              data-id_barang="{{ $barang->id_barang }}"
                              data-nama="{{ $barang->nama_barang }}"
                              data-varian="{{ $barang->varian }}"
                              data-exp="{{ $barang->tanggal_exp }}"
                              data-gambar="{{ asset('storage/' . $barang->gambar) }}"
                              data-stok="{{ $barang->stok }}"
                              data-harga-beli="{{ $barang->harga_beli }}"
                              data-harga-jual="{{ $barang->harga_jual }}">
                            Detail
                          </button>

                          <!-- Tombol Edit -->
                          <button style="padding: 2px 15px; font-size: 12px; background-color: #007bff; color: #fff; border: 1px solid; border-radius: 5px; margin-top: 5px;"
                              onclick="openEditPopup(this)"
                              data-record-id="{{ $barang->id }}"
                              data-id_barang="{{ $barang->id_barang }}"
                              data-nama="{{ $barang->nama_barang }}"
                              data-varian="{{ $barang->varian }}"
                              data-stok="{{ $barang->stok }}"
                              data-tanggal_masuk="{{ $barang->tanggal_masuk }}"
                              data-harga-beli="{{ $barang->harga_beli }}"
                              data-harga_jual="{{ $barang->harga_jual }}"
                              data-tanggal_exp="{{ $barang->tanggal_exp }}">
                            Edit
                          </button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
            </table>

            <!-- Modal Filter (Popup) -->
            <div class="popup-form" id="filterModal" style="display: none;">
                <div class="popup-content">
                <h2>Filter Data Produk</h2>
                <form id="filterForm">
                    <label for="filterOption">Pilih Filter:</label>
                    <select id="filterOption" name="filter_option">
                    <option value="">-- Pilih Filter --</option>
                    <option value="expiring">Expired Paling Dekat</option>
                    <option value="most_stock">Barang Terbanyak</option>
                    <option value="least_stock">Barang Paling Sedikit</option>
                    <option value="highest_buy">Harga Beli Tertinggi</option>
                    <option value="lowest_buy">Harga Beli Terendah</option>
                    <option value="highest_sell">Harga Jual Tertinggi</option>
                    <option value="lowest_sell">Harga Jual Terendah</option>
                    </select>
                    <div class="popup-buttons" style="margin-top: 15px;">
                    <button type="button" class="btn btn-gray" onclick="closeFilterModal()">Cancel</button>
                    <button type="button" class="btn btn-yellow" onclick="applyFilter()">Apply Filter</button>
                    </div>
                </form>
                </div>
            </div>
                <div class="pagination">
                  <button>&#9664;</button>
                  <span>page 1 of 10</span>
                  <button>&#9654;</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Popup Form Produk Baru -->
    <div class="popup-form" id="popupForm">
        <div class="popup-content">
          <h2>Produk baru</h2>

          {{-- Area Upload Gambar --}}
          <div class="image-upload">
            <div class="image-box" id="imageBox">
              <img id="imagePreview" src="#" alt="Preview" style="display: none;">
              <span id="imageText">Drag image here<br>or<br><a href="#">Browse image</a></span>
              <input type="file" name="gambar" id="gambarInput" style="display: none;">
            </div>
          </div>

          <form action="{{ route('barangs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Pilihan Produk: Select ID Barang --}}
            <label for="selectExistingIdBarang">Pilih ID Barang (Opsional)</label>
            <select id="selectExistingIdBarang" placeholder="Enter product ID">
                @if(auth()->user()->role === 'Admin')
                  <option value="new">Tambah Lainnya</option>
                @endif
                @foreach ($existingProducts as $product)
                  <option value="{{ $product->id_barang }}"
                          data-nama="{{ $product->nama_barang }}"
                          data-varian="{{ $product->varian }}">
                    {{ $product->id_barang }}
                  </option>
                @endforeach
            </select>

            {{-- Input ID Barang (bisa diisi sendiri atau auto-filled) --}}
            <label for="idBarangInput">ID Barang</label>
            <input type="text"
                   id="idBarangInput"
                   name="id_barang"
                   placeholder="Enter product ID"
                   value="{{ old('id_barang') }}"
                   required>

            <label for="namaBarangInput">Nama Barang</label>
            <input type="text" placeholder="Enter product name" name="nama_barang" id="namaBarangInput" value="{{ old('nama_barang') }}" required>

            <label for="varianInput">Varian</label>
            <input type="text" placeholder="Enter product variant" name="varian" id="varianInput" value="{{ old('varian') }}" required>

            <label for="stokInput">Stok</label>
            <input type="number" placeholder="Enter current stock" name="stok" id="stokInput" value="{{ old('stok') }}" required>

            <label for="tanggalMasukInput">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" id="tanggalMasukInput" value="{{ old('tanggal_masuk') }}" required>

            <label for="hargaBeliInput">Harga Beli</label>
            <input type="number" placeholder="Enter buying price" name="harga_beli" step="0.01" id="hargaBeliInput" value="{{ old('harga_beli') }}" required>

            <label for="hargaJualInput">Harga Jual</label>
            <input type="number" placeholder="Enter selling price" name="harga_jual" step="0.01" id="hargaJualInput" value="{{ old('harga_jual') }}" required>

            <label for="tanggalExpInput">Tanggal Kadaluarsa</label>
            <input type="date" name="tanggal_exp" id="tanggalExpInput" value="{{ old('tanggal_exp') }}">

            <div class="popup-buttons">
              <button type="button" class="btn btn-gray" onclick="window.history.back()">Discard</button>
              <button type="submit" class="btn btn-yellow">Add Product</button>
            </div>
          </form>
        </div>
    </div>


    <!-- Detail Popup Produk -->
    <div class="detail-popup" id="detailPopup" style="display: none;">
      <div class="detail-popup-content">
        <div class="detail-header">
          <div class="detail-header-left">
            <h1 class="detail-product-name" id="popupNamaProduk">YOGHURT</h1>
            <ul class="detail-tabs">
              <li class="active">Overview</li>
              <li>Penjualan</li>
              <li>Perubahan</li>
              <li>Riwayat</li>
            </ul>
          </div>
          <div class="detail-header-right">
            <button class="detail-btn-edit">Edit</button>
            <button class="detail-btn-download">Download</button>
            <button class="detail-close-btn" onclick="closeDetailPopup()">×</button>
          </div>
        </div>

        <div class="detail-body">
          <div class="detail-left">
            <h3>Detail Utama</h3>
            <div class="detail-row">
              <span class="label">Nama Produk</span>
              <span class="value" id="popupNamaProdukText">N/A</span>
            </div>
            <div class="detail-row">
              <span class="label">ID Produk</span>
              <span class="value" id="popupIdProduk">N/A</span>
            </div>
            <div class="detail-row">
              <span class="label">Kategori Produk</span>
              <span class="value" id="popupKategori">N/A</span>
            </div>
            <div class="detail-row">
              <span class="label">Tanggal Kadaluarsa</span>
              <span class="value" id="popupExp">N/A</span>
            </div>
            <div class="detail-row">
              <span class="label">Satuan</span>
              <span class="value">N/A</span>
            </div>

            <h3>Lokasi Stok</h3>
            <div class="detail-lokasi-stok">
              <table>
                <thead>
                  <tr>
                    <th>Store Name</th>
                    <th>Stok in hand</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Sulur Branch</td>
                    <td>15</td>
                  </tr>
                  <tr>
                    <td>Singarallur Branch</td>
                    <td>19</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="detail-right">
            <div class="detail-product-image">
              <img src="" alt="Product Image" id="popupGambar" style="max-width: 100%;">
            </div>
            <div class="detail-stock-info">
              <div class="stock-row">
                <span class="stock-label">Stok Awal</span>
                <span class="stock-value">N/A</span>
              </div>
              <div class="stock-row">
                <span class="stock-label">Stok Saat Ini</span>
                <span class="stock-value" id="popupStok">N/A</span>
              </div>
              <div class="stock-row">
                <span class="stock-label">Dalam Pengiriman</span>
                <span class="stock-value">N/A</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="popup-form" id="barangKeluarForm">
        <div class="popup-content" style="width: 800px;">
          <h2>Barang Keluar</h2>
          <div style="display: flex; gap: 20px;">
            <!-- Form Kiri -->
            <div style="flex: 1;">
              <!-- Pilih ID Barang -->
              <label for="selectBarang">Pilih ID Barang</label>
              <select id="selectBarang">
                <option value="" disabled selected>-- Pilih --</option>
                @foreach ($barangs->unique('id_barang') as $barang)
                  <option value="{{ $barang->id_barang }}">
                    {{ $barang->id_barang }} - {{ $barang->nama_barang }}
                  </option>
                @endforeach
              </select>

              <!-- Pilih Tanggal Exp -->
              <label for="selectExp">Pilih Tanggal Exp</label>
              <select id="selectExp" disabled>
                <option value="" disabled selected>-- Pilih Tanggal Exp --</option>
              </select>

              <label>Nama Barang</label>
              <input type="text" id="detailNama" disabled>

              <label>Varian</label>
              <input type="text" id="detailVarian" disabled>

              <label>Stok Tersedia</label>
              <input type="number" id="detailStok" disabled>

              <label>Harga Jual</label>
              <input type="text" id="detailHarga" disabled>
            </div>

            <!-- Form Kanan -->
            <div style="flex: 1;">
              <form action="{{ route('barang.keluar') }}" method="POST">
                @csrf
                <!-- Hidden fields untuk menampung data ID Barang yang final, plus Tanggal Exp jika Anda mau kirim ke server -->
                <input type="hidden" name="id_barang" id="formIdBarang">
                <input type="hidden" name="tanggal_exp" id="formExpDate">

                <label>Jumlah Keluar</label>
                <input type="number" name="jumlah_keluar" placeholder="Masukkan jumlah" required>

                <div class="popup-buttons" style="margin-top: 20px;">
                  <button type="button" class="btn btn-gray" onclick="closeBarangKeluarPopup()">Batal</button>
                  <button type="submit" class="btn btn-yellow">Keluarkan Barang</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


    <!-- Popup Form Edit Produk -->
<div class="popup-form" id="editPopupForm" style="display: none;">
    <div class="popup-content">
      <h2>Edit Produk</h2>

      {{-- Area Upload Gambar (opsional, bisa diedit juga) --}}
      <div class="image-upload">
        <div class="image-box" id="editImageBox">
          <img id="editImagePreview" src="#" alt="Preview" style="display: none;">
          <span id="editImageText">Drag image here<br>or<br><a href="#">Browse image</a></span>
          <input type="file" name="gambar" id="editGambarInput" style="display: none;">
        </div>
      </div>

      <!-- Form edit -->
      <!-- Action URL akan diset secara dinamis berdasarkan id barang -->
      <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Pilihan Produk: Select ID Barang (opsional, bisa mengikuti pola tambah) --}}
        <label for="editSelectExistingIdBarang">Pilih ID Barang (Opsional)</label>
        <select id="editSelectExistingIdBarang">
          <option value="new">Tambah Lainnya</option>
          @foreach ($existingProducts as $product)
            <option value="{{ $product->id_barang }}"
                    data-nama="{{ $product->nama_barang }}"
                    data-varian="{{ $product->varian }}">
              {{ $product->id_barang }}
            </option>
          @endforeach
        </select>

        {{-- Input ID Barang --}}
        <label for="editIdBarangInput">ID Barang</label>
        <input type="text" id="editIdBarangInput" name="id_barang" placeholder="Enter product ID" required>

        <label for="editNamaBarangInput">Nama Barang</label>
        <input type="text" id="editNamaBarangInput" name="nama_barang" placeholder="Enter product name" required>

        <label for="editVarianInput">Varian</label>
        <input type="text" id="editVarianInput" name="varian" placeholder="Enter product variant" required>

        <label for="editStokInput">Stok</label>
        <input type="number" id="editStokInput" name="stok" placeholder="Enter current stock" required>

        <label for="editTanggalMasukInput">Tanggal Masuk</label>
        <input type="date" id="editTanggalMasukInput" name="tanggal_masuk" required>

        <label for="editHargaBeliInput">Harga Beli</label>
        <input type="number" id="editHargaBeliInput" name="harga_beli" step="0.01" placeholder="Enter buying price" required>

        <label for="editHargaJualInput">Harga Jual</label>
        <input type="number" id="editHargaJualInput" name="harga_jual" step="0.01" placeholder="Enter selling price" required>

        <label for="editTanggalExpInput">Tanggal Kadaluarsa</label>
        <input type="date" id="editTanggalExpInput" name="tanggal_exp">

        <div class="popup-buttons">
          <button type="button" class="btn btn-gray" onclick="closeEditPopup()">Cancel</button>
          <button type="submit" class="btn btn-yellow">Update Product</button>
        </div>
      </form>
    </div>
  </div>


    <!-- Script Umum -->
    <script>
        // Sidebar burger
        const burgerBtn = document.getElementById('burger-btn');
        const sidebar = document.getElementById('sidebar');

        burgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('closed');
        });

        // Popup Produk Baru
        function openPopup() {
            document.getElementById("popupForm").style.display = "flex";
        }
        function closePopup() {
            document.getElementById("popupForm").style.display = "none";
        }

        // Image Upload Preview
        const imageBox = document.getElementById('imageBox');
        const imagePreview = document.getElementById('imagePreview');
        const imageText = document.getElementById('imageText');
        const fileInput = document.getElementById('gambarInput');

        imageBox.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.setAttribute('src', e.target.result);
                imagePreview.style.display = 'block';
                imageText.style.display = 'none';
            }
            reader.readAsDataURL(file);
            }
        });

        // Detail Popup Produk (open & close)
        function openDetailPopup(button) {
            document.getElementById('popupNamaProduk').textContent = button.dataset.nama || 'N/A';
            document.getElementById('popupNamaProdukText').textContent = button.dataset.nama || 'N/A';
            document.getElementById('popupIdProduk').textContent = button.dataset.id || 'N/A';
            document.getElementById('popupKategori').textContent = button.dataset.jenis || 'N/A';
            document.getElementById('popupExp').textContent = button.dataset.exp || 'N/A';
            document.getElementById('popupStok').textContent = button.dataset.stok || 'N/A';
            document.getElementById('popupGambar').src = button.dataset.gambar || '';

            document.getElementById('detailPopup').style.display = 'flex';
        }

        function closeDetailPopup() {
            document.getElementById('detailPopup').style.display = 'none';
        }

        // Popup Barang Keluar
        function openBarangKeluarPopup() {
            document.getElementById('barangKeluarForm').style.display = 'flex';
        }
        function closeBarangKeluarPopup() {
            document.getElementById('barangKeluarForm').style.display = 'none';
        }

        // Toggle antara tampilan produk dan aktifitas
        function tampilkanAktifitas() {
            document.getElementById('produk-content').style.display = 'none';
            document.getElementById('aktifitas-content').style.display = 'block';
            document.getElementById('wraped-aktifitas').style.display = 'block';
        }
        function kembaliKeProduk() {
            document.getElementById('aktifitas-content').style.display = 'none';
            document.getElementById('wraped-aktifitas').style.display = 'none';
            document.getElementById('produk-content').style.display = 'block';
        }
    </script>


    <script>
        const selectExistingIdBarang = document.getElementById('selectExistingIdBarang');
        const idBarangInput = document.getElementById('idBarangInput');
        const namaBarangInput = document.getElementById('namaBarangInput');
        const varianInput = document.getElementById('varianInput');

        function toggleInputs(disabled) {
            idBarangInput.disabled = disabled;
            namaBarangInput.disabled = disabled;
            varianInput.disabled = disabled;
        }

        function resetInputs() {
            idBarangInput.value = '';
            namaBarangInput.value = '';
            varianInput.value = '';
        }

        selectExistingIdBarang.addEventListener('change', function() {
            if (this.value === 'new') {
                resetInputs();
                toggleInputs(false); // Enable inputs
            } else {
                const selectedOption = this.options[this.selectedIndex];
                idBarangInput.value = this.value;
                namaBarangInput.value = selectedOption.dataset.nama;
                varianInput.value = selectedOption.dataset.varian;
                toggleInputs(true); // Disable inputs
            }
        });

        window.addEventListener('load', function() {
            // Cek apakah opsi "new" ada
            const hasNewOption = Array.from(selectExistingIdBarang.options).some(
                option => option.value === 'new'
            );

            if (hasNewOption) {
                selectExistingIdBarang.value = 'new';
                toggleInputs(false);
            } else {
                selectExistingIdBarang.dispatchEvent(new Event('change'));
            }
        });
    </script>


    <script>
        // Fungsi untuk membuka modal filter
        function openFilterModal() {
        document.getElementById('filterModal').style.display = 'flex';
        }

        // Fungsi untuk menutup modal filter
        function closeFilterModal() {
        document.getElementById('filterModal').style.display = 'none';
        }

        // Fungsi untuk mengaplikasikan filter pada tabel
        function applyFilter() {
        const filterOption = document.getElementById('filterOption').value;
        // Dapatkan semua baris tabel (tbody)
        const tbody = document.getElementById('produkTableBody');
        // Konversi HTMLCollection menjadi Array
        const rows = Array.from(tbody.querySelectorAll('tr'));

        // Fungsi pembantu untuk mengubah nilai teks menjadi number
        function toNumber(value) {
            return parseFloat(value.replace(/[^0-9.-]+/g,"")) || 0;
        }

        // Fungsi pembantu untuk mengkonversi teks ke tanggal
        function toDate(value) {
            // Jika kosong atau invalid, kembalikan waktu yang jauh di masa depan agar mendapatkan urutan terakhir
            const date = new Date(value);
            return isNaN(date.getTime()) ? new Date(8640000000000000) : date;
        }

        // Lakukan sorting berdasarkan pilihan filter
        rows.sort(function(a, b) {
            let cellA, cellB;
            switch(filterOption) {
            case 'expiring':
                // Kolom "Tanggal Exp" berada di index 8 (0-based)
                cellA = toDate(a.cells[8].innerText);
                cellB = toDate(b.cells[8].innerText);
                return cellA - cellB; // ascending
            case 'most_stock':
                // Kolom Stok di index 4
                cellA = toNumber(a.cells[4].innerText);
                cellB = toNumber(b.cells[4].innerText);
                return cellB - cellA; // descending
            case 'least_stock':
                cellA = toNumber(a.cells[4].innerText);
                cellB = toNumber(b.cells[4].innerText);
                return cellA - cellB; // ascending
            case 'highest_buy':
                // Harga Beli di index 6
                cellA = toNumber(a.cells[6].innerText);
                cellB = toNumber(b.cells[6].innerText);
                return cellB - cellA; // descending
            case 'lowest_buy':
                cellA = toNumber(a.cells[6].innerText);
                cellB = toNumber(b.cells[6].innerText);
                return cellA - cellB; // ascending
            case 'highest_sell':
                // Harga Jual di index 7
                cellA = toNumber(a.cells[7].innerText);
                cellB = toNumber(b.cells[7].innerText);
                return cellB - cellA; // descending
            case 'lowest_sell':
                cellA = toNumber(a.cells[7].innerText);
                cellB = toNumber(b.cells[7].innerText);
                return cellA - cellB; // ascending
            default:
                return 0;
            }
        });

        // Hapus semua baris lama
        tbody.innerHTML = '';
        // Tambahkan baris yang sudah disortir kembali ke dalam tbody
        rows.forEach(function(row, index) {
            // Update nomor urut di kolom pertama (index 0)
            row.cells[0].innerText = index + 1;
            tbody.appendChild(row);
        });

        closeFilterModal();
        }
    </script>

<script>
    // Fungsi untuk membuka popup edit dan mengisi data produk
    function openEditPopup(button) {
      // Dapatkan data dari tombol edit (data-record-id, data-id_barang, dsb)
      const recordId = button.getAttribute('data-record-id');
      const idBarang = button.getAttribute('data-id_barang');
      const nama = button.getAttribute('data-nama');
      const varian = button.getAttribute('data-varian');
      const stok = button.getAttribute('data-stok');
      const tanggalMasuk = button.getAttribute('data-tanggal_masuk') || ''; // Pastikan atribut tersedia atau diset
      const hargaBeli = button.getAttribute('data-harga-beli');
      const hargaJual = button.getAttribute('data-harga_jual');
      const tanggalExp = button.getAttribute('data-tanggal_exp') || '';

      // Set action form update, misalnya ke route barangs.update (asumsikan route diatur dengan parameter record)
      // Contoh: /barangs/{id} dengan method PUT
      const form = document.getElementById('editProductForm');
      form.action = `/barangs/${recordId}`; // Pastikan route update sesuai dengan definisi routing Anda

      // Isi field di form
      document.getElementById('editIdBarangInput').value = idBarang;
      document.getElementById('editNamaBarangInput').value = nama;
      document.getElementById('editVarianInput').value = varian;
      document.getElementById('editStokInput').value = stok;
      document.getElementById('editTanggalMasukInput').value = tanggalMasuk;
      document.getElementById('editHargaBeliInput').value = hargaBeli;
      document.getElementById('editHargaJualInput').value = hargaJual;
      document.getElementById('editTanggalExpInput').value = tanggalExp;

      // Jika anda ingin juga menampilkan preview gambar, bisa diatur di sini

      // Tampilkan popup edit
      document.getElementById('editPopupForm').style.display = 'flex';
    }

    // Fungsi untuk menutup popup edit
    function closeEditPopup() {
      document.getElementById('editPopupForm').style.display = 'none';
    }

    // Optional: Jika ingin mirip fitur select ID Barang di form edit
    const editSelectExistingIdBarang = document.getElementById('editSelectExistingIdBarang');
    const editIdBarangInput = document.getElementById('editIdBarangInput');
    const editNamaBarangInput = document.getElementById('editNamaBarangInput');
    const editVarianInput = document.getElementById('editVarianInput');

    editSelectExistingIdBarang.addEventListener('change', function() {
      if (this.value === 'new') {
        // Jika pilih "Tambah Lainnya", kosongkan field dan buat bisa di-edit
        editIdBarangInput.value = '';
        editNamaBarangInput.value = '';
        editVarianInput.value = '';
        editIdBarangInput.readOnly = false;
        editNamaBarangInput.readOnly = false;
        editVarianInput.readOnly = false;
      } else {
        // Jika memilih produk yang sudah ada, isi otomatis dan buat read-only
        const selectedOption = this.options[this.selectedIndex];
        const existingNama = selectedOption.getAttribute('data-nama');
        const existingVarian = selectedOption.getAttribute('data-varian');
        editIdBarangInput.value = this.value;
        editNamaBarangInput.value = existingNama;
        editVarianInput.value = existingVarian;
        editIdBarangInput.readOnly = true;
        editNamaBarangInput.readOnly = true;
        editVarianInput.readOnly = true;
      }
    });

    // Saat halaman load, inisialisasi select di form edit dengan "Tambah Lainnya"
    window.addEventListener('load', function() {
      if(editSelectExistingIdBarang) {
        editSelectExistingIdBarang.value = 'new';
        editIdBarangInput.readOnly = false;
        editNamaBarangInput.readOnly = false;
        editVarianInput.readOnly = false;
      }
    });
  </script>

<script>
    const allBarangs = @json($barangs);

    const selectBarang = document.getElementById('selectBarang');
    const selectExp = document.getElementById('selectExp');

    const detailNama = document.getElementById('detailNama');
    const detailVarian = document.getElementById('detailVarian');
    const detailStok = document.getElementById('detailStok');
    const detailHarga = document.getElementById('detailHarga');

    const formIdBarang = document.getElementById('formIdBarang');
    const formExpDate = document.getElementById('formExpDate');

    // Event: saat user memilih ID Barang
    selectBarang.addEventListener('change', function() {
      const selectedIdBarang = this.value;
      // Kosongkan selectExp, lalu isi dengan Tanggal Exp milik ID Barang terpilih
      selectExp.innerHTML = '<option value="" disabled selected>-- Pilih Tanggal Exp --</option>';

      // Ambil array barangs yang cocok
      const matchedBarangs = allBarangs.filter(b => b.id_barang === selectedIdBarang);

      // Isi dropdown Tanggal Exp
      matchedBarangs.forEach(item => {
        // Hati-hati: item.tanggal_exp bisa null/undefined
        if (item.tanggal_exp) {
          let opt = document.createElement('option');
          opt.value = item.tanggal_exp;
          opt.textContent = item.tanggal_exp;
          // Simpan data lain di dataset jika perlu
          opt.dataset.nama = item.nama_barang;
          opt.dataset.varian = item.varian;
          opt.dataset.stok = item.stok;
          opt.dataset.harga = item.harga_jual;
          selectExp.appendChild(opt);
        }
      });

      // Aktifkan selectExp
      selectExp.disabled = false;

      // Kosongkan detail tampilan
      detailNama.value = '';
      detailVarian.value = '';
      detailStok.value = '';
      detailHarga.value = '';
      formIdBarang.value = '';
      formExpDate.value = '';
    });

    // Event: saat user memilih Tanggal Exp
    selectExp.addEventListener('change', function() {
      const selectedExp = this.value;
      const selectedIdBarang = selectBarang.value;

      // Cari barang yg ID dan Tanggal Exp nya sesuai
      const matched = allBarangs.find(b =>
        b.id_barang === selectedIdBarang &&
        (b.tanggal_exp === selectedExp)
      );

      if (matched) {
        detailNama.value = matched.nama_barang;
        detailVarian.value = matched.varian;
        detailStok.value = matched.stok;
        // Format harga: Rp xxx
        detailHarga.value = 'Rp ' + Number(matched.harga_jual).toLocaleString('id-ID');

        // Set hidden field untuk form submission
        formIdBarang.value = matched.id_barang;
        formExpDate.value = matched.tanggal_exp;
      }
    });

    function closeBarangKeluarPopup() {
      document.getElementById('barangKeluarForm').style.display = 'none';
    }
  </script>


</body>
</html>
