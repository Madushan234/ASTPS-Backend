</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #0000FF;
            color: white;
            padding: 10px 0;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            padding: 20px;
        }

        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #0000FF;
            color: white;
            border-radius: 0 0 10px 10px;
        }

        .button {
            display: inline-block;
            background-color: #0000FF;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .button:hover {
            background-color: #0000FF;
        }

        .note {
            font-size: 0.9em;
            color: #777;
            margin-top: 20px;
        }

        .center {
            color: white;
            padding: 10px 0;
            text-align: center;
            border-radius: 10px 10px 0 0;
            position: relative;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Reset Your Password</h1>
        </div>
        <div class="content">
            <div class="center">
                <img class="" src="{{$logo}}" alt="Traxi Logo" />
            </div>
            <p>Hello,</p>

            <p>We received a request to reset your password for your ASTPS account associated with {{ $email }}. No worries, we’ve got you covered!</p>

            <p>Click the button below to reset your password:</p>

            <div class="center">
                <a href="{{ $url }}" class="button">Reset Password</a>
            </div>

            <p>If you didn’t request a password reset, please ignore this email. Your password will remain unchanged, and your account is secure.</p>

            <p>For further assistance, feel free to reach out to our support team at <a href="mailto:support@astps.com">support@astps.com</a>.</p>

            <p>Best regards,<br>
                The ASTPS Team</p>

            <p class="note">This password reset link is valid for the next 24 hours. After that, you’ll need to request a new link.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 ASTPS. All rights reserved.</p>
        </div>
    </div>
</body>

</html>