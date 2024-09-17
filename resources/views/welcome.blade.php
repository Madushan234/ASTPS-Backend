<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel - Travel App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* Base styles using Tailwind CSS */
            body {
                margin: 0;
                font-family: 'Figtree', sans-serif;
                background-color: white; /* Set background to white */
                color: #333;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh; /* Full viewport height */
            }
            .container {
                text-align: center;
                padding: 20px;
            }
            .logo img {
                width: 300px;
                height: auto;
                margin: 0 auto;
            }
            .tagline {
                font-size: 24px;
                font-weight: 600;
                margin-top: 20px;
                color: #000000;
            }
            .tagline-2 {
                font-size: 16px;
                font-weight: 600;
                margin-top: 20px;
                color: #000000;
            }
            .login-link {
                margin-top: 20px;
                font-size: 18px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Travel App Logo">
            </div>
            
            <!-- Tagline -->
            <div class="tagline">
                All Your Travel Needs In One App
            </div>
            <div class="tagline-2">
                Admin Portral
            </div>
            
            <!-- Login/Navigation -->
            @if (Route::has('login'))
                <div class="login-link">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-black underline">Go to Dashboard</a>
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
