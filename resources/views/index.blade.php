<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income and Expenses Tracker</title>
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .card-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-container {
            text-align: center;
            margin-top: 50px;
        }

        .welcome-text {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .tagline {
            font-size: 14px;
            color: #6c757d;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #ffffff;
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="welcome-container">
    <div class="welcome-text">Welcome to Income and Expenses Tracker</div>
    <div class="tagline">Track Every Income and Expenses of Your Daily Life</div>
</div>

<div class="button-container">
    <a href="{{route('login.form')}}" class="button">Login</a>
    <a href="{{route('register.form')}}" class="button">Register</a>
</div>
</body>
</html>
