<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

  </style>
</head>
<body>
  <div class="wrapper">
    <div class="sidebar" id="sidebar">
      <div class="profile">
        <img src="img/me.jpg" alt="Profile" />
        <!-- Tombol burger di dalam sidebar -->
        <button class="burger-btn" id="burger-btn"><i class="fa fa-bars"></i></button>
        <h3>Thomas Edison</h3>
        <p>Karyawan</p>
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
        <button class="logout-btn"><i class="fa fa-sign-out-alt"></i> Logout</button>
        <div class="shape hex2"></div>
      </div>
      <div class="content">
        <div class="shape hex1 tilt"></div>
        <div class="shape hex3"></div>

        <div class="dashboard-wrapper">
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
</body>
</html>
