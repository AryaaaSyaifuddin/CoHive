<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>CoHive - Jadwal Anggota</title>
  <script>
    const authUser = @json(auth()->user());
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
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
      border: 1px solid #ddd;
      border-radius: 12px;
      background-color: #fff;
      overflow: hidden;
      padding: 20px;
      display: flex;
      flex-direction: column;
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
    /* Styling Kalender dan Daily View */
    .calendar-container {
      display: flex;
      gap: 20px;
      z-index: 2;
      position: relative;
      margin-bottom: 20px;
    }
    .mini-calendar {
      width: 280px;
      background: white;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 0 5px rgba(0,0,0,0.05);
    }
    .calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }
    .calendar-title {
      font-size: 16px;
      font-weight: bold;
    }
    .calendar-nav {
      display: flex;
      gap: 5px;
    }
    .calendar-nav button {
      background: #FFD54F;
      border: none;
      padding: 3px 8px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 12px;
    }
    .calendar-weekdays {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      text-align: center;
      font-weight: bold;
      font-size: 12px;
      margin-bottom: 5px;
    }
    .calendar-days {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 3px;
    }
    .calendar-day {
      padding: 8px 0;
      text-align: center;
      border-radius: 5px;
      cursor: pointer;
      position: relative;
      font-size: 12px;
    }
    .calendar-day:hover {
      background: #FFD54F;
    }
    .calendar-day.today {
      background: #333;
      color: white;
    }
    .calendar-day.has-event::after {
      content: '';
      position: absolute;
      bottom: 2px;
      left: 50%;
      transform: translateX(-50%);
      width: 4px;
      height: 4px;
      background: #FFD54F;
      border-radius: 50%;
    }
    .calendar-day.other-month {
      color: #ccc;
    }
    .calendar-day.selected {
      background: #FFD54F;
      color: #000;
      font-weight: bold;
    }
    .daily-view {
      flex: 1;
      display: flex;
      flex-direction: column;
      border-radius: 10px;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      overflow: hidden;
    }
    .daily-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      border-bottom: 1px solid #eee;
    }
    .daily-title {
      font-size: 18px;
      font-weight: bold;
    }
    .daily-nav {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .daily-nav button {
      background: #FFD54F;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .daily-date {
      font-size: 16px;
      font-weight: 500;
    }
    .time-grid {
      display: flex;
      flex: 1;
      overflow-y: auto;
      max-height: 200px;
      padding-top:10px;
    }
    .time-column {
      width: 70px;
      /* display: flex;
      flex-direction: column; */
      border-right: 1px solid #eee;
    }
    .time-slot {
      height: 60px;
      display: flex;
      justify-content: flex-end;
      padding-right: 10px;
      position: relative;
    }
    .time-label {
      font-size: 12px;
      color: #666;
      margin-top: -10px;
    }
    .events-column {
      flex: 1;
      position: relative;
    }
    .events-container {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1440px; /* 24 jam * 60 menit */
    }
    .calendar-event {
      overflow-y: auto;
      position: absolute;
      left: 10px;
      right: 10px;
      border-radius: 5px;
      padding: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      cursor: pointer;
    }
    .event-title {
      font-weight: bold;
      font-size: 14px;
      margin-bottom: 3px;
    }
    .event-time {
      font-size: 12px;
      color: #333;
    }
    /* Tabel Jadwal */
    .schedule-table-container {
      z-index: 2;
      position: relative;
      flex: 1;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      border-radius: 10px;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .table-header {
      padding: 15px 20px;
      border-bottom: 1px solid #eee;
      font-weight: bold;
    }
    .table-scroll {
      overflow-y: auto;
      flex: 1;
    }
    .schedule-table {
      width: 100%;
      border-collapse: collapse;
    }
    .schedule-table th {
      text-align: left;
      padding: 12px 15px;
      font-weight: 500;
      color: #666;
      border-bottom: 1px solid #eee;
      position: sticky;
      top: 0;
      background: white;
    }
    .schedule-table td {
      padding: 12px 15px;
      border-bottom: 1px solid #eee;
    }
    .schedule-table tr:last-child td {
      border-bottom: none;
    }
    .schedule-table tr:hover td {
      background: #f9f9f9;
    }
    .status-badge {
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 12px;
      font-weight: 500;
    }
    .status-completed {
      background-color: #e8f5e9;
      color: #2e7d32;
    }
    .status-pending {
      background-color: #fff3e0;
      color: #e65100;
    }
    /* Responsif */
    @media (max-width: 768px) {
      .calendar-container {
        flex-direction: column;
      }
      .mini-calendar {
        width: 100%;
      }
    }
    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }
    .modal.show {
      display: flex;
    }
    .modal-content {
      background: white;
      border-radius: 12px;
      width: 90%;
      max-width: 500px;
      padding: 25px;
      position: relative;
      animation: modalShow 0.3s ease;
    }
    @keyframes modalShow {
      from { transform: scale(0.9); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }
    .modal-header h3 {
      font-size: 1.5rem;
      color: #333;
    }
    .close {
      font-size: 28px;
      cursor: pointer;
      color: #666;
      transition: color 0.3s;
    }
    .close:hover {
      color: #333;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-size: 14px;
      color: #666;
      font-weight: 500;
    }
    .form-group input,
    .form-group select {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s;
    }
    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #FFD54F;
      box-shadow: 0 0 0 2px rgba(255, 213, 79, 0.2);
    }
    .time-inputs {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }
    .form-actions {
      display: flex;
      gap: 10px;
      margin-top: 25px;
    }
    .cancel-btn,
    .submit-btn {
      flex: 1;
      padding: 12px;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
    }
    .cancel-btn {
      background: #f5f5f5;
      border: 1px solid #ddd;
      color: #666;
    }
    .cancel-btn:hover {
      background: #eee;
    }
    .submit-btn {
      background: #FFD54F;
      border: none;
      color: #333;
    }
    .submit-btn:hover {
      background: #ffc107;
    }
    @media (max-width: 480px) {
      .modal-content {
        width: 95%;
        padding: 20px;
      }
      .time-inputs {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
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
        @if($users->role === 'Admin')
                <li>
                    <a href="/anggota">
                        <i class="fa fa-users"></i>
                        <span class="menu-text">Daftar Anggota</span>
                    </a>
                </li>
                @endif
        <li>
          <a href="/jadwal_anggota" class="dash">
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
        <!-- Kalender dan Daily View -->
        <div class="calendar-container">
          <div class="mini-calendar">
            <div class="calendar-header">
              <div class="calendar-title">Februari 2025</div>
              <div class="calendar-nav">
                <button id="prev-month"><i class="fas fa-chevron-left"></i></button>
                <button id="next-month"><i class="fas fa-chevron-right"></i></button>
              </div>
            </div>
            <div class="calendar-weekdays">
              <div>M</div>
              <div>S</div>
              <div>S</div>
              <div>R</div>
              <div>K</div>
              <div>J</div>
              <div>S</div>
            </div>
            <div class="calendar-days" id="calendar-days">
              <!-- Hari-hari akan diisi oleh JavaScript -->
            </div>
          </div>
          <div class="daily-view">
            <div class="daily-header">
              <div class="daily-title">Daily View</div>
              <div class="daily-nav">
                <button id="prev-day"><i class="fas fa-chevron-left"></i></button>
                <div class="daily-date" id="daily-date">Senin, 15 Februari 2025</div>
                <button id="next-day"><i class="fas fa-chevron-right"></i></button>
                <button id="add-event">
                  <i class="fas fa-plus"></i> Tambah Acara
                </button>
              </div>
            </div>
            <div class="time-grid">
              <div class="time-column">
                <div class="time-slot"><span class="time-label">00:00</span></div>
                <div class="time-slot"><span class="time-label">01:00</span></div>
                <div class="time-slot"><span class="time-label">02:00</span></div>
                <div class="time-slot"><span class="time-label">03:00</span></div>
                <div class="time-slot"><span class="time-label">04:00</span></div>
                <div class="time-slot"><span class="time-label">05:00</span></div>
                <div class="time-slot"><span class="time-label">06:00</span></div>
                <div class="time-slot"><span class="time-label">07:00</span></div>
                <div class="time-slot"><span class="time-label">08:00</span></div>
                <div class="time-slot"><span class="time-label">09:00</span></div>
                <div class="time-slot"><span class="time-label">10:00</span></div>
                <div class="time-slot"><span class="time-label">11:00</span></div>
                <div class="time-slot"><span class="time-label">12:00</span></div>
                <div class="time-slot"><span class="time-label">13:00</span></div>
                <div class="time-slot"><span class="time-label">14:00</span></div>
                <div class="time-slot"><span class="time-label">15:00</span></div>
                <div class="time-slot"><span class="time-label">16:00</span></div>
                <div class="time-slot"><span class="time-label">17:00</span></div>
                <div class="time-slot"><span class="time-label">18:00</span></div>
                <div class="time-slot"><span class="time-label">19:00</span></div>
                <div class="time-slot"><span class="time-label">20:00</span></div>
                <div class="time-slot"><span class="time-label">21:00</span></div>
                <div class="time-slot"><span class="time-label">22:00</span></div>
                <div class="time-slot"><span class="time-label">23:00</span></div>
              </div>
              <div class="events-column">
                <div class="events-container" id="events-container">
                  <!-- Acara akan ditambahkan di sini oleh JavaScript -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Tabel Jadwal (menampilkan seluruh acara) -->
        <div class="schedule-table-container">
          <div class="table-header">Daftar Jadwal</div>
          <div class="table-scroll">
            <table class="schedule-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Pelatihan</th>
                  <th>Jam</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="schedule-body">
                <!-- Data jadwal akan diisi oleh JavaScript -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Tambah Acara -->
  <div id="event-modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Tambah Acara Baru</h3>
        <span class="close">&times;</span>
      </div>
      <form id="event-form">
        <div class="form-group">
          <label for="event-title">Judul Acara</label>
          <input type="text" id="event-title" required>
        </div>
        <div class="form-group">
          <label for="event-date">Tanggal</label>
          <input type="date" id="event-date" required>
        </div>
        <div class="time-inputs">
          <div class="form-group">
            <label for="start-time">Waktu Mulai</label>
            <input type="time" id="start-time" required>
          </div>
          <div class="form-group">
            <label for="end-time">Waktu Selesai</label>
            <input type="time" id="end-time" required>
          </div>
        </div>
        <div class="form-group" id="visibility-group" style="display: none;">
          <label for="event-visibility">Visibilitas</label>
          <select id="event-visibility">
            <option value="public">Umum</option>
            <option value="private">Privat</option>
          </select>
        </div>
        <div class="form-actions">
          <button type="button" class="cancel-btn">Batal</button>
          <button type="submit" class="submit-btn">Simpan</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    const burgerBtn = document.getElementById('burger-btn');
    const sidebar = document.getElementById('sidebar');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    let selectedDate = new Date(currentDate);

    burgerBtn.addEventListener('click', () => {
      sidebar.classList.toggle('closed');
    });

    // Fungsi format tanggal ke YYYY-MM-DD
    function formatDate(date) {
        return new Date(date.getTime() - (date.getTimezoneOffset() * 60000))
        .toISOString()
        .split("T")[0];
    }
    // Fungsi format tanggal untuk tampilan (misal: 15 Februari 2025)
    function formatDisplayDate(date) {
      const day = date.getDate();
      const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                           "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
      const month = monthNames[date.getMonth()];
      const year = date.getFullYear();
      return `${day} ${month} ${year}`;
    }

    // Fetch acara berdasarkan tanggal (daily view)
    async function fetchEvents(date) {
    try {
        const response = await fetch(`/events?date=${formatDate(date)}`, {
            headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${authUser.token}` // Jika menggunakan auth
            }
        });
        if (!response.ok) throw new Error('Gagal memuat data');
        return await response.json();
        } catch (error) {
        console.error('Error:', error);
        return [];
        }
    }

    // Fetch seluruh acara (untuk daftar jadwal)
    async function fetchAllEvents() {
    try {
        const response = await fetch('/api/events', {
            headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${authUser.token}`
            }
        });
        if (!response.ok) throw new Error('Gagal memuat data');
        return await response.json();
        } catch (error) {
        console.error('Error:', error);
        return [];
        }
    }

    // Render acara di daily view
    async function renderEvents(date) {
  const events = await fetchEvents(date);
  console.log("Events for date", formatDate(date), events); // Debug log
  const eventsContainer = document.getElementById('events-container');
  eventsContainer.innerHTML = '';
  events.forEach(event => {
    const [startHour, startMinute] = event.start_time.split(':').map(Number);
    const [endHour, endMinute] = event.end_time.split(':').map(Number);
    const top = (startHour * 60 + startMinute);
    const height = ((endHour * 60 + endMinute) - top);
    const eventElement = document.createElement('div');
    eventElement.className = 'calendar-event';
    eventElement.style.top = `${top}px`;
    eventElement.style.height = `${height}px`;
    // Warna: admin (public) = orange, karyawan (private) = kuning
    eventElement.style.backgroundColor = event.visibility === 'public' ? '#FFA500' : '#FFD54F';
    eventElement.innerHTML = `
      <div class="event-title">${event.title}</div>
      <div class="event-time">${event.start_time} - ${event.end_time}</div>
      <small>${event.visibility === 'public' ? 'Umum' : 'Privat'}</small>
    `;
    eventsContainer.appendChild(eventElement);
  });
}

async function renderScheduleTable() {
  const events = await fetchAllEvents();
  console.log("All events:", events); // Debug log
  const scheduleBody = document.getElementById('schedule-body');
  scheduleBody.innerHTML = '';
  events.forEach((event, index) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${index + 1}</td>
      <td>${formatDisplayDate(new Date(event.date))}</td>
      <td>${event.title}</td>
      <td>${event.start_time} - ${event.end_time}</td>
      <td>
        <span class="status-badge ${event.visibility === 'public' ? 'status-completed' : 'status-pending'}">
          ${event.visibility === 'public' ? 'Umum' : 'Privat'}
        </span>
      </td>
    `;
    scheduleBody.appendChild(row);
  });
}


    // Render kalender
    function renderCalendar() {
      const calendarDays = document.getElementById('calendar-days');
      const calendarTitle = document.querySelector('.calendar-title');
      calendarDays.innerHTML = '';
      const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                          "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
      calendarTitle.textContent = `${monthNames[currentMonth]} ${currentYear}`;
      const firstDay = new Date(currentYear, currentMonth, 1);
      const lastDay = new Date(currentYear, currentMonth + 1, 0);
      const firstDayOfWeek = firstDay.getDay();
      const prevMonthLastDay = new Date(currentYear, currentMonth, 0).getDate();
      // Hari dari bulan sebelumnya
      for (let i = firstDayOfWeek - 1; i >= 0; i--) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day other-month';
        dayElement.textContent = prevMonthLastDay - i;
        calendarDays.appendChild(dayElement);
      }
      // Hari dari bulan ini
      for (let i = 1; i <= lastDay.getDate(); i++) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';
        dayElement.textContent = i;
        const date = new Date(currentYear, currentMonth, i);
        dayElement.dataset.date = formatDate(date);
        const today = new Date();
        if (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
          dayElement.classList.add('today');
        }
        if (i === selectedDate.getDate() && currentMonth === selectedDate.getMonth() && currentYear === selectedDate.getFullYear()) {
          dayElement.classList.add('selected');
        }
        // Tandai jika ada acara
        const dateStr = formatDate(date);
        // Anda bisa menambahkan logika untuk mengecek data acara di sini jika data tersedia
        dayElement.addEventListener('click', () => {
          document.querySelectorAll('.calendar-day.selected').forEach(el => el.classList.remove('selected'));
          dayElement.classList.add('selected');
          selectedDate = new Date(currentYear, currentMonth, i);
          updateDailyView();
        });
        calendarDays.appendChild(dayElement);
      }
      // Hari dari bulan berikutnya
      const totalDays = firstDayOfWeek + lastDay.getDate();
      const remainingCells = 42 - totalDays;
      for (let i = 1; i <= remainingCells; i++) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day other-month';
        dayElement.textContent = i;
        calendarDays.appendChild(dayElement);
      }
    }

    // Update tampilan harian (daily view) dan tabel jadwal
    function updateDailyView() {
      const dailyDateElement = document.getElementById('daily-date');
      const dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
      const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                          "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
      const dayName = dayNames[selectedDate.getDay()];
      const day = selectedDate.getDate();
      const month = monthNames[selectedDate.getMonth()];
      const year = selectedDate.getFullYear();
      dailyDateElement.textContent = `${dayName}, ${day} ${month} ${year}`;
      renderEvents(selectedDate);
      renderScheduleTable();
    }

    // Navigasi bulan
    document.getElementById('prev-month').addEventListener('click', () => {
      currentMonth--;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      }
      renderCalendar();
    });
    document.getElementById('next-month').addEventListener('click', () => {
      currentMonth++;
      if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
      }
      renderCalendar();
    });
    // Navigasi hari
    document.getElementById('prev-day').addEventListener('click', () => {
      selectedDate.setDate(selectedDate.getDate() - 1);
      if (selectedDate.getMonth() !== currentMonth || selectedDate.getFullYear() !== currentYear) {
        currentMonth = selectedDate.getMonth();
        currentYear = selectedDate.getFullYear();
        renderCalendar();
      }
      updateDailyView();
    });
    document.getElementById('next-day').addEventListener('click', () => {
      selectedDate.setDate(selectedDate.getDate() + 1);
      if (selectedDate.getMonth() !== currentMonth || selectedDate.getFullYear() !== currentYear) {
        currentMonth = selectedDate.getMonth();
        currentYear = selectedDate.getFullYear();
        renderCalendar();
      }
      updateDailyView();
    });

    // Modal Handling
    const modal = document.getElementById('event-modal');
    const eventForm = document.getElementById('event-form');
    const closeBtns = document.querySelectorAll('.close, .cancel-btn');

    // Tampilkan modal saat tombol Tambah Acara diklik
    document.getElementById('add-event').addEventListener('click', () => {
      const dateInput = document.getElementById('event-date');
      dateInput.value = formatDate(selectedDate);
      dateInput.min = formatDate(selectedDate);
      // Jika admin, tampilkan dropdown visibility; jika bukan, sembunyikan dan set ke private
      if(authUser.role === 'admin'){
        document.getElementById('visibility-group').style.display = 'block';
      } else {
        document.getElementById('visibility-group').style.display = 'none';
      }
      modal.classList.add('show');
    });
    closeBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        modal.classList.remove('show');
        eventForm.reset();
      });
    });

    // Submit form acara
    eventForm.addEventListener('submit', async (e) => {
  e.preventDefault();
  const title = document.getElementById('event-title').value;
  const date = document.getElementById('event-date').value;
  const startTime = document.getElementById('start-time').value;
  const endTime = document.getElementById('end-time').value;
  const visibility = authUser.role === 'admin'
    ? document.getElementById('event-visibility').value
    : 'private';

  if (startTime >= endTime) {
    alert('Waktu selesai harus setelah waktu mulai');
    return;
  }

  const submitBtn = document.querySelector('.submit-btn');

  try {
    submitBtn.disabled = true;
    submitBtn.innerHTML = 'Menyimpan...';

    const response = await fetch('/events', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        title,
        date,
        start_time: startTime,
        end_time: endTime,
        visibility
      })
    });

    if (!response.ok) {
      let errorMessage = 'Gagal menyimpan acara';
      try {
        const errorData = await response.json();
        errorMessage = errorData.message || errorMessage;
      } catch (jsonError) {
        errorMessage = await response.text();
      }
      throw new Error(errorMessage);
    }

    alert('Acara berhasil disimpan!');
    modal.classList.remove('show');
    eventForm.reset();
    updateDailyView();
    renderCalendar();
  } catch (error) {
    console.error('Error:', error);
    alert('Gagal menyimpan acara: ' + error.message);
  } finally {
    submitBtn.disabled = false;
    submitBtn.innerHTML = 'Simpan';
  }
});

    // Inisialisasi tampilan awal
    renderCalendar();
    updateDailyView();
  </script>
</body>
</html>
