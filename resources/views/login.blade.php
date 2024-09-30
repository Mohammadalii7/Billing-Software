<!DOCTYPE html>
<html lang="en">
<head>
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Relax</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body,
        html {
            height: 100%;
            background-color: #f5f7fa;
        }

        /* Fade In Animation for Container */
        @-webkit-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Slide In Animation for Right Section */
        @-webkit-keyframes slideIn {
            from {
                -webkit-transform: translateX(100%);
            }

            to {
                -webkit-transform: translateX(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        /* Rotate and Scale Animation for Logo */
        @-webkit-keyframes rotateScale {
            0% {
                -webkit-transform: rotate(0deg) scale(1);
            }

            50% {
                -webkit-transform: rotate(180deg) scale(1.2);
            }

            100% {
                -webkit-transform: rotate(360deg) scale(1);
            }
        }

        @keyframes rotateScale {
            0% {
                transform: rotate(0deg) scale(1);
            }

            50% {
                transform: rotate(180deg) scale(1.2);
            }

            100% {
                transform: rotate(360deg) scale(1);
            }
        }

        /* Pulse Animation for Button */
        @-webkit-keyframes pulse {
            0% {
                -webkit-transform: scale(1);
            }

            50% {
                -webkit-transform: scale(1.05);
            }

            100% {
                -webkit-transform: scale(1);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .container {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            gap: 30px;
            -webkit-animation: fadeIn 1s ease-in-out;
            animation: fadeIn 1s ease-in-out;
        }

        .login-box {
            display: flex;
            width: 900px;
            border-radius: 15px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            -webkit-animation: fadeIn 1s ease-in-out;
            animation: fadeIn 1s ease-in-out;
        }

        /* Left Section (Login Form) */
        .left {
            flex: 1;
            background-color: #fff;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        /* Logo Animation */
        .left img {
            position: absolute;
            top: 10px;
            left: 60%;
            width: 180px;
            /* -webkit-animation: rotateScale 3s infinite;
            animation: rotateScale 3s infinite; */
        }

        .left h1 {
            color: #333;
            font-size: 2.8rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .left p {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .left input {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1.1rem;
            transition: border 0.3s ease;
        }

        .left input:focus {
            border-color: #5A67D8;
            outline: none;
        }

        .forgot-password {
            color: #5A67D8;
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 20px;
            text-align: right;
            display: block;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #3F51B5;
        }

        .remember {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            color: #555;
        }

        .remember input {
            margin-right: 10px;
        }

        /* Button with Pulse Animation */
        .left .btn {
            font-size: 20px;
            padding: 15px;
            width: 100%;
            background: linear-gradient(45deg, #1d99a2, #1d99a2);
            color: white;
            border: none;
            border-radius: 30px;
            ss font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            -webkit-animation: pulse 1.5s infinite;
            animation: pulse 1.5s infinite;
        }

        .left .btn:hover {
            background-color: #3F51B5;
        }

        /* Right Section (Promotional Area with Slide-In Animation) */
        .right {
            flex: 1;
            background: linear-gradient(45deg, #1d99a2, #f5faf4);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
            -webkit-animation: slideIn 1s ease forwards;
            animation: slideIn 1s ease forwards;
        }

        .right h2 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: 700;
            line-height: 1.2;
        }

        .right p {
            font-size: 1.4rem;
            line-height: 1.6;
            max-width: 400px;
            color: rgba(255, 255, 255, 0.9);
        }

        .right img {
            max-width: 80%;
            margin-top: 10px;
        }

        /* Additional Styling */
        @media (max-width: 1024px) {
            .login-box {
                flex-direction: column;
                width: 100%;
                margin: 20px;
            }

            .right {
                padding: 30px;
            }

            .right img {
                display: none;

            }
        }

        @media (max-width: 600px) {
            .left h1 {
                font-size: 2.2rem;
            }

            .right h2 {
                font-size: 2.5rem;
            }

            .right p {
                font-size: 1.2rem;
            }
        }

    </style>
</head>
<body>
    <form action="/login" method="POST">
        @csrf
        <div class="container">
            <!-- Login Box -->
            <div class="login-box">
                <!-- Left Side (Login Form) -->
                <div class="left">
                    <h1>Login</h1>
                    <p>Sign in to your account</p>

                    <!-- Email or Username -->
                    <input type="text" name="email" placeholder="Email or Username" class="form-control" required>

                    <!-- Password -->
                    <input type="password" name="password" placeholder="Password" class="form-control" required>

                    <!-- Login Button -->
                    <button type="submit" class="btn">Login</button>
                </div>

                <!-- Right Side (Promotional Area) -->
                <div class="right">
                    <img src="Logo.png" alt="Illustration">
                    <h2>Welcome Back!</h2>
                    <p>Relax Your Car</p>
                </div>
            </div>
        </div>
        @if (session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const Toast = Swal.mixin({
                toast: true
                , position: 'top-right'
                , iconColor: 'red'
                , customClass: {
                    popup: 'colored-toast'
                }
                , showConfirmButton: false
                , timer: 1500
                , timerProgressBar: true
            });

            Toast.fire({
                icon: 'error'
                , title: "{{ session('error') }}"
            });

        </script>
        @endif
    </form>
</body>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
            (registration) => {
                console.log("Service worker registration succeeded:", registration);
            }
            , (error) => {
                console.error(`Service worker registration failed: ${error}`);
            }
        , );
    } else {
        console.error("Service workers are not supported.");
    }

</script>
</html>
