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
      width: 300px;
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
      padding: 11px 18px;
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
    margin-bottom: 12px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 6px;
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
        <img src="{{ $profile && $profile->photo ? asset('storage/' . $profile->photo) : asset('img/ProfileKosong.jpg') }}" alt="Foto Profil">
        <!-- Tombol burger di dalam sidebar -->
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
        <li>
          <a href="/anggota">
            <i class="fa fa-users"></i>
            <span class="menu-text">Daftar Anggota</span>
          </a>
        </li>
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
        <li>
          <a href="/pengaturan">
            <i class="fa fa-cog"></i>
            <span class="menu-text">Pengaturan</span>
          </a>
        </li>
      </ul>
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
        <div class="dashboard-wrapper">
            <h2 style="font-size: 19px; margin-bottom: 15px;">Stock Barang</h2>
            <div class="dashboard-box">
              <div class="section">
                <h4>Kategori</h4>
                <h2>12</h2>
                <p>Last 7 days</p>
              </div>
              <div class="section">
                <h4>Total Barang Masuk</h4>
                <div>
                  <h2>22</h2>
                  <p>Last 7 days</p>
                  <h2>Rp 120.000</h2>
                  <p>nilai Harga</p>
                </div>
              </div>
              <div class="section">
                <h4>Data Barang Keluar</h4>
                <div>
                  <h2>22</h2>
                  <p>Last 7 days</p>
                  <h2>Rp 120.000</h2>
                  <p>nilai Harga</p>
                </div>
              </div>
              <div class="section">
                <h4 class="text-red">Stok Rendah</h4>
                <div>
                  <h2>7</h2>
                  <p>Dipesan</p>
                  <h2>2</h2>
                  <p>Stok Tersedia saat ini</p>
                </div>
              </div>
            </div>

            <div class="produk-container">
                <h2>Daftar Produk</h2>

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
                    <button class="btn btn-blue" onclick="openPopup()">Add Product</button>
                    <button class="btn btn-gray">Filters</button>
                  </div>
                </div>

                <table class="produk-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>ID Barang</th>
                      <th>Nama Barang</th>
                      <th>Jenis Barang</th>
                      <th>Stok</th>
                      <th>Tanggal Masuk</th>
                      <th>Harga Beli</th>
                      <th>Harga Jual</th>
                      <th>Tanggal Exp</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($barangs as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $barang->id_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->jenis_barang }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>{{ $barang->tanggal_masuk }}</td>
                            <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                            <td>{{ $barang->tanggal_exp }}</td>
                            <td>
                                @foreach ($barangs as $barang)
                                <button onclick="openDetailPopup(this)"
                                  data-id="{{ $barang->id_barang }}"
                                  data-nama="{{ $barang->nama_barang }}"
                                  data-jenis="{{ $barang->jenis_barang }}"
                                  data-exp="{{ $barang->tanggal_exp }}"
                                  data-gambar="{{ asset('storage/' . $barang->gambar) }}"
                                  data-stok="{{ $barang->stok }}"
                                  data-harga-beli="{{ $barang->harga_beli }}"
                                  data-harga-jual="{{ $barang->harga_jual }}">
                                  Detail
                                </button>
                              @endforeach
                            </td>
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
    </div>
  </div>


  <!-- Popup -->
    <div class="popup-form" id="popupForm">
        <div class="popup-content">
        <h2>Produk baru</h2>
       {{-- Upload Gambar --}}
       <div class="image-upload">
        <div class="image-box" id="imageBox">
            <img id="imagePreview" src="#" alt="Preview" style="display: none;">
            <span id="imageText">Drag image here<br>or<br><a href="#">Browse image</a></span>
            <input type="file" name="gambar" id="gambarInput" style="display: none;">
        </div>
      </div>

        <form action="{{ route('barangs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>ID Barang</label>
            <input type="text" placeholder="Enter product ID" name="id_barang" value="{{ old('id_barang') }}">

            <label>Nama Barang</label>
            <input type="text" placeholder="Enter product name" name="nama_barang" value="{{ old('nama_barang') }}">

            <label>Jenis Barang</label>
            <select name="jenis_barang">
                <option value="">Select product category</option>
                <option value="Minuman" {{ old('jenis_barang') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                <option value="Tekstil" {{ old('jenis_barang') == 'Tekstil' ? 'selected' : '' }}>Tekstil</option>
                <!-- Tambah kategori lainnya -->
            </select>

            <label>Stok</label>
            <input type="number" placeholder="Enter current stock" name="stok" value="{{ old('stok') }}">

            <label>Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}">

            <label>Harga Beli</label>
            <input type="number" placeholder="Enter buying price" name="harga_beli" step="0.01" value="{{ old('harga_beli') }}">

            <label>Harga Jual</label>
            <input type="number" placeholder="Enter selling price" name="harga_jual" step="0.01" value="{{ old('harga_jual') }}">

            <label>Tanggal Kadaluarsa</label>
            <input type="date" name="tanggal_exp" value="{{ old('tanggal_exp') }}">

            <div class="popup-buttons">
                <button type="button" class="btn btn-gray" onclick="window.history.back()">Discard</button>
                <button type="submit" class="btn btn-yellow">Add Product</button>
            </div>
        </form>

        </div>
    </div>



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
                <span class="value">N/A</span> <!-- tidak ada field satuan di database -->
              </div>

              <h3>Detail Supplier</h3>
              <div class="detail-row">
                <span class="label">Nama Supplier</span>
                <span class="value">N/A</span>
              </div>
              <div class="detail-row">
                <span class="label">No HP</span>
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

    <script>
        const burgerBtn = document.getElementById('burger-btn');
        const sidebar = document.getElementById('sidebar');

        burgerBtn.addEventListener('click', () => {
        sidebar.classList.toggle('closed');
        });
    </script>

    <script>
        function openPopup() {
        document.getElementById("popupForm").style.display = "flex";
        }

        function closePopup() {
        document.getElementById("popupForm").style.display = "none";
        }
    </script>

    <script>
        document.querySelector('.btn-yellow').addEventListener('click', function(e) {
        const form = this.closest('form');
        const fileInput = document.getElementById('gambarInput');

        if (fileInput && !form.contains(fileInput)) {
            form.appendChild(fileInput);
        }
        });
    </script>

    <script>
        const imageBox = document.getElementById('imageBox');
        const imagePreview = document.getElementById('imagePreview');
        const imageText = document.getElementById('imageText');
        const fileInput = document.getElementById('gambarInput');

        // Klik box = buka file chooser
        imageBox.addEventListener('click', () => {
        fileInput.click();
        });

        // Preview gambar setelah dipilih
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
    </script>

    <script>
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
    </script>


    <script>
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
    </script>


</body>
</html>
