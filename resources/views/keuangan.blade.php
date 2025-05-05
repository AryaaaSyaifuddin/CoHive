    <!DOCTYPE html>
    <html lang="id">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CoHive</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- 2) Load dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- Untuk jsPDF, gunakan UMD build -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
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


            /* === Finance Widget (namespace: .fin-*) === */
        .fin-container {
        padding: 35px;
        position: relative;
        z-index: 2; /* agar di atas shape */
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        /* Cards */
        .fin-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 37px;
        }
        .fin-card {
        flex: 1;
        display: flex;
        align-items: center;
        padding: 16px;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .fin-card__icon {
        width: 48px; height: 48px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; margin-right: 16px;
        }
        .fin-card__info .fin-card__label { font-size: 13px; color: #6b7280; }
        .fin-card__info .fin-card__value { font-size: 18px; font-weight: bold; min-width: 170px;}

        /* varian */
        .fin-card--balance .fin-card__icon { background: #FEF3C7; color: #D97706; min-width: 50px;}
        .fin-card--income  .fin-card__icon { background: #DBEAFE; color: #2563EB; }
        .fin-card--outcome .fin-card__icon { background: #EDE9FE; color: #7C3AED; }

        /* Controls (tabs + filter) */
        .fin-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .fin-tabs {
        display: flex;
        gap: 16px;
        }
        .fin-tab {
        position: relative;
        padding: 8px 0;
        cursor: pointer;
        font-weight: 500;
        color: #6b7280;
        }
        .fin-tab--active {
        color: #111827;
        }
        .fin-tab--active::after {
        content: '';
        position: absolute;
        bottom: -4px; left: 0; right: 0;
        height: 3px; background: #2563EB;
        border-radius: 2px;
        }
        .fin-status-filter {
        padding: 6px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #fff;
        font-size: 14px;
        }

        /* Table */
        .fin-table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 8px;
        }
        .fin-table thead { background: #f9fafb; }
        .fin-table th, .fin-table td {
        padding: 12px 16px;
        text-align: left;
        font-size: 14px;
        border-bottom: 1px solid #e5e7eb;
        }
        .fin-table th { color: #6b7280; font-weight: 500; }

        /* Avatar & Badge */
        .fin-avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 32px;
        border-radius: 50%;
        background: #e5e7eb; color: #374151;
        font-weight: bold; margin-right: 8px;
        font-size: 14px;
        }
        .fin-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 9999px;
        font-size: 12px; font-weight: 500; color: #fff;
        }
        .fin-badge--Pending   { background: #FBBF24; }
        .fin-badge--Completed { background: #10B981; }
        .fin-badge--Cancelled { background: #EF4444; }

        /* Actions */
        .fin-actions {
        text-align: center; cursor: pointer; color: #6b7280;
        }
        /* === Modal Popup === */
        .modal {
        display: none;
        position: fixed;
        z-index: 100;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
        }
        .modal.show { display: flex; }
        .modal-content {
            position: relative;
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            font-size: 15px;
        }
        .modal-content h2 {
        margin-bottom: 16px;
        font-size: 20px;
        }
        .modal-close {
        position: absolute;
        top: 16px; right: 16px;
        font-size: 24px;
        color: #374151;
        cursor: pointer;
        }


        .form-group {
        margin-bottom: 16px;
        }
        .form-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 15px;
        }
        .form-group input,
        .form-group select {
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        }
        .modal-footer {
        text-align: right;
        margin-top: 24px;
        }
        /* Hover style untuk tombol tutup di modal footer */
        .modal-footer .btn-outline-secondary {
        transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        .modal-footer .btn-outline-secondary:hover {
            cursor: pointer;
        background-color: #0e0e0eda;    /* warna latar saat hover */
        color: #f9f8f8;                  /* warna teks saat hover */
        border-color: #a0a0a0;        /* warna border saat hover */
        }
        .btn-primary {
        padding: 8px 16px;
        background: #2563EB;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        }
        .btn-secondary {
        padding: 8px 16px;
        background: #6b7280;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        margin-right: 8px;
        }
        .fin-add-btn {
        padding: 6px 12px;
        font-size: 14px;
        border: none;
        border-radius: 6px;
        background: #2563EB;
        color: #fff;
        cursor: pointer;
        margin-right: 12px;
        }

        /* Styles untuk struk bank */
        .receipt {
        font-family: 'Courier New', Courier, monospace;
        background: #fff;
        border-radius: 8px;
        max-width: 400px;
        height: 550px;
        }

        .receipt-header p {
        margin: 0;
        font-weight: bold;
        font-size: 1rem;
        }

        .receipt-header small {
        color: #555;
        }

        .dashed {
        border-top: 1px dashed #999;
        margin: 8px 0;
        }

        .receipt-list .label {
        display: inline-block;
        width: 100px;
        font-weight: bold;
        text-decoration:
        }

        .receipt-list .value {
        float: right;
        }

        .receipt-list li {
        margin-bottom: 12px;
        font-size: 0.9rem;
        }

        .receipt-footer small {
        color: #777;
        }


        /* === PRINT-RECEIPT STYLES (PDF) === */
        .print-receipt {
        position: relative;
        font-family: 'Courier New', monospace;
        background: #fff;
        padding: 12px;
        border: 1px solid #ddd;
        max-width: 260px;
        margin: auto;
        font-size: 0.75rem;            /* kecilkan font */
        color: #333;
        line-height: 1.2;
        overflow: hidden;
        }

        /* watermark “COHIVE” berulang */
        .print-receipt::before {
        content: "COHIVE COHIVE COHIVE COHIVE COHIVE";
        position: absolute;
        top: 20%;
        left: -10%;
        font-size: 2rem;
        color: rgba(0,0,0,0.05);
        transform: rotate(-30deg);
        white-space: nowrap;
        pointer-events: none;
        }

        /* logo/ikon centang hijau di atas */
        .print-receipt .icon-check {
        display: block;
        text-align: center;
        font-size: 1.4rem;
        color: #28a745;
        margin-bottom: 4px;
        }

        /* header text */
        .print-receipt .bank-name {
        text-align: center;
        font-weight: bold;
        margin: 0;
        font-size: 0.75rem;
        }
        .print-receipt .title {
        text-align: center;
        font-weight: bold;
        margin: 2px 0 4px;
        font-size: 1rem;
        }
        .print-receipt small {
        display: block;
        text-align: center;
        margin-bottom: 6px;
        font-size: 0.7rem;
        color: #555;
        }

        /* garis putus-putus di bawah header */
        .print-receipt hr {
        border: none;
        border-top: 1px dashed #999;
        margin: 4px 0 6px;
        }

        /* list tanpa dot-leaders */
        .print-receipt ul {
        list-style: none;
        padding: 0;
        margin: 0;
        }
        .print-receipt ul li {
        display: flex;
        justify-content: space-between;  /* langsung kiri & kanan */
        margin: 3px 0;
        font-size: 0.75rem;
        }
        .print-receipt ul li .label {
        font-weight: bold;
        }
        .print-receipt ul li .value {
        text-align: right;
        }

        /* footer kecil */
        .print-receipt .footer {
        text-align: center;
        font-size: 0.65rem;
        color: #777;
        margin-top: 4px;
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
            <a href="/keuangan" class="dash">
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



            <div class="fin-container">
                <div style="display: flex; justify-content: space-between; margin-bottom: 16px;">
                    <h2>Catatan Keuangan</h2>
                    <button id="addAccountBtn" class="fin-add-btn">+ Bank Account</button>
                </div>
                <!-- Cards -->
                <div class="fin-cards">
                    @foreach ($accounts as $account)
                      <div class="fin-card fin-card--balance">
                          <div class="fin-card__icon"><i class="fa-solid fa-bank"></i></div>
                          <div class="fin-card__info">
                              <div class="fin-card__label">{{ $account->name }}</div>
                              <div class="fin-card__value">Rp {{ number_format($account->balance, 0, ',', '.') }}</div>
                          </div>
                          <div class="fin-card__actions mt-2" style="width: 56%; display: flex ;justify-content: end;">
                            <button
                              class="btn-edit-account text-sm underline"
                              style="padding: 3px 20px;
                                     border-radius: 8px;
                                     border: none;
                                     background-color: #2563eb;
                                     color: #ffffff;"
                              data-id="{{ $account->id }}"
                              data-name="{{ $account->name }}"
                              data-balance="{{ $account->balance }}">
                              Edit
                            </button>
                          </div>
                      </div>
                    @endforeach
                </div>


                <div class="fin-controls">
                    <div class="fin-tabs">
                      <div class="fin-tab fin-tab--active" data-type="all">All</div>
                      <div class="fin-tab" data-type="income">Income</div>
                      <div class="fin-tab" data-type="outcome">Outcome</div>
                    </div>
                    <div style="display: flex; align-items: center;">
                      <button id="addTransBtn" class="fin-add-btn">+ Transaksi</button>
                      <select class="fin-status-filter">
                        <option value="All">Status: All</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                      </select>
                    </div>
                  </div>

                  <table class="fin-table">
                    <thead>
                      <tr>
                        <th>Ref ID</th>
                        <th>Account</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Transaction Date</th>
                        <th>From</th>
                        <th>Amount</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="fin-tbody">
                      @foreach($transactions as $tx)
                        @php
                          $sign = $tx->category->type === 'expense' ? '-' : '+';
                          $ts = strtotime($tx->transaction_date);
                          $dateFull = date('F d, Y', $ts);
                          $dateShort = date('M j, Y', $ts);
                        @endphp
                        <tr
                          data-id="{{ $tx->id }}"
                          data-account-name="{{ $tx->account->name }}"
                          data-category-name="{{ $tx->category->name }}"
                          data-type="{{ ucfirst($tx->category->type) }}"
                          data-date="{{ $dateFull }}"
                          data-user-name="{{ $tx->user->username }}"
                          data-desc="{{ e($tx->description) }}"
                          data-amount="{{ $sign }} {{ number_format($tx->amount,2) }}"
                          data-status="{{ $tx->status }}"
                        >
                          <td>{{ $tx->id }}</td>
                          <td>{{ $tx->account->name }}</td>
                          <td>{{ $tx->category->name }}</td>
                          <td>{{ ucfirst($tx->category->type) }}</td>
                          <td>{{ $dateShort }}</td>
                          <td>
                            <span class="fin-avatar">{{ strtoupper(substr($tx->user->username,0,1)) }}</span>
                            {{ $tx->user->username }}
                          </td>
                          <td>{{ $sign }} {{ number_format($tx->amount,2) }}</td>
                          <td class="fin-actions">
                            <!-- View Details -->
                            <i class="fa-solid fa-eye cursor-pointer me-2" title="View Details"></i>
                            <!-- Download PDF Receipt -->
                            <i class="fa-solid fa-file-pdf cursor-pointer" title="Download Receipt"></i>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <textarea id="receipt-template" style="display:none;">
                    <div class="print-receipt">
                      <i class="fa-solid fa-circle-check icon-check"></i>
                      <p class="bank-name">BANK ABC</p>
                      <p class="title">BUKTI TRANSFER</p>
                      <small>Terima kasih telah menggunakan layanan kami</small>
                      <hr>
                      <ul>
                        <li><span class="label">ID</span><span class="value">[[id]]</span></li>
                        <li><span class="label">Rek. Debet</span><span class="value">[[account]]</span></li>
                        <li><span class="label">Kategori</span><span class="value">[[category]]</span></li>
                        <li><span class="label">Jenis</span><span class="value">[[type]]</span></li>
                        <li><span class="label">Tanggal</span><span class="value">[[date]]</span></li>
                        <li><span class="label">User</span><span class="value">[[user]]</span></li>
                        <li><span class="label">Keterangan</span><span class="value">[[desc]]</span></li>
                        <li><span class="label">Nominal</span><span class="value">[[amount]]</span></li>
                        <li><span class="label">Status</span><span class="value">[[status]]</span></li>
                      </ul>
                      <div class="footer">Powered by Bank ABC • www.bankabc.co.id</div>
                    </div>
                    </textarea>



            </div>

            <!-- FORM CREATE TRANSAKSI -->
            <div id="transModal" class="modal">
                <div class="modal-content">
                <span class="modal-close">&times;</span>
                <h2>Tambah Transaksi</h2>

                <form action="{{ route('keuangan.transactions.store') }}" method="POST">
                    @csrf

                    <!-- Pilih Akun -->
                    <div class="form-group">
                    <label for="accountSelect">Akun</label>
                    <select id="accountSelect" name="account_id" required>
                        <option value="">— Pilih Akun —</option>
                        @foreach($accounts as $acct)
                        <option value="{{ $acct->id }}">{{ $acct->name }}</option>
                        @endforeach
                    </select>
                    </div>

                    <!-- Pilih Kategori (dengan data-attributes) -->
                    <div class="form-group">
                    <label for="categorySelect">Kategori</label>
                    <select id="categorySelect" name="category_select" required>
                        <option value="">— Pilih Kategori —</option>
                        @foreach($categories as $cat)
                        <option
                            value="{{ $cat->id }}"
                            data-name="{{ $cat->name }}"
                            data-type="{{ $cat->type }}"
                        >
                            {{ $cat->name }} ({{ ucfirst($cat->type) }})
                        </option>
                        @endforeach
                        <option value="new">+ Tambah Kategori</option>
                    </select>
                    </div>

                    <!-- Nama & Tipe Kategori (selalu tampil, tapi akan di-disable untuk kategori lama) -->
                    <div class="form-group" id="newCategoryNameGroup">
                    <label for="newCategoryName">Nama Kategori</label>
                    <input
                        type="text"
                        id="newCategoryName"
                        name="new_category_name"
                        placeholder="Masukkan nama kategori"
                    >
                    </div>
                    <div class="form-group" id="newCategoryTypeGroup">
                    <label for="newCategoryType">Tipe Kategori</label>
                    <select id="newCategoryType" name="new_category_type">
                        <option value="income">Income</option>
                        <option value="expense">Expense</option>
                    </select>
                    </div>

                    <!-- Nominal -->
                    <div class="form-group">
                    <label for="amount">Jumlah (Amount)</label>
                    <input type="number" step="0.01" id="amount" name="amount" required>
                    </div>

                    <!-- Tanggal Transaksi -->
                    <div class="form-group">
                    <label for="transactionDate">Tanggal Transaksi</label>
                    <input type="date" id="transactionDate" name="transaction_date" required>
                    </div>

                    <!-- Keterangan -->
                    <div class="form-group">
                    <label for="description">Keterangan</label>
                    <textarea id="description" name="description" rows="3" style="padding: 12px; width: 100%; border-radius: 8px; border: 1px solid #ddd;" placeholder="Tambahkan detai transaksi"></textarea>
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn-secondary" id="cancelBtn">Batal</button>
                    <button type="submit" class="btn-primary">Simpan</button>
                    </div>
                </form>
                </div>
            </div>




            <!-- FORM CREATE BANK ACCOUNT -->
            <div id="accountModal" class="modal">
                <div class="modal-content">
                    <span class="modal-close close-account">&times;</span>
                    <h2>Tambah Bank Account</h2>

                    <form action="{{ route('keuangan-accounts.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="accountName">Nama Akun</label>
                            <input type="text" id="accountName" name="name" placeholder="Masukkan nama akun" required>
                        </div>
                        <div class="form-group">
                            <label for="initialBalance">Saldo Awal</label>
                            <input type="number" step="0.01" id="initialBalance" name="balance" placeholder="Masukkan saldo awal" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-secondary" id="cancelAccountBtn">Batal</button>
                            <button type="submit" class="btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>


            <!-- MODAL EDIT BANK ACCOUNT -->
            <div id="accountEditModal" class="modal" style="display:none">
                <div class="modal-content">
                <span class="modal-close close-edit-account">&times;</span>
                <h2>Edit Bank Account</h2>

                <form id="formEditAccount" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                    <label for="editAccountName">Nama Akun</label>
                    <input type="text" id="editAccountName" name="name" required>
                    </div>
                    <div class="form-group">
                    <label for="editBalance">Saldo Awal</label>
                    <input type="number" step="0.01" id="editBalance" name="balance" required>
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn-secondary close-edit-account">Batal</button>
                    <button type="submit" class="btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
                </div>
            </div>

            <!-- Modal Struk Transfer Bank -->
            <div class="modal fade" id="txDetailModal" tabindex="-1" aria-labelledby="txDetailLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" style="display: flex; justify-content: center; align-items: center; height: 100vh;"> <!-- ukuran lebih kecil -->
                <div class="modal-content receipt">
                    <div class="modal-header border-0 justify-content-center">
                    <h5 class="modal-title" id="txDetailLabel">BANK ABC</h5>
                    </div>
                    <div class="modal-body p-3">
                    <div class="receipt-header text-center mb-2">
                        <p>BUKTI TRANSFER</p>
                        <small>Terima kasih telah menggunakan layanan kami</small>
                    </div>
                    <hr class="dashed">
                    <ul class="receipt-list list-unstyled" style="list-style: none;">
                        <li><span class="label">ID</span> <span id="detail-id" class="value"></span></li>
                        <li><span class="label">Rek. Debet</span> <span id="detail-account" class="value"></span></li>
                        <li><span class="label">Kategori</span> <span id="detail-category" class="value"></span></li>
                        <li><span class="label">Jenis</span> <span id="detail-type" class="value"></span></li>
                        <li><span class="label">Tanggal</span> <span id="detail-date" class="value"></span></li>
                        <li><span class="label">User</span> <span id="detail-user" class="value"></span></li>
                        <li><span class="label">Keterangan</span> <span id="detail-desc" class="value"></span></li>
                        <li><span class="label">Nominal</span> <span id="detail-amount" class="value"></span></li>
                        <li><span class="label">Status</span> <span id="detail-status" class="value"></span></li>
                    </ul>
                    <hr class="dashed">
                    <div class="text-center receipt-footer">
                        <small>Powered by Bank ABC • www.bankabc.co.id</small>
                    </div>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal" style="padding: 5px 20px; border-radius: 8px; border: 1px solid #000000;">Tutup</button>
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

        <script>
            (function(){
            const tabs   = document.querySelectorAll('.fin-tab');
            const select = document.querySelector('.fin-status-filter');
            const rows   = document.querySelectorAll('.fin-tbody tr');

            function filterFin() {
                const type   = document.querySelector('.fin-tab--active').dataset.type;
                const status = select.value;
                rows.forEach(r => {
                const okType   = (type === 'all') || (r.dataset.type === type);
                const okStatus = (status === 'All') || (r.dataset.status === status);
                r.style.display = (okType && okStatus) ? '' : 'none';
                });
            }

            tabs.forEach(t => {
                t.addEventListener('click', () => {
                tabs.forEach(x => x.classList.remove('fin-tab--active'));
                t.classList.add('fin-tab--active');
                filterFin();
                });
            });
            select.addEventListener('change', filterFin);

            // init
            filterFin();
            })();

            // Toggle form “Tambah Kategori”
                const categorySelect     = document.getElementById('categorySelect');
                const newCatNameGroup    = document.getElementById('newCategoryNameGroup');
                const newCatTypeGroup    = document.getElementById('newCategoryTypeGroup');

                categorySelect.addEventListener('change', () => {
                const isNew = categorySelect.value === 'new';
                newCatNameGroup.style.display = isNew ? 'block' : 'none';
                newCatTypeGroup.style.display = isNew ? 'block' : 'none';
            });

        </script>


        <script>
            // Tombol +Transaksi
            const addBtn   = document.getElementById('addTransBtn');
            const modal    = document.getElementById('transModal');
            const closeBtn = document.querySelector('.modal-close');
            const cancelBtn= document.getElementById('cancelBtn');

            addBtn.addEventListener('click', () => modal.classList.add('show'));
            closeBtn.addEventListener('click', () => modal.classList.remove('show'));
            cancelBtn.addEventListener('click', () => modal.classList.remove('show'));

            // tutup saat klik di luar content
            modal.addEventListener('click', e => {
            if (e.target === modal) modal.classList.remove('show');
            });
        </script>


        <script>
            // Tombol & modal Account
            const addAccBtn     = document.getElementById('addAccountBtn');
            const accountModal  = document.getElementById('accountModal');
            const closeAccBtns  = document.querySelectorAll('.close-account, #cancelAccountBtn');

            // Buka modal
            addAccBtn.addEventListener('click', () => accountModal.classList.add('show'));
            // Tutup modal via ikon, tombol batal, atau klik overlay
            closeAccBtns.forEach(el =>
            el.addEventListener('click', () => accountModal.classList.remove('show'))
            );
            accountModal.addEventListener('click', e => {
            if (e.target === accountModal) accountModal.classList.remove('show');
            });

            // TODO: tambah handler untuk #saveAccountBtn agar data dikirim ke backend
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function(){
            const editModal = document.getElementById('accountEditModal');
            const formEdit  = document.getElementById('formEditAccount');
            const inpName   = document.getElementById('editAccountName');
            const inpBal    = document.getElementById('editBalance');

            // buka modal saat tombol edit diklik
            document.querySelectorAll('.btn-edit-account').forEach(btn=>{
                btn.addEventListener('click', ()=> {
                const id      = btn.dataset.id;
                const name    = btn.dataset.name;
                const balance = btn.dataset.balance;

                // set form action
                formEdit.action = `/keuangan-accounts/${id}`;
                // fill inputs
                inpName.value  = name;
                inpBal.value   = balance;

                editModal.style.display = 'block';
                });
            });

            // close modal
            document.querySelectorAll('.close-edit-account').forEach(el=>{
                el.addEventListener('click', ()=> editModal.style.display = 'none');
            });
            });
        </script>

        <script>
            const burgerBtn = document.getElementById('burger-btn');
            const sidebar   = document.getElementById('sidebar');
            burgerBtn.addEventListener('click', () => sidebar.classList.toggle('closed'));
        </script>

        <!-- SCRIPT: Finance filter -->
        <script>
            (function(){
            const tabs   = document.querySelectorAll('.fin-tab');
            const select = document.querySelector('.fin-status-filter');
            const rows   = document.querySelectorAll('.fin-tbody tr');
            function filterFin() {
                const type   = document.querySelector('.fin-tab--active').dataset.type;
                const status = select.value;
                rows.forEach(r => {
                const okType   = (type === 'all') || (r.dataset.type === type);
                const okStatus = (status === 'All') || (r.dataset.status === status);
                r.style.display = (okType && okStatus) ? '' : 'none';
                });
            }
            tabs.forEach(t => t.addEventListener('click', () => {
                tabs.forEach(x => x.classList.remove('fin-tab--active'));
                t.classList.add('fin-tab--active');
                filterFin();
            }));
            select.addEventListener('change', filterFin);
            filterFin();
            })();
        </script>

        <!-- SCRIPT: Transaksi modal open/close -->
        <script>
            const addBtn   = document.getElementById('addTransBtn');
            const modal    = document.getElementById('transModal');
            const closeBtn = document.querySelector('.modal-close');
            const cancelBtn= document.getElementById('cancelBtn');

            addBtn.addEventListener('click', () => modal.classList.add('show'));
            closeBtn.addEventListener('click', () => modal.classList.remove('show'));
            cancelBtn.addEventListener('click', () => modal.classList.remove('show'));
            modal.addEventListener('click', e => {
            if (e.target === modal) modal.classList.remove('show');
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
            const catSelect   = document.getElementById('categorySelect');
            const nameInput   = document.getElementById('newCategoryName');
            const typeSelect  = document.getElementById('newCategoryType');

            function handleCategoryChange() {
                const val = catSelect.value;
                if (val === 'new') {
                // user mau tambah kategori baru
                nameInput.value     = '';
                nameInput.disabled  = false;
                typeSelect.value    = 'income';
                typeSelect.disabled = false;
                } else {
                // user pilih kategori lama
                const opt = catSelect.selectedOptions[0];
                nameInput.value     = opt.dataset.name;
                nameInput.disabled  = true;
                typeSelect.value    = opt.dataset.type;
                typeSelect.disabled = true;
                }
            }

            catSelect.addEventListener('change', handleCategoryChange);
            handleCategoryChange(); // inisialisasi on load
            });
        </script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
      const { jsPDF } = window.jspdf;
      const tbody       = document.querySelector('table.fin-table tbody');
      const receiptTpl  = document.getElementById('receipt-template').value.trim();
      const modalEl     = document.getElementById('txDetailModal');
      const modal       = bootstrap.Modal.getOrCreateInstance(modalEl);

      tbody.addEventListener('click', function(e) {
        const target = e.target;
        const tr     = target.closest('tr');
        if (!tr) return;

        // ----- VIEW DETAILS -----
        if (target.classList.contains('fa-eye')) {
          // isi konten modal dengan data dari atribut data-*
          modalEl.querySelector('#detail-id').textContent       = tr.dataset.id;
          modalEl.querySelector('#detail-account').textContent  = tr.dataset.accountName;
          modalEl.querySelector('#detail-category').textContent = tr.dataset.categoryName;
          modalEl.querySelector('#detail-type').textContent     = tr.dataset.type;
          modalEl.querySelector('#detail-date').textContent     = tr.dataset.date;
          modalEl.querySelector('#detail-user').textContent     = tr.dataset.userName;
          modalEl.querySelector('#detail-desc').textContent     = tr.dataset.desc;
          modalEl.querySelector('#detail-amount').textContent   = tr.dataset.amount;
          modalEl.querySelector('#detail-status').textContent   = tr.dataset.status;
          // tampilkan modal
          modal.show();
        }

        // ----- DOWNLOAD PDF -----
        if (target.classList.contains('fa-file-pdf')) {
          let html = receiptTpl
            .replace(/\[\[id\]\]/g,       tr.dataset.id)
            .replace(/\[\[account\]\]/g,  tr.dataset.accountName)
            .replace(/\[\[category\]\]/g, tr.dataset.categoryName)
            .replace(/\[\[type\]\]/g,     tr.dataset.type)
            .replace(/\[\[date\]\]/g,     tr.dataset.date)
            .replace(/\[\[user\]\]/g,     tr.dataset.userName)
            .replace(/\[\[desc\]\]/g,     tr.dataset.desc)
            .replace(/\[\[amount\]\]/g,   tr.dataset.amount)
            .replace(/\[\[status\]\]/g,   tr.dataset.status);

          const container = document.createElement('div');
          container.style.position = 'fixed';
          container.style.top      = '-9999px';
          container.innerHTML      = html;
          document.body.appendChild(container);

          html2canvas(container, { scale: 2 }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf     = new jsPDF({ orientation: 'portrait' });
            const w       = pdf.internal.pageSize.getWidth();
            const h       = (canvas.height * w) / canvas.width;
            pdf.addImage(imgData, 'PNG', 0, 0, w, h);
            pdf.save(`struk_tx_${tr.dataset.id}.pdf`);
            document.body.removeChild(container);
          }).catch(err => console.error(err));
        }
      });
    });
    </script>

    </body>
    </html>
