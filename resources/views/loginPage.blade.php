<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <style>
    /* Scaling container */
    .ScaledContainer {
      transform: scale(0.8); /* Ubah nilai scale sesuai kebutuhan */
    }

    .LoginContainer {
      max-width: 100%;
      height: 700px;
      padding-left: 50px;
      padding-right: 50px;
      background: #ffffff;
      justify-content: center;
      align-items: center;
      gap: 111px;
      display: flex;
    }

    .Image14 {
      width: 737px;
      height: 737px;
      border-radius: 29px;
    }

    .Group230 {
      width: 454px;
      height: 611px;
      position: relative;
    }

    .Group223 {
      width: 329px;
      height: 107px;
      left: 53px;
      top: 0px;
      position: absolute;
    }

    .Group222 {
      width: 329px;
      height: 59px;
      left: 0px;
      top: 48px;
      position: absolute;
      background-color: rgba(41, 220, 62, 0.2471);
      border-radius: 33px;
    }

    .Rectangle78 {
      width: 160px;
      height: 45px;
      left: 7px;
      top: 7px;
      position: absolute;
      background: #29DC3E;
      border-radius: 90px;
      /* Animasi transisi */
      transition: left 0.3s ease, width 0.3s ease;
    }

    .Rectangle79 {
      left: 13px;
      top: 10px;
      position: absolute;
    }

    .LoginButton {
      left: 64px;
      top: 18px;
      position: absolute;
      color: white;
      font-size: 16px;
      font-family: Poppins;
      font-weight: 500;
      word-wrap: break-word;
    }

    .RegisterButton {
      left: 204px;
      top: 18px;
      position: absolute;
      color: white;
      font-size: 16px;
      font-family: Poppins;
      font-weight: 400;
      word-wrap: break-word;
    }

    .WelcomeToCohive {
      left: 86px;
      top: 0px;
      position: absolute;
      color: black;
      font-size: 16px;
      font-family: Poppins;
      font-weight: 400;
      word-wrap: break-word;
    }

    .Group228 {
      width: 454px;
      height: 301px;
      left: 0px;
      top: 159px;
      position: absolute;
    }

    .Group225 {
      width: 435px;
      height: 90px;
      left: 0px;
      top: 75px;
      position: absolute;
    }

    .Rectangle80 {
      width: 435px;
      height: 54px;
      left: 0px;
      top: 36px;
      position: absolute;
      background: white;
      border-radius: 40px;
      border: 1px #358131 solid;
    }

    .UserName {
      left: 0px;
      top: 0px;
      position: absolute;
      color: black;
      font-size: 16px;
      font-family: Poppins;
      font-weight: 400;
      word-wrap: break-word;
    }

    .EnterYourUserName {
      left: 31px;
      top: 51px;
      position: absolute;
      color: #ACACAC;
      font-size: 15px;
      font-family: Poppins;
      font-weight: 300;
      word-wrap: break-word;
    }

    .Group227 {
      width: 435px;
      height: 90px;
      left: 0px;
      top: 211px;
      position: absolute;
    }

    .Password {
      left: 0px;
      top: 0px;
      position: absolute;
      color: black;
      font-size: 16px;
      font-family: Poppins;
      font-weight: 400;
      word-wrap: break-word;
    }

    .EnterYourPassword {
      left: 31px;
      top: 51px;
      position: absolute;
      color: #ACACAC;
      font-size: 15px;
      font-family: Poppins;
      font-weight: 300;
      word-wrap: break-word;
    }

    .Invisible1 {
      left: 389px;
      top: 54px;
      position: absolute;
      cursor: pointer;
    }

    .LoremIpsum {
      width: 454px;
      height: 49px;
      left: 0px;
      top: 0px;
      position: absolute;
      color: #5B5B5B;
      font-size: 16px;
      font-family: Poppins;
      font-weight: 400;
      word-wrap: break-word;
    }

    .Group24 {
      width: 432px;
      height: 18px;
      left: 0px;
      top: 300px;
      position: absolute;
    }

    .Rectangle5 {
      width: 15px;
      height: 15px;
      left: 0px;
      top: 3px;
      position: absolute;
      background: white;
      border: 1px black solid;
    }

    .RememberMe {
      left: 25px;
      top: 0px;
      position: absolute;
      color: black;
      font-size: 12px;
      font-family: Poppins;
      font-weight: 300;
      word-wrap: break-word;
    }

    .ForgotPassword {
      left: 324px;
      top: 0px;
      position: absolute;
      color: black;
      font-size: 12px;
      font-family: Poppins;
      font-weight: 300;
      word-wrap: break-word;
    }

    .Group229 {
      width: 232px;
      height: 49px;
      left: 203px;
      top: 562px;
      position: absolute;
    }

    .Rectangle81 {
      width: 232px;
      height: 49px;
      left: 0px;
      top: 0px;
      position: absolute;
      background: #29DC3E;
      border-radius: 36px;
    }

    .LoginText {
      left: 94px;
      top: 13px;
      position: absolute;
      color: white;
      font-size: 16px;
      font-family: Poppins;
      font-weight: 400;
      word-wrap: break-word;
    }

    /* Form Register */
    .Group232 {
      width: 435px;
      height: 90px;
      left: 0px;
      top: 91px;
      position: absolute;
    }

    .EmailAddress {
      left: 0px;
      top: 0px;
      position: absolute;
      color: black;
      font-size: 16px;
      font-family: Poppins;
      font-weight: 400;
      word-wrap: break-word;
    }

    .EnterYourEmailAddress {
      left: 31px;
      top: 51px;
      position: absolute;
      color: #ACACAC;
      font-size: 15px;
      font-family: Poppins;
      font-weight: 300;
      word-wrap: break-word;
    }

    /* Styling untuk input field */
    .inputField {
      width: 435px;
      height: 54px;
      border: none;
      outline: none;
      padding: 0 20px;
      font-size: 16px;
      font-family: Poppins;
      border-radius: 40px;
      position: absolute;
      top: 36px; /* Sama dengan posisi Rectangle80 */
      left: 0;
      background: transparent;
      color: black;
    }


    /* Form Register */
    .Group228.register {
      display: none;
    }

    .Group228.register .Group225 {
      top: 0px;
    }

    .Group228.register .Group227 {
      top: 120px;
    }

    .Group228.register .Group229 .LoginText {
      content: 'Register';
    }
  </style>
