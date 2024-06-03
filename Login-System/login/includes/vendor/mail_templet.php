<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One-Time Password (OTP) Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            color: #666;
        }
        .otp {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>One-Time Password (OTP) Email</h2>
        <p>Your One-Time Password (OTP) for authentication is:</p>
        <p class="otp">{{ OTP }}</p>
        <p>This OTP is valid for a short period. Do not share it with others. If you did not request this OTP, please ignore this email.</p>
        <p>Thank you for using our service!</p>
        <p>Best regards,<br>{{ APP_NAME }}</p>
    </div>
</body>
</html>
