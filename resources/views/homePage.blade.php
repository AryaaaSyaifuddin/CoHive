<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cohlive Navbar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 65px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #000000;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #2F80ED;
        }

        .auth-buttons {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .login-btn {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }

        .signup-btn {
            background-color: #2F80ED;
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .signup-btn:hover {
            background-color: #256dc4;
        }
    </style>
</head>
<body>
    <nav>
        <a href="#" class="logo">CoHive</a>

        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Courses</a></li>
            <li><a href="#">Articles</a></li>
            <li><a href="#">About Us</a></li>
            <div class="loginRegist">
                <a href="#" class="login-btn" style="padding: 7px 36px; background-color: #31b40e; color: #fff; border-radius: 35px;">Login</a>
                <a href="#" class="signup-btn">Sign Up</a>
            </div>
        </ul>
    </nav>
</body>
</html>
