<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .container input[type="email"],
        .container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .container input[type="submit"] {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .container input[type="submit"]:hover {
            background: linear-gradient(135deg, #5b77d1, #8961b9);
        }

        .container .social-login {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .container .social-login img {
            width: 40px;
            height: 40px;
            margin: 0 10px;
            cursor: pointer;
        }

        .container .signup-link {
            margin-top: 20px;
            color: #333;
        }

        .container .signup-link a {
            color: #6e8efb;
            text-decoration: none;
        }

        .container .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul style="list-style-type: none; padding: 0;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="LOGIN">
        </form>
        <!-- <p>Or login with</p>
        <div class="social-login">
            <img src="path-to-facebook-icon.png" alt="Facebook">
            <img src="path-to-google-icon.png" alt="Google">
        </div> -->
        <p class="signup-link">Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
    </div>
</body>

</html>