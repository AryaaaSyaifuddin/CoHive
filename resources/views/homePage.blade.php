<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CoHive Landing - Responsive Mobile</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="css/homepage.css">
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
      <li><a href="#" style="color: #fff">Home</a></li>
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
        <div class="hex-container">
            <div class="hex red"></div>
            <div class="hex yellow"></div>
        </div>
        <div class="feature-content">
            <h2>Our Features</h2>
            <p>This very extraordinary feature can make learning activities more efficient</p>
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

    <section class="articles-section">
        <div class="container">
          <!-- Header Section -->
          <div class="header">
            <h2>Articles</h2>
            <a href="#" class="see-all">See all</a>
          </div>

          <!-- Articles Grid -->
          <div class="grid">
            <!-- Card 1 -->
            <div class="card-1">
              <div class="card-image">
                <img src="img/Rectangle 33.png" alt="Article 1" />
              </div>
              <div class="card-body">
                <div class="meta">
                  <span class="category">Design</span>
                  <span class="duration">3 Month</span>
                </div>
                <h3 class="card-title">AWS Certified Solutions Architect</h3>
                <p class="card-desc">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div class="card-footer">
                  <div class="author">
                    <img src="img/me.jpg" alt="Lina" />
                    <span>By Lina</span>
                  </div>
                  <div class="price">
                    <span class="old">$100</span>
                    <span class="new">$80</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 2 -->
            <div class="card-1">
              <div class="card-image">
                <img src="img/Group 249.png" alt="Article 2" />
              </div>
              <div class="card-body">
                <div class="meta">
                  <span class="category">Development</span>
                  <span class="duration">4 Month</span>
                </div>
                <h3 class="card-title">Mastering JavaScript for Web</h3>
                <p class="card-desc">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div class="card-footer">
                  <div class="author">
                    <img src="img/me.jpg" alt="Arif" />
                    <span>By Arif</span>
                  </div>
                  <div class="price">
                    <span class="old">$120</span>
                    <span class="new">$90</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 3 -->
            <div class="card-1">
              <div class="card-image">
                <img src="img/Rectangle32.png" alt="Article 3" />
              </div>
              <div class="card-body">
                <div class="meta">
                  <span class="category">Marketing</span>
                  <span class="duration">2 Month</span>
                </div>
                <h3 class="card-title">Basic Digital Marketing Essentials</h3>
                <p class="card-desc">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div class="card-footer">
                  <div class="author">
                    <img src="img/me.jpg" alt="Nia" />
                    <span>By Nia</span>
                  </div>
                  <div class="price">
                    <span class="old">$80</span>
                    <span class="new">$60</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 4 -->
            <div class="card-1">
              <div class="card-image">
                <img src="img/Rectangle 42.png" alt="Article 4" />
              </div>
              <div class="card-body">
                <div class="meta">
                  <span class="category">Business</span>
                  <span class="duration">5 Month</span>
                </div>
                <h3 class="card-title">Entrepreneurship and Marketing Training</h3>
                <p class="card-desc">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div class="card-footer">
                  <div class="author">
                    <img src="img/me.jpg" alt="Rizki" />
                    <span>By Rizki</span>
                  </div>
                  <div class="price">
                    <span class="old">$150</span>
                    <span class="new">$110</span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- .grid -->
        </div><!-- .container -->
      </section>


    <footer class="footer">
        <h2 class="cohive-text">CoHive</h2>
        <p class="subscribe-text">Subscribe to get our Newsletter</p>

        <div class="subscribe-box">
            <input type="email" id="email" placeholder="Your Email" />
            <button id="subscribe-btn">Subscribe</button>
        </div>

        <ul class="footer-links">
            <li><a href="#">Careers</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Conditions</a></li>
        </ul>

        <p class="copyright">© 2025 Startup Technologies.</p>
    </footer>



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

  <script>
        document.getElementById("subscribe-btn").addEventListener("click", function() {
            let button = this;
            let emailInput = document.getElementById("email");

            if (emailInput.value === "") {
                alert("Please enter your email.");
                return;
            }

            // Simulate loading effect
            button.innerText = "Subscribing...";
            button.disabled = true;

            setTimeout(() => {
                button.innerText = "Subscribe";
                button.disabled = false;
                alert("Thank you for subscribing!");
                emailInput.value = ""; // Clear input after subscription
            }, 2000);
        });

  </script>

</body>
</html>
