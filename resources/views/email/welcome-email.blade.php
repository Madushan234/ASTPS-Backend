<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ASTPS</title>
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

        .logo {
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
            <h1>Welcome to ASTPS</h1>
        </div>
        <div class="content">
            <div class="logo">
                <img class="" src="{{$logo}}" alt="Traxi Logo" />
            </div>

            <p>Dear {{ $name }},</p>

            <p>Welcome to ASTPS! We're thrilled to have you join us on this exciting journey towards smarter, more enjoyable travel planning. Below you'll find all the essential details about our platform and how you can get started.</p>

            <h2>About Our Project</h2>
            <p>The <strong>All-in-One Smart Travel Planning System (ASTPS)</strong> is an innovative mobile application designed to simplify and enhance your travel planning experience. Powered by advanced AI, augmented reality (AR), and virtual reality (VR) technologies, our system offers personalized recommendations, seamless bookings, and real-time updates to ensure a smooth and enjoyable journey.</p>

            <h2>Key Features</h2>
            <ul>
                <li><strong>AI-Powered Recommendations:</strong> Receive tailored destination suggestions and itineraries based on your preferences.</li>
                <li><strong>Comprehensive Booking System:</strong> Book flights, hotels, and transportation directly within the app.</li>
                <li><strong>Augmented Reality Experiences:</strong> Explore landmarks with overlaid information for an immersive experience.</li>
                <li><strong>Real-Time Travel Alerts:</strong> Stay informed with up-to-date weather forecasts, flight changes, and more.</li>
                <li><strong>Expense Management:</strong> Track your travel expenses and stay within your budget effortlessly.</li>
                <li><strong>Language Translation:</strong> Break down language barriers with real-time voice and text translation.</li>
                <li><strong>Health and Safety Advisories:</strong> Get informed about the latest health and safety updates.</li>
            </ul>

            <p>If you have any questions or need assistance, our support team is here to help. You can reach us at <a href="mailto:support@astps.com">support@astps.com</a></p>

            <p>Thank you for choosing ASTPS! We can't wait to help you explore the world.</p>

            <p>Best regards,<br>
                The ASTPS Team</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 ASTPS. All rights reserved.</p>
        </div>
    </div>
</body>

</html>