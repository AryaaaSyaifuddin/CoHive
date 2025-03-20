<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CoHive Landing - Responsive Mobile</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    /* Reset dan dasar */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }
    html, body {
        overflow-x: hidden;
        color: #fff;
    }

    /* ===== NAVBAR ===== */
    nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 9999;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 60px;
        background-color: transparent;
    }
    .logo {
        font-size: 35px;
        font-weight: 700;
        color: #FACF43;
        text-decoration: none;
        padding: 15px 15px 15px 40px;
        transition: transform 0.5s ease;
    }
    .nav-links {
        display: flex;
        list-style: none;
        align-items: center;
        gap: 40px;
    }
    .nav-links li a {
        text-decoration: none;
        color: #FACF43;
        font-weight: 500;
        transition: color 0.3s, transform 0.3s ease;
    }
    .nav-links li a:hover {
        color: #ffffff;
        transform: scale(1.1);
    }
    .loginRegist {
        display: flex;
        gap: 20px;
        align-items: center;
    }
    .login-btn,
    .signup-btn {
        text-decoration: none;
        padding: 10px 35px;
        border-radius: 35px;
        font-weight: 500;
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s;
    }
    .login-btn {
        background-color: #333;
        color: #fff;
    }
    .login-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        background-color: #4343436e;
    }
    .signup-btn {
        background-color: #4343436e;
        color: #fff;
    }
    .signup-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        background-color: #333;
    }
    .burger {
        display: none;
        flex-direction: column;
        cursor: pointer;
    }
    .burger div {
        width: 25px;
        height: 3px;
        background-color: #2A2929;
        margin: 4px;
        transition: all 0.3s ease;
    }

    /* ===== BAGIAN UTAMA (CONTENT) ===== */
    .content-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 210px 75px 170px 100px;
        background: linear-gradient(90deg, #2A2929 77.5%, #FACF43 61%);
    }
    .content-left,
    .content-right {
        width: 50%;
    }
    .content-left h1 {
        font-weight: 600;
        font-size: 40px;
        margin-bottom: 20px;
        line-height: 1.3;
    }
    .note {
        color: #ccc;
        font-size: 18px;
        font-weight: 300;
        line-height: 1.6;
        margin-bottom: 25px;
    }
    .content-left a {
        display: inline-block;
        text-decoration: none;
        font-size: 16px;
        font-weight: 700;
        padding: 14px 28px;
        background: #FACF43;
        color: #000;
        border-radius: 50px;
        transition: background-color 0.3s, transform 0.3s ease, box-shadow 0.3s ease;
    }
    .content-left a:hover {
        background-color: #d7d7d7;
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .content-right {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .content-right img {
        width: 100%;
        max-width: 470px;
        transition: transform 0.5s ease;
    }
    .content-right img:hover {
        transform: scale(1.05);
    }

    /* Section tambahan */
    .whatIsCoHive{
        padding: 115px 400px 30px 400px;
        background-color: #fff;
        text-align: center;

    }
    .title {
        font-size: 44px;
        font-weight: 600;
        line-height: 1.2;
        color: #2A2929;
        margin-bottom: 20px;
    }
    .title .cohive { color: #F7C319; }
    .title .question { color: #FACF43; }
    .description {
        max-width: 800px;
        margin: 0 auto;
        color: #252641;
        font-size: 17px;
        font-weight: 400;
        line-height: 1.8;
        padding: 0 20px;
    }

    .cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        max-width: 100%;
        padding: 20px 20px 100px 20px;
        justify-content: center;
    }

    /* Style umum untuk setiap card */
    .card {
      position: relative;           /* Untuk meletakkan overlay di atas background */
      width: 480px;
    height: 320px;               /* Tinggi card */
      border-radius: 12px;
      overflow: hidden;            /* Supaya border radius juga berlaku untuk gambar */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
    }

    .card:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Overlay semi-transparan */
    .overlay {
      position: absolute;
      inset: 0; /* top, right, bottom, left = 0 */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 20px;
      background: rgba(0, 0, 0, 0.35); /* Lapisan gelap transparan */
      color: #fff;
    }

    .overlay h2 {
      font-size: 1.2rem;
      margin-bottom: 10px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .overlay button {
      padding: 10px 20px;
      border: none;
      border-radius: 25px;
      font-size: 0.9rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    /* Card kiri: FOR INSTRUCTORS */
    .card.instructors {
      background-image: url('img/Rectangle 24.png'); /* Ganti sesuai kebutuhan */
    }
    .card.instructors .overlay button {
      background-color: transparent;
      color: #fff;
      border: 2px solid #fff;
    }
    .card.instructors .overlay button:hover {
      background-color: #fff;
      color: #000;
    }

    /* Card kanan: FOR STUDENTS */
    .card.students {
      background-image: url('img/Rectangle32.png'); /* Ganti sesuai kebutuhan */
    }
    .card.students .overlay button {
      background-color: #FACF43;
      color: #000;
      border: none;
    }
    .card.students .overlay button:hover {
      background-color: #FACF43;
    }

    .feature-section {
      position: relative;          /* Untuk menempatkan pseudo-element ::after */
      background-color: #FACF43;   /* Warna kuning background utama */
      padding: 50px 0;
      text-align: center;
      overflow: hidden;            /* Supaya pseudo-element tidak meluber */
    }

    /* Bentuk hitam di sisi kanan dengan clip-path */
    .feature-section::after {
      content: "";
      position: absolute;
      top: 0;
      right: 0;
      width: 20%;              /* Lebar sisi hitam di sebelah kanan */
      height: 100%;
      background: #2A2929;        /* Warna hitam */
    }

    /* Konten teks di atas feature-section */
    .feature-content {
      position: relative; /* Supaya teks berada di atas pseudo-element */
      max-width: 800px;
      margin: 0 auto;
      color: #000;        /* Warna teks untuk judul */
      z-index: 1;         /* Pastikan berada di atas layer ::after */
      padding: 0 20px;    /* Spasi kiri-kanan */
    }

    .feature-content h2 {
      font-size: 28px;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .feature-content p {
      font-size: 16px;
      color: #444;
      line-height: 1.5;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Gaya dasar untuk hexagon */
    .hex {
      position: absolute;
      width: 55px;
      height: 65px;
      clip-path: polygon(50% 0%, /* titik atas tengah */ 100% 25%, /* pojok kanan atas */ 100% 75%, /* pojok kanan bawah */ 50% 100%, /* titik bawah tengah */ 0% 75%, /* pojok kiri bawah */ 0% 25% /* pojok kiri atas */);
    }

    /* Hexagon merah (posisi atas kiri) */
    .hex.red {
        background: #FACF43;
        bottom: -42px;
        left: 103%;
    }

    /* Hexagon kuning (posisi bawah kiri) */
    .hex.yellow {
        background: #2A2929;
        bottom: 37px;
        left: 104%;
    }

    .tools-section {
    width: 100%;
    background-color: #fff;
    padding: 80px 100px 80px 130px;
    }

    .tools-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    }

    .tools-text {
    width: 50%;
    color: #252641;
    padding-right: 30px;
    }

    .tools-text h2 {
    font-size: 36px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #2A2929;
    }

    .tools-text h2 span {
    color: #FACF43;
    }

    .tools-text p {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 0;
    }

    .tools-image {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .tools-image img {
    max-width: 90%;
    height: auto;
    }

    /* ===== MEDIA QUERIES UNTUK RESPONSIVE ===== */
    @media (max-width: 768px) {
        nav {
            padding: 15px 30px;
        }
        .nav-links {
            position: fixed;
            right: 0;
            top: 70px;
            height: 100vh;
            width: 60%;
            background-color: #2A2929;
            flex-direction: column;
            align-items: center;
            justify-content: start;
            padding-top: 40px;
            transform: translateX(100%);
            transition: transform 0.5s ease-in;
        }
        .nav-links li {
            opacity: 0;
            margin-bottom: 20px;
        }
        .nav-active {
            transform: translateX(0%);
        }
        .burger {
            display: flex;
        }
        .content-container {
            flex-direction: column;
            padding: 120px 30px 100px;
        }
        .content-left,
        .content-right {
            width: 100%;
        }
        .content-right {
            margin-top: 20px;
        }
        .whatIsCoHive {
            padding: 60px 20px;
        }
        .title {
            font-size: 32px;
        }
        .description {
            font-size: 15px;
        }
        .cards-container {
            justify-content: center;
        }
        .card {
            width: 100%;
            max-width: 400px;
        }
        .tools-section {
            padding: 40px 20px;
        }
        .tools-wrapper {
            flex-direction: column;
            text-align: center;
        }
        .tools-text,
        .tools-image {
            width: 100%;
            padding: 0;
        }
        .tools-text {
            margin-bottom: 20px;
        }
        .tools-text h2 {
            font-size: 28px;
        }
        .tools-text p {
            font-size: 14px;
        }
        .tools-image img {
            max-width: 100%;
        }
    }

    @media (max-width: 480px) {
        .logo {
            font-size: 28px;
            padding: 15px 15px 15px 20px;
        }
        .nav-links {
            width: 70%;
        }
        .nav-links li a {
            font-size: 16px;
        }
        .login-btn, .signup-btn {
            padding: 8px 25px;
            font-size: 14px;
        }
        .burger div {
            width: 20px;
            height: 2px;
            margin: 3px;
        }
        .content-left h1 {
            font-size: 28px;
        }
        .note {
            font-size: 14px;
        }
        .content-left a {
            font-size: 14px;
            padding: 12px 24px;
        }
        .content-right img {
            max-width: 300px;
        }
        .whatIsCoHive {
            padding: 40px 15px;
        }
        .title {
            font-size: 28px;
        }
        .description {
            font-size: 14px;
        }
    }

    /* Animasi untuk navigasi */
    @keyframes navLinkFade {
      from {
          opacity: 0;
          transform: translateX(50px);
      }
      to {
          opacity: 1;
          transform: translateX(0px);
      }
    }
  </style>
</head>
<body>

  <!-- Content Utama -->
  <div class="content-container">
    <div class="content-left">
      <h1>Why Swift UI Should Be on the Radar of Every Mobile Developer</h1>
      <div class="note">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
      </div>
      <a href="#">Start learning now</a>
    </div>
    <div class="content-right">
      <img src="IMG/Rectangle32.png" alt="Laptop Preview"/>
    </div>
  </div>

  <!-- Navbar -->
  <nav>
    <a href="#" class="logo">CoHive</a>
    <ul class="nav-links">
      <li><a href="#">Home</a></li>
      <li><a href="#">Courses</a></li>
      <li><a href="#">Articles</a></li>
      <li><a href="#">About Us</a></li>
      <div class="loginRegist">
        <a href="#" class="login-btn">Login</a>
        <a href="#" class="signup-btn">Sign Up</a>
      </div>
    </ul>
    <div class="burger">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </nav>

  <!-- Section tambahan -->
  <div class="whatIsCoHive">
    <div class="title">
      What is <span class="cohive">CoHive</span><span class="question">?</span>
    </div>
    <div class="description">
      TOTC adalah platform yang memungkinkan pendidik membuat kelas online, menyimpan materi, mengelola tugas, kuis, ujian, memantau tanggal, menilai, dan memberikan feedback secara terpadu.
    </div>
  </div>

  <div class="cards-container">
    <!-- Card Pertama (Instructors) -->
    <div class="card instructors" onclick="handleCardClick('Instructors')">
      <div class="overlay">
        <h2>FOR INSTRUCTORS</h2>
        <button onclick="event.stopPropagation(); handleButtonClick('Start a class today')">
          Start a class today
        </button>
      </div>
    </div>

    <!-- Card Kedua (Students) -->
    <div class="card students" onclick="handleCardClick('Students')">
      <div class="overlay">
        <h2>FOR STUDENTS</h2>
        <button onclick="event.stopPropagation(); handleButtonClick('Enter access code')">
          Enter access code
        </button>
      </div>
    </div>
  </div>

  <section class="feature-section">
    <div class="feature-content">
        <div class="hex red"></div>
        <div class="hex yellow"></div>
      <h2>Our Features</h2>
      <p>
        This very extraordinary feature can make learning activities more efficient
      </p>
    </div>
  </section>

  <div class="shape-container">
    <!-- Bidang hitam -->
    <div class="black-shape"></div>
  </div>

    <!-- Section Baru: Tools for Leaders and Employees -->
    <section class="tools-section">
        <div class="tools-wrapper">
        <!-- Bagian Teks (Kiri) -->
        <div class="tools-text">
            <h2>Tools <span>For Leaders and Employees</span></h2>
            <p>
            Class has a dynamic set of teaching tools built to be deployed and used during class. Teachers can hand out assignments in real-time for students to complete and submit.
            </p>
        </div>

        <!-- Bagian Gambar (Kanan) -->
        <div class="tools-image">
            <!-- Ganti "img/tools.png" dengan path gambar yang sudah mencakup semua elemen -->
            <img src="img/toolsforleader.png" alt="Tools for Leaders and Employees" />
        </div>
        </div>


        <div class="tools-wrapper">
            <!-- Bagian Gambar (Kanan) -->
            <div class="tools-image">
                <!-- Ganti "img/tools.png" dengan path gambar yang sudah mencakup semua elemen -->
                <img src="img/Group 92.png" alt="Tools for Leaders and Employees" />
            </div>

            <!-- Bagian Teks (Kiri) -->
            <div class="tools-text" style="padding-left: 50px;">
                <h2 style="padding-right: 150px;">Training and<span> Certificates</span></h2>
                <p>
                    Easily launch live assignments, quizzes, and tests. Student results are automatically entered in the online gradebook.
                </p>
            </div>
        </div>


        <div class="tools-wrapper">
        <!-- Bagian Teks (Kiri) -->
        <div class="tools-text">
            <h2>Tools <span>For Leaders and Employees</span></h2>
            <p>
            Class has a dynamic set of teaching tools built to be deployed and used during class. Teachers can hand out assignments in real-time for students to complete and submit.
            </p>
        </div>

        <!-- Bagian Gambar (Kanan) -->
        <div class="tools-image">
            <!-- Ganti "img/tools.png" dengan path gambar yang sudah mencakup semua elemen -->
            <img src="img/Group 124.png" alt="Tools for Leaders and Employees" />
        </div>
        </div>
    </section>


  <script>
    // JavaScript untuk animasi menu burger pada mobile
    const navSlide = () => {
      const burger = document.querySelector('.burger');
      const nav = document.querySelector('.nav-links');
      const navLinks = document.querySelectorAll('.nav-links li');

      burger.addEventListener('click', () => {
        nav.classList.toggle('nav-active');

        navLinks.forEach((link, index) => {
          if(link.style.animation) {
            link.style.animation = '';
          } else {
            link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`;
          }
        });

        burger.classList.toggle('toggle');
      });
    }
    navSlide();
  </script>

</body>
</html>
