<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Arial', sans-serif;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left {
            background-color: #f9f9f9;
            width: 50%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .left h1 {
            color: #4A2D84;
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .left p {
            color: #777;
            margin-bottom: 30px;
        }

        .left input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .left .form-control {
            font-size: 1rem;
        }

        .left .btn {
            width: 100%;
            background-color: #5A67D8;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 25px;
            cursor: pointer;
            margin-top: 10px;
        }

        .left .btn:hover {
            background-color: #3F51B5;
        }

        .right {
            width: 50%;
            background-color: #2D2966;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
        }

        .right h2 {
            font-size: 2.5rem;
        }

        .right p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .forgot-password {
            color: #5A67D8;
            text-align: right;
            display: block;
            margin-top: -10px;
            margin-bottom: 20px;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .remember {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember input {
            margin-right: 10px;
        }

    </style>
</head>
<body>

    <div class="container">
        <!-- Left Side (Login Form) -->
        <div class="left">
            <img src="" alt="Logo" style="width: 150px; margin-bottom: 20px;">
            <h1>Login</h1>
            <p>Site/Admin</p>

            <input type="text" placeholder="Email or Username" class="form-control">
            <input type="password" placeholder="Password" class="form-control">
            {{-- <a href="#" class="forgot-password">Forgot Your Password?</a> --}}

            {{-- <div class="remember">
                <input type="checkbox" id="remember">
                <label for="remember">Remember Me</label>
            </div> --}}

            <button class="btn">Login</button>
        </div>

        <!-- Right Side (Text Area) -->
        <div class="right">
            <h2>Garage Management & Billing System</h2>
            {{-- <p>{ v }</p> --}}
        </div>
    </div>

</body>
</html>
