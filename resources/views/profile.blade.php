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
      font-family: poppins, sans-serif;
    }
    .wrapper {
      display: flex;
      min-height: 100vh;
      padding: 15px 15px 15px 0;
      gap: 15px;
      transition: all 0.3s ease;
      background-color: #F1F1F1; /* Agar mirip background abu-abu pada contoh */
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
      background-color: #fff;
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
      padding: 30px; /* Tambahan padding agar form tidak menempel */
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

    /* ================== TAMBAHAN CSS UNTUK FORM PROFIL ================== */
    .profile-form-wrapper {
      position: relative;
      z-index: 2; /* agar berada di atas shape */
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      max-width: 100%;
      margin: 0 auto; /* center */
    }
    .profile-form-wrapper h2 {
      font-size: 20px;
      margin-bottom: 20px;
    }
    .avatar-container {
      position: relative;
      width: 120px;
      height: 120px;
      margin: 0 auto 30px auto;
    }
    .avatar-container img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      display: block;
      border: 2px solid #FFD54F;
    }
    .camera-icon {
      position: absolute;
      bottom: 0;
      right: 0;
      background-color: #FFD54F;
      color: #000;
      width: 35px;
      height: 35px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 0 3px rgba(0,0,0,0.3);
    }
    /* Grid layout untuk form */
    .profile-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-gap: 20px;
    }
    .form-group {
      display: flex;
      flex-direction: column;
    }
    .form-group label {
      font-size: 14px;
      margin-bottom: 6px;
      font-weight: 500;
    }
    .form-group input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }
    /* Address full width */
    .address-group {
      grid-column: 1 / 3; /* agar kolom address melebar 2 kolom */
      display: flex;
      flex-direction: column;
    }
    .address-group label {
      font-size: 14px;
      margin-bottom: 6px;
      font-weight: 500;
    }
    .address-group input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }
    .save-button {
      margin-top: 20px;
      grid-column: 1 / 3; /* tombol melebar full */
      justify-self: end; /* agar tombol di sisi kanan */
    }
    .save-button button {
      background-color: #FFD54F;
      color: #000;
      font-weight: bold;
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
    }
    .save-button button:hover {
      background-color: #333;
      color: #fff;
    }

    @media(max-width: 600px) {
      .profile-form {
        grid-template-columns: 1fr; /* jadi satu kolom saat layar sempit */
      }
      .address-group {
        grid-column: 1 / 2;
      }
      .save-button {
        grid-column: 1 / 2;
        justify-self: start;
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
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
      <div class="profile">
        <img src="{{ $profile && $profile->photo ? asset('storage/' . $profile->photo) : 'https://via.placeholder.com/120' }}" alt="Foto Profil" style="border: 2px solid #FFD54F;">
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
          <a href="/profile" class="dash">
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

    <!-- MAIN CONTAINER -->
    <div class="main-container">
      <!-- HEADER -->
      <div class="header">
        <h1>CoHive</h1>
        <button class="logout-btn"><i class="fa fa-sign-out-alt"></i> Logout</button>
        <div class="shape hex2"></div>
      </div>

      <!-- CONTENT -->
      <div class="content">
        <!-- Shapes background -->
        <div class="shape hex1 tilt"></div>
        <div class="shape hex3"></div>
            <!-- BAGIAN FORM PROFIL -->
            <div class="profile-form-wrapper">
                <h2>Profil</h2>
                <div class="avatar-container">
                  <!-- Tampilkan foto profil jika ada, jika tidak tampilkan placeholder -->
                  <img src="{{ $profile && $profile->photo ? asset('storage/' . $profile->photo) : 'https://via.placeholder.com/120' }}" alt="Foto Profil">
                  <div class="camera-icon" onclick="document.getElementById('photo').click()">
                    <i class="fa fa-camera"></i>
                  </div>
                </div>
                <form class="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Thomas Edison" value="{{ old('full_name', $users->name) }}">
                  </div>

                  <div class="form-group">
                    <label for="birthdate">Birthdate</label>
                    <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate', $profile->birth_date ?? '') }}">
                  </div>

                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" style="padding: 10px; border: 1px solid #ccc;height: 44px; border-radius: 6px;">
                      <option value="" disabled {{ old('gender', $profile->gender ?? '') ? '' : 'selected' }}>Select Gender</option>
                      <option value="male" {{ (old('gender', $profile->gender ?? '') === 'male') ? 'selected' : '' }}>Male</option>
                      <option value="female" {{ (old('gender', $profile->gender ?? '') === 'female') ? 'selected' : '' }}>Female</option>
                      <option value="other" {{ (old('gender', $profile->gender ?? '') === 'other') ? 'selected' : '' }}>Other</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="+62xxxx" value="{{ old('phone', $profile->phone ?? '') }}">
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <!-- Email diambil dari user login dan tidak bisa diubah -->
                    <input type="email" id="email" name="email" placeholder="thomas.edison@example.com" value="{{ $users->email }}" disabled>
                  </div>

                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="2118 Thornridge Cir, Syracuse, Connecticut 35624" value="{{ old('address', $profile->address ?? '') }}">
                  </div>

                  <!-- Input file tersembunyi untuk upload foto profil -->
                  <input type="file" name="photo" id="photo" style="display:none;" accept="image/*">

                  <div class="save-button">
                    <button type="submit">Simpan Perubahan</button>
                  </div>
                </form>
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
