<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CoHive</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* === GLOBAL RESET & LAYOUT === */
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
      border: 1px solid #ccc;
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
      text-decoration: none;
    }
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
    .sidebar.closed .burger-btn {
      padding: 8px 9px;
    }
    .content {
      position: relative;
      flex: 1;
      border: 1px solid #ccc;
      border-radius: 12px;
      background-color: #fff;
      overflow: hidden;
      padding: 30px;
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

    /* ==========================
       Daftar Anggota (Grid)
    ========================== */
    .anggota-container {
      border-radius: 12px;
      position: relative;
      z-index: 2;
    }
    .anggota-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }
    .anggota-header h2 {
      color: #333;
      font-size: 20px;
    }
    .anggota-add-btn {
      background-color: #333;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      font-size: 14px;
      cursor: pointer;
    }
    .anggota-card-grid {
      display: grid;
      grid-template-columns: repeat(4, 23%);
      gap: 20px;
      justify-content: space-between;
    }
    .anggota-card {
      background: #fff;
      border: 1px solid #ccc;
      border-radius: 12px;
      text-align: center;
      padding: 20px;
      transition: 0.3s;
    }
    .anggota-card:hover {
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .anggota-profile-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .anggota-card h3 {
      margin-bottom: 3px;
      color: #333;
      font-size: 16px;
    }
    .anggota-card p {
      font-size: 13px;
      color: #666;
    }
    .anggota-profile-btn {
      text-decoration: none;
      background-color: #333;
      color: #fff;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      font-size: 13px;
      cursor: pointer;
      display: inline-block;
      margin-top: 8px;
    }

    /* ================================
       Detail Profil (Tampilan Lengkap)
    ================================ */
    #profileContainer {
      display: none;
      background: #fff;
      border-radius: 12px;
      padding: 10px 20px 20px 20px;
      position: relative;
      z-index: 2;
      min-height: 550px;
    }
    .profile-back-btn {
      display: inline-flex;
      align-items: center;
      text-decoration: none;
      color: #333;
      font-weight: bold;
      margin-bottom: 15px;
    }
    .profile-back-btn i {
      margin-right: 5px;
    }
    .profile-detail-header {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 25px;
    }
    .profile-detail-header h2 {
      font-size: 22px;
      color: #333;
    }
    .profile-detail-header span {
      color: #999;
      font-size: 14px;
      margin-left: auto;
    }
    .profile-detail-content {
      display: flex;
      gap: 30px;
    }
    /* Kiri: Kartu Profil */
    .profile-detail-left {
      background: linear-gradient(to bottom, grey 29%, white 29%);
      flex: 1;
      max-width: 350px;
      border: 1px solid #ccc;
      border-radius: 12px;
      padding: 20px;
      text-align: center;
    }
    .profile-detail-left img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
      margin-top: 110px;
    }
    .profile-detail-left h3 {
      font-size: 18px;
      margin-bottom: 5px;
    }
    .profile-detail-left .detail-role {
      font-size: 14px;
      color: #666;
      margin-bottom: 10px;
    }
    .profile-detail-left p {
      font-size: 13px;
      color: #555;
      text-align: center;
      line-height: 1.5;
    }
    /* Kanan: Form Detail */
    .profile-detail-right {
      flex: 2;
      border: 1px solid #ccc;
      border-radius: 12px;
      padding: 20px;
    }
    .profile-detail-right form {
      display: flex;
      flex-direction: column;
    }
    .profile-detail-right form label {
      margin-bottom: 5px;
      font-size: 14px;
      font-weight: bold;
      color: #333;
    }
    .profile-detail-right form input {
      margin-bottom: 15px;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .profile-detail-right form .update-btn {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border-radius: 10px;
      font-size: 14px;
      cursor: pointer;
      border: none;
      margin-top: 10px;
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
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="profile">
        <img src="{{ $profile && $profile->photo ? asset('storage/' . $profile->photo) : asset('img/ProfileKosong.jpg') }}" alt="Foto Profil">
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
                    <a href="/anggota" class="dash">
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

    <!-- Main Container -->
<div class="main-container">
    <div class="header">
      <h1>CoHive</h1>
      <a href="{{ route('logout') }}" class="logout-btn">
        <i class="fa fa-sign-out-alt"></i> Logout
      </a>
      <div class="shape hex2"></div>
    </div>

    <!-- Konten Utama -->
    <div class="content">
      {{-- <div class="shape hex1 tilt"></div>
      <div class="shape hex3"></div> --}}

      <!-- Grid Anggota -->
      <div id="anggotaContainer">
        <div class="anggota-container">
          <div class="anggota-header">
            <h2>Daftar Anggota</h2>
            <button class="anggota-add-btn">Tambah Anggota <span>+</span></button>
          </div>
          <div class="anggota-card-grid">
            @foreach($userData as $userss)
              <div
                class="anggota-card"
                data-id="{{ $userss->id }}"
                data-username="{{ $userss->username }}"
                data-email="{{ $userss->email }}"
                data-role="{{ $userss->role }}"
                data-name="{{ $userss->profile->name ?? '-' }}"
                data-birthdate="{{ $userss->profile->birth_date ?? '-' }}"
                data-gender="{{ $userss->profile->gender ?? '-' }}"
                data-phone="{{ $userss->profile->phone ?? '-' }}"
                data-address="{{ $userss->profile->address ?? '-' }}"
                data-photo="{{ $userss->profile && $userss->profile->photo
                               ? asset('storage/' . $userss->profile->photo)
                               : asset('img/ProfileKosong.jpg') }}"
              >
                <img
                  src="{{ $userss->profile && $userss->profile->photo
                          ? asset('storage/' . $userss->profile->photo)
                          : asset('img/ProfileKosong.jpg') }}"
                  alt="Foto Profil"
                  class="anggota-profile-img"
                />
                <h3>{{ $userss->username }}</h3>
                <p>{{ $userss->email }}</p>
                <p>{{ $userss->profile->gender ?? '-' }}</p>
                <p style="margin-bottom:7px">{{ $userss->profile->phone ?? '-' }}</p>
                <a
                  href="#"
                  class="anggota-profile-btn"
                  onclick="showProfile(event, this)"
                >
                  Lihat Profil
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <!-- /Grid Anggota -->

      <!-- Detail Profil -->
      <div id="profileContainer" style="display:none">
        <a
          href="#"
          class="profile-back-btn"
          onclick="backToGrid(event)"
        >
          <i class="fa fa-arrow-left"></i> Kembali ke Daftar Anggota
        </a>

        <div class="profile-detail-content">
          <!-- Kiri: Kartu Profil Besar -->
          <div class="profile-detail-left">
            <div class="card profile-card">
              <img
                id="profilePhoto"
                src="{{ asset('img/ProfileKosong.jpg') }}"
                alt="Foto Profil"
                class="profile-img"
              />
              <h3 id="profileUsername">Username</h3>
              <p id="profileRole" class="detail-role">Role</p>
              <p id="profileName">Nama: -</p>
              <p id="profileBirthDate">Tanggal Lahir: -</p>
            </div>
          </div>

          <!-- Kanan: Form Detail Data -->
          <div class="profile-detail-right">
            <form
              id="updateProfileForm"
              method="POST"
              enctype="multipart/form-data"
            >
              @csrf
              @method('PUT')

              <!-- Username & Email (readonly) -->
              <label for="detailUsername">Username</label>
              <input
                type="text"
                id="detailUsername"
                name="username"
                readonly
              />

              <label for="detailEmail">Email</label>
              <input
                type="email"
                id="detailEmail"
                name="email"
                readonly
              />

              <!-- Nama -->
              <label for="detailName">Name</label>
              <input
                type="text"
                id="detailName"
                name="name"
              />

              <!-- Tanggal Lahir -->
              <label for="detailBirthDate">Tanggal Lahir</label>
              <input
                type="date"
                id="detailBirthDate"
                name="birth_date"
              />

              <!-- Jenis Kelamin -->
              <label for="detailGender">Jenis Kelamin</label>
              <select
                id="detailGender"
                name="gender"
                style="margin-bottom:15px; padding:10px; border-radius:8px; border:1px solid #ccc;"
              >
                <option value="male">Laki-laki</option>
                <option value="female">Perempuan</option>
              </select>

              <!-- Telepon -->
              <label for="detailPhone">Telepon</label>
              <input
                type="text"
                id="detailPhone"
                name="phone"
              />

              <!-- Alamat -->
              <label for="detailAddress">Alamat</label>
              <input
                type="text"
                id="detailAddress"
                name="address"
              />

              <!-- Role -->
              <label for="detailRole">Role</label>
              <select
                id="detailRole"
                name="role"
                style="margin-bottom:15px; padding:10px; border-radius:8px; border:1px solid #ccc;"
              >
                <option value="Admin">Admin</option>
                <option value="Karyawan">Karyawan</option>
              </select>

              <!-- Foto Profil -->
              <label for="photo">Foto Profil</label>
              <input
                type="file"
                id="photo"
                name="photo"
              />

              <button type="submit" class="update-btn">
                Perbarui Data
              </button>
            </form>
          </div>
        </div>
      </div>
      <!-- /Detail Profil -->
    </div>
    <!-- End Content -->
  </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('profileContainer').style.display = 'none';
    });

    function showProfile(evt, btn) {
      evt.preventDefault();
      const card = btn.closest('.anggota-card');
      if (!card) return;

      // ambil data dari atribut
      const id        = card.dataset.id;
      const username  = card.dataset.username;
      const email     = card.dataset.email;
      const role      = card.dataset.role;
      const name      = card.dataset.name;
      const birth     = card.dataset.birthdate;
      const gender    = card.dataset.gender;
      const phone     = card.dataset.phone;
      const address   = card.dataset.address;
      const photo     = card.dataset.photo;

      // update kiri
      document.getElementById('profilePhoto').src            = photo;
      document.getElementById('profileUsername').textContent = username;
      document.getElementById('profileRole').textContent     = role;
      document.getElementById('profileName').textContent     = 'Nama: ' + name;
      document.getElementById('profileBirthDate').textContent= 'Tanggal Lahir: ' + birth;

      // update form action & isi field
      const form = document.getElementById('updateProfileForm');
      form.action = `/anggota/${id}`;

      document.getElementById('detailUsername').value    = username;
      document.getElementById('detailEmail').value       = email;
      document.getElementById('detailName').value        = name;
      document.getElementById('detailBirthDate').value   = birth;
      document.getElementById('detailGender').value      = gender;
      document.getElementById('detailPhone').value       = phone;
      document.getElementById('detailAddress').value     = address;
      document.getElementById('detailRole').value        = role;

      // toggle visibility
      document.getElementById('anggotaContainer').style.display = 'none';
      document.getElementById('profileContainer').style.display = 'block';
    }

    function backToGrid(evt) {
      evt.preventDefault();
      document.getElementById('profileContainer').style.display  = 'none';
      document.getElementById('anggotaContainer').style.display = 'block';
    }
  </script>

</body>
</html>
