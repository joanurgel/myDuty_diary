<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icon/dry.ico') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
   
    <style>
        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
            overflow: hidden; /* Hide overflowing content */
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            position: relative;
        }

        /* Create a keyframe animation for the background images */
        @keyframes backgroundCarousel {
            0% { background-image: url('img/joan.gif'); }
            33% { background-image: url('img/yellow.gif'); }
            66% { background-image: url('img/white.gif'); }
            100% { background-image: url('img/joan.gif'); }
        }

        .carousel {
            width: 100%;
            height: 100%;
            animation: backgroundCarousel 12s linear infinite; /* Adjust the duration as needed */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

        h1 {
            color: #0a0a0a;
        }

        .container h1 {
            font-size: 3em;
            text-transform: uppercase;
        }

        .login-btn {
            padding: 10px 50px;
            background-color: #0babb4;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            color: #fff;
            border: none;
            text-decoration: none;
            margin-top: 20px;
            cursor: pointer;
        }

        .login-btn:hover {
            transform: translateY(-5px);
            background-color: #FFC200;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
        }

        .login-btn:active {
            transform: scale(0.95) translateY(2px);
        }

        .login-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #FFC200, #FFC200);
            opacity: 0;
            transform: scaleX(0);
            transform-origin: bottom left;
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55), opacity 0.3s ease;
            z-index: -1;
        }

        .login-btn:hover::before {
            transform: scaleX(1);
            opacity: 1;
        }
    </style>

</head>
<body class="antialiased">
    <div class="container">
        <!-- Background Carousel -->
        <div class="carousel"></div>

        <!-- Your content -->
        <h1>Intern Duty Diary</h1>
        <img src="{{ asset('img/dgip.gif') }}" alt="Diary Logo" width="20%">
        <a href="{{ route('login') }}" class="login-btn">Login</a>
    </div>
</body>
</html>
