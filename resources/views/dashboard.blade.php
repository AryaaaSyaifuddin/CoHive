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
      font-family: Poppins, sans-serif;
    }
    body { background: #f3f4f6; color: #374151; }
    .wrapper {
      display: flex;
      min-height: 100vh;
      padding: 15px 15px 15px 0;
      gap: 15px;
      transition: all 0.3s ease;
    }
    .sidebar {
      width: 280px;
      border: 1px solid #ddd;
      border-radius: 0 12px 12px 0;
      background: #fff;
      padding: 20px;
      transition: width 0.3s ease;
      position: relative;
    }
    .sidebar.closed { width: 80px; }
    .profile { text-align: center; margin-bottom: 20px; position: relative; }
    .profile img {
      width: 80px; height: 80px;
      border-radius: 50%;
      object-fit: cover;
      transition: opacity 0.3s ease;
    }
    .profile h3, .profile p, .garis {
      transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .profile h3 { margin-top: 10px; font-size: 18px; }
    .profile p { font-size: 14px; color: #666; }
    .sidebar.closed .profile img,
    .sidebar.closed .profile h3,
    .sidebar.closed .profile p,
    .sidebar.closed .garis {
      opacity: 0; visibility: hidden;
    }
    .garis {
      width: 100%; height: 1px;
      background-color: #ddd;
      margin: 25px 0 35px;
    }
    .menu { list-style: none; padding-left: 0; }
    .menu li { margin-bottom: 10px; }
    .menu a {
      display: flex; align-items: center;
      text-decoration: none;
      padding: 9px 18px;
      border-radius: 10px;
      font-size: 13px; color: #000;
      background: #FFD54F; font-weight: bold;
      transition: background 0.3s, color 0.3s;
    }
    .menu a i { margin-right: 10px; }
    .menu a:hover { background: #333; color: #fff; }
    .menu .dash { background: #333; color: #fff; }
    .sidebar.closed .menu a { padding: 12px; }
    .sidebar.closed .menu-text { display: none; }

    .main-container {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 15px;
      position: relative;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid #ddd;
      border-radius: 12px;
      padding: 20px;
      background: #fff;
      position: relative;
      overflow: hidden;
    }
    .header h1 { font-size: 24px; color: #FFD54F; }
    .logout-btn {
      background: transparent;
      border: 0;
      padding: 8px 16px;
      border-radius: 20px;
      font-weight: bold;
      color: #000;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
    }
    .burger-btn {
      position: absolute;
      top: 5px; right: 5px;
      background: transparent; border: 0;
      padding: 8px 16px; border-radius: 20px;
      font-weight: bold; cursor: pointer;
      font-size: 16px; color: #000;
      z-index: 2;
    }
    .sidebar.closed .burger-btn { padding: 8px; }

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
      border: 1px solid #ddd;
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
      border: 1px solid #ddd;
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

    .dashboard-wrapper {
    padding: 30px;
    position: relative;
    z-index: 2;
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
          <a href="/" class="dash">
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
        {{-- <div class="shape hex1 tilt"></div>
        <div class="shape hex3"></div> --}}

        <div id="produk-content">
            <div class="dashboard-wrapper">
                <h2 style="font-size: 25px; margin-bottom: 15px;">Dashboard</h2>

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
