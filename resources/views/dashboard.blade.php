<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CoHive</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="homepage.css" />
  <style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
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



    /* ------CSS MAIN CONTENT------------ */
    /* Container utama untuk konten dashboard */
    .dashboard-content {
        padding: 5%;
      position: relative;
      z-index: 2; /* agar di atas shape */
    }

    /* Judul "Dashboard" */
    .dashboard-content h2 {
      font-size: 30px;
      color: #252641;
      margin-bottom: 10px;
      font-weight: 600;
    }

    /* Bagian info singkat: Kategori, Barang Masuk, Barang Keluar, Stok Rendah */
    .info-cards {
        padding : 2%;
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 20px;
    }
    .info-card {
      flex: 1;
      min-width: 220px;
      background: #FFFFFF;
      border: 2px solid #A6A6A6;
      border-radius: 10px;
      padding: 15px;
      position: relative;
    }
    .info-card h3 {
      font-size: 20px;
      margin-bottom: 5px;
      font-weight: 600;
      color: #000;
    }
    .info-card p {
      font-size: 30px;
      font-weight: 700;
      margin-bottom: 5px;
      color: #000;
    }
    .info-card span {
      font-size: 14px;
      color: #858D9D;
    }
    /* Warna teks merah untuk Stok Rendah */
    .info-card.red h3 {
      color: #FF0000;
    }
    .info-columns {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px; /* Jarak antar kolom */
    }

    .info-column {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    flex: 1; /* Supaya kedua kolom memiliki lebar yang sama */
    }

    .num {
    font-size: 30px;
    font-weight: bold;
    color: #333;
    }

    .text {
    font-size: 14px;
    color: #858D9D;
    }

    /* Bagian Income & Outcome */
    .finance-section {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 20px;
    }
    .finance-card {
      flex: 1;
      min-width: 300px;
      background: #FFFFFF;
      border: 2px solid #A6A6A6;
      border-radius: 20px;
      padding: 20px;
      position: relative;
    }
    .finance-card h4 {
      font-size: 20px;
      margin-bottom: 10px;
      font-weight: 600;
    }
    .finance-card .amount {
      font-size: 25px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    /* Bagian Analytics (Grafik) */
    .analytics-section {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .analytics-left {
      flex: 2;
      min-width: 500px;
      background: #FFFFFF;
      border: 2px solid #A6A6A6;
      border-radius: 20px;
      padding: 20px;
      position: relative;
    }
    .analytics-left h3 {
      font-size: 24px;
      margin-bottom: 20px;
      font-weight: 700;
      color: #2A2929;
    }
    /* Tempatkan chart di sini (manual atau library chart) */
    .chart-placeholder {
      width: 100%;
      height: 250px;
      background: #F9F9F9;
      border: 1px dashed #ccc;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #999;
      font-size: 16px;
    }

    /* Bagian Kalender & Jadwal */
    .analytics-right {
      flex: 1;
      min-width: 300px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    .calendar-card,
    .schedule-card {
      background: #FFFFFF;
      border: 2px solid #A6A6A6;
      border-radius: 20px;
      padding: 20px;
      position: relative;
    }
    .calendar-card h3,
    .schedule-card h3 {
      font-size: 20px;
      margin-bottom: 10px;
      font-weight: 600;
    }
    .calendar {
      width: 100%;
      height: 200px;
      background: #F9F9F9;
      border: 1px dashed #ccc;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #999;
      font-size: 16px;
    }
    .schedule {
      width: 100%;
      height: 150px;
      background: #F9F9F9;
      border: 1px dashed #ccc;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: center;
      color: #000;
      padding: 10px;
      gap: 5px;
      font-size: 14px;
    }
    .schedule .time {
      font-weight: 600;
      color: #000;
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
        <img src="img/me.jpg" alt="Profile" />
        <!-- Tombol burger di dalam sidebar -->
        <button class="burger-btn" id="burger-btn"><i class="fa fa-bars"></i></button>
        <h3>Thomas Edison</h3>
        <p>Karyawan</p>
        <div class="garis"></div>
      </div>
      <ul class="menu">
        <li>
          <a href="/" class="dash">
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
          <a href="/stok-barang">
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

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <h2>Dashboard</h2>

            <!-- Info Cards -->
            <div class="info-cards">
              <div class="info-card">
                <h3>Kategori</h3>
                <p>12</p>
                <span>Last 7 days</span>
              </div>
              <div class="info-card">
                <h3>Total Barang Masuk</h3>
                <p>22</p>
                <span>Rp 120.000</span>
              </div>
              <div class="info-card">
                <h3>Data Barang Keluar</h3>
                <p>22</p>
                <span>Rp 120.000</span>
              </div>
              <div class="info-card red">
                <h3>Stok Rendah</h3>
                <div class="info-columns">
                  <div class="info-column">
                    <p class="num">7</p>
                    <span class="text">Dipesan</span>
                  </div>
                  <div class="info-column">
                    <p class="num">8</p>
                    <span class="text">stok tersedia<br>saat ini</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Finance (Income & Outcome) -->
            <div class="finance-section">
              <div class="finance-card">
                <h4>Total Income</h4>
                <div class="amount">$632.000</div>
                <!-- Contoh persentase naik/turun -->
                <small style="color: #02B15A; background: rgba(2, 177, 90, 0.15); padding: 4px 8px; border-radius: 8px;">+1.29%</small>
              </div>
              <div class="finance-card">
                <h4>Total Outcome</h4>
                <div class="amount">$632.000</div>
                <small style="color: #EB001B; background: rgba(235, 0, 27, 0.15); padding: 4px 8px; border-radius: 8px;">-0.85%</small>
              </div>
            </div>

            <!-- Analytics & Calendar/Schedule -->
            <div class="analytics-section">
              <!-- Bagian Kiri: Analytics/Chart -->
              <div class="analytics-left">
                <h3>Analytics</h3>
                <div class="chart-placeholder">
                  (Bar Chart Placeholder)
                </div>
              </div>
              <!-- Bagian Kanan: Calendar & Schedule -->
              <div class="analytics-right">
                <div class="calendar-card">
                  <h3>September 2023</h3>
                  <div class="calendar">
                    (Calendar Placeholder)
                  </div>
                </div>
                <div class="schedule-card">
                  <h3>Sep 12, Monday</h3>
                  <div class="schedule">
                    <div class="time">2 PM</div>
                    <div>Adobe XD Live Class</div>
                  </div>
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