</head>
<body style="max-height: 97vh;">
  <div class="ScaledContainer">
    <div data-layer="Login" class="LoginContainer">
      <img data-layer="image 14" class="Image14" src="img/image14.png" />
      <div data-layer="Group 230" class="Group230">
        <div data-layer="Group 223" class="Group223">
          <div data-layer="Group 222" class="Group222">
            <div class="Rectangle78" id="activeIndicator"></div>
            <div data-layer="Login" class="LoginButton active-tab" id="loginTab">Login</div>
            <div data-layer="Register" class="RegisterButton inactive-tab" id="registerTab">Register</div>
          </div>
          <div data-layer="Welcome to CoHive!" class="WelcomeToCohive">Welcome to CoHive!</div>
        </div>

        <!-- Form login -->
        <div data-layer="Group 228" class="Group228 login">
          <div data-layer="Lorem Ipsum is simply dummy text of the printing and typesetting industry." class="LoremIpsum">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          </div>
          <!-- Group untuk username -->
          <div data-layer="Group 225" class="Group225">
            <div data-layer="Rectangle 80" class="Rectangle80"></div>
            <div data-layer="User name" class="UserName">User name</div>
            <div data-layer="Enter your User name" class="EnterYourUserName"></div>
            <!-- Input username -->
            <input type="text" id="usernameInput" placeholder="Enter your User name" class="inputField" />
          </div>
          <!-- Group untuk password -->
          <div data-layer="Group 227" class="Group227" style="top: 180px;">
            <div data-layer="Group 226" class="Group226">
              <div data-layer="Rectangle 80" class="Rectangle80"></div>
              <div data-layer="Password" class="Password">Password</div>
              <div data-layer="Enter your Password" class="EnterYourPassword"></div>
              <!-- Input password -->
              <input type="password" id="passwordInput" placeholder="Enter your Password" class="inputField" />
            </div>
            <!-- Ikon mata untuk toggle visibility -->
            <div data-svg-wrapper data-layer="invisible 1" class="Invisible1" id="togglePassword">
              <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_28_157)">
                  <path d="M8.86328 6.14936L11.44 8.72604L11.4522 8.59107C11.4522 7.23728 10.352 6.13708 8.99825 6.13708L8.86328 6.14936Z" fill="black"/>
                  <path d="M8.99795 4.50103C11.2556 4.50103 13.0879 6.33335 13.0879 8.59102C13.0879 9.11863 12.9816 9.6217 12.7976 10.0839L15.1902 12.4765C16.4254 11.4458 17.3988 10.1125 18 8.59102C16.5808 5.00003 13.092 2.45605 8.99798 2.45605C7.85278 2.45605 6.75669 2.66054 5.73828 3.02864L7.50515 4.79141C7.96727 4.61146 8.47034 4.50103 8.99795 4.50103Z" fill="black"/>
                  <path d="M0.817983 2.27207L2.68301 4.1371L3.05521 4.5093C1.70552 5.56452 0.638037 6.96739 0 8.59109C1.41515 12.1821 4.90798 14.7261 8.99797 14.7261C10.2659 14.7261 11.4765 14.4807 12.5849 14.0348L12.9326 14.3825L15.317 16.771L16.36 15.7322L1.86093 1.22913L0.817983 2.27207ZM5.34153 6.79151L6.60533 8.05531C6.56852 8.2312 6.54398 8.40704 6.54398 8.59109C6.54398 9.94488 7.64417 11.0451 8.99797 11.0451C9.18202 11.0451 9.3579 11.0205 9.52968 10.9837L10.7935 12.2475C10.2495 12.5175 9.64421 12.6811 8.99797 12.6811C6.7403 12.6811 4.90798 10.8488 4.90798 8.59109C4.90798 7.94488 5.07159 7.33955 5.34153 6.79151Z" fill="black"/>
                </g>
                <defs>
                  <clipPath id="clip0_28_157">
                    <rect width="18" height="18" fill="white"/>
                  </clipPath>
                </defs>
              </svg>
            </div>
        </div>
        <div data-layer="Group 24" class="Group24">
          <div data-layer="Rectangle 5" class="Rectangle5"></div>
          <div data-layer="Rememebr me" class="RememberMe">Remember me</div>
          <div data-layer="Forgot Password ?" class="ForgotPassword">Forgot Password ?</div>
        </div>
        <div class="btnRegister" style="top: 375px;position: absolute;display: flex;justify-content: right;width: 95%;">
            <button class="btnRegister" style="
            color: white;
            font-size: 16px;
            font-family: Poppins;
            font-weight: 400;
            word-wrap: break-word;
            padding: 11px 60px;
            border: none;
            background-color: #29dc3e;
            border-radius: 50px;
        ">Login</button>
        </div>
    </div>






        <!-- Form register -->
        <div data-layer="Group 228" class="Group228 register">
          <div data-layer="Lorem Ipsum is simply dummy text of the printing and typesetting industry." class="LoremIpsum">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          </div>
          <!-- Group untuk email -->
          <div data-layer="Group 232" class="Group232" style="top: 75px;">
            <div data-layer="Rectangle 80" class="Rectangle80"></div>
            <div data-layer="Email Address" class="EmailAddress">Email Address</div>
            <div data-layer="Enter your Email Address" class="EnterYourEmailAddress"></div>
            <!-- Input email -->
            <input type="email" id="emailInput" placeholder="Enter your Email Address" class="inputField" />
          </div>
          <!-- Group untuk username -->
          <div data-layer="Group 225" class="Group225" style="top: 180px;">
            <div data-layer="Rectangle 80" class="Rectangle80"></div>
            <div data-layer="User name" class="UserName">User name</div>
            <div data-layer="Enter your User name" class="EnterYourUserName"></div>
            <!-- Input username -->
            <input type="text" id="usernameInputRegister" placeholder="Enter your User name" class="inputField" />
          </div>
          <!-- Group untuk password -->
          <div data-layer="Group 227" class="Group227" style="top: 285px;">
            <div data-layer="Group 226" class="Group226">
              <div data-layer="Rectangle 80" class="Rectangle80"></div>
              <div data-layer="Password" class="Password">Password</div>
              <div data-layer="Enter your Password" class="EnterYourPassword"></div>
              <!-- Input password -->
              <input type="password" id="passwordInputRegister" placeholder="Enter your Password" class="inputField" />
            </div>
            <!-- Ikon mata untuk toggle visibility -->
            <div data-svg-wrapper data-layer="invisible 1" class="Invisible1" id="togglePasswordRegister">
              <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_28_157)">
                  <path d="M8.86328 6.14936L11.44 8.72604L11.4522 8.59107C11.4522 7.23728 10.352 6.13708 8.99825 6.13708L8.86328 6.14936Z" fill="black"/>
                  <path d="M8.99795 4.50103C11.2556 4.50103 13.0879 6.33335 13.0879 8.59102C13.0879 9.11863 12.9816 9.6217 12.7976 10.0839L15.1902 12.4765C16.4254 11.4458 17.3988 10.1125 18 8.59102C16.5808 5.00003 13.092 2.45605 8.99798 2.45605C7.85278 2.45605 6.75669 2.66054 5.73828 3.02864L7.50515 4.79141C7.96727 4.61146 8.47034 4.50103 8.99795 4.50103Z" fill="black"/>
                  <path d="M0.817983 2.27207L2.68301 4.1371L3.05521 4.5093C1.70552 5.56452 0.638037 6.96739 0 8.59109C1.41515 12.1821 4.90798 14.7261 8.99797 14.7261C10.2659 14.7261 11.4765 14.4807 12.5849 14.0348L12.9326 14.3825L15.317 16.771L16.36 15.7322L1.86093 1.22913L0.817983 2.27207ZM5.34153 6.79151L6.60533 8.05531C6.56852 8.2312 6.54398 8.40704 6.54398 8.59109C6.54398 9.94488 7.64417 11.0451 8.99797 11.0451C9.18202 11.0451 9.3579 11.0205 9.52968 10.9837L10.7935 12.2475C10.2495 12.5175 9.64421 12.6811 8.99797 12.6811C6.7403 12.6811 4.90798 10.8488 4.90798 8.59109C4.90798 7.94488 5.07159 7.33955 5.34153 6.79151Z" fill="black"/>
                </g>
                <defs>
                  <clipPath id="clip0_28_157">
                    <rect width="18" height="18" fill="white"/>
                  </clipPath>
                </defs>
              </svg>
            </div>
          </div>
          <div class="btnRegister" style="top: 405px;position: absolute;display: flex;justify-content: right;width: 95%;">
              <button class="btnRegister" style="
              color: white;
              font-size: 16px;
              font-family: Poppins;
              font-weight: 400;
              word-wrap: break-word;
              padding: 11px 60px;
              border: none;
              background-color: #29dc3e;
              border-radius: 50px;
          ">Register</button>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    const loginTab = document.getElementById('loginTab');
    const registerTab = document.getElementById('registerTab');
    const activeIndicator = document.getElementById('activeIndicator');
    const loginForm = document.querySelector('.Group228.login');
    const registerForm = document.querySelector('.Group228.register');
    const loginButton = document.querySelector('.Group229 .LoginText');

    function switchTab(position, width) {
      // Pindahkan indikator dan ubah lebarnya
      activeIndicator.style.left = position;
      activeIndicator.style.width = width;

      // Update style tab
      if (position === '7px') {
        loginTab.classList.add('active-tab');
        loginTab.classList.remove('inactive-tab');
        registerTab.classList.add('inactive-tab');
        registerTab.classList.remove('active-tab');
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        loginButton.textContent = 'Login';
      } else {
        registerTab.classList.add('active-tab');
        registerTab.classList.remove('inactive-tab');
        loginTab.classList.add('inactive-tab');
        loginTab.classList.remove('active-tab');
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
        loginButton.textContent = 'Register';
      }
    }

    // Event Listeners untuk tab
    loginTab.addEventListener('click', () => switchTab('7px', '160px')); // Default width untuk login
    registerTab.addEventListener('click', () => switchTab('150px', '170px')); // Lebar untuk register

    // Fungsi untuk toggle visibility password
    const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInputRegister = document.getElementById('passwordInputRegister');
    const togglePasswordRegister = document.getElementById('togglePasswordRegister');

    togglePassword.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
    });

    togglePasswordRegister.addEventListener('click', function() {
      const type = passwordInputRegister.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInputRegister.setAttribute('type', type);
    });
  </script>
</body>
</html>
