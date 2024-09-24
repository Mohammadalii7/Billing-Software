<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png/jpg" href="{{ asset('assets/css/Logo1.png') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
        }

        .wrapper {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 230px;
            background-color: #f8f9fa;
            height: 130vh;
            padding: 20px 0px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .logo img {
            border-radius: 50%;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 33px;
            margin-right:50px;
            padding:10px;
            font-weight: 500;
            color: #332d2d;
        }

        .menu {
            list-style: none;
            padding-left: 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            font-size: 17px;
            color: #5a5a5a;
            margin-bottom: 15px;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease;

        }

        .menu-item a {
            text-decoration: none;
            color: #5a5a5a;
            margin-left: 15px;
            transition: color 0.2s ease;
        }

        .menu-item i {
            font-size: 22px;

        }

        .menu-item:hover {
            background-color: #f0f0f0;
        }

        .menu-item:hover a {
            color: #7f58ff;
        }

        .menu-item.active {
            background-color: #7f58ff;
            color: #fff;
        }

        .menu-item.active a {
            color: #fff;
        }

        .menu-item.active i {
            color: #fff;
        }

        .content {
            width: calc(100% - 250px);
            padding: 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            padding: 0px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .profile img {
            border-radius: 50%;
        }

        .main-content {
            margin-top: 30px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }


        .avatar {
            position: relative;
            display: inline-block;
        }

        .avatar img {
            width: 35px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Active green dot */
        .avatar-online::after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #28a745;
            /* Green color for active status */
            border-radius: 50%;
            bottom: 0;
            right: 0;
            border: 2px solid #fff;
              
            /* Border to make the green dot more visible */
        }

        .dropdown-toggle::after {
            display: none;
               box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Add a shadow */
        }

        .word {
            color: orange;
        }

        .list {
            margin-left: 9px;
        }

        .add {
            margin-left: 7px;
        }

        .log {

            
            margin-left: 4px;
            color: red;
        }

        .footer {
            background-color: #f8f9fa;
            text-align: center;
            color: #343a40;
     
            margin-top: auto;
         
        }

        .footer p {
            margin: 0;
            font-size: 15px;
        }
        .fw-semibold{
            color:grey;
            font-family:italic;
            font-size: 18px;
            font-weight: bold;
           
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <nav class="sidebar">
            <div class="logo">
                <h2 class="logo-text">Auto <span class="word">Relax</span></h2>
            </div>
            <ul class="menu">
                <li class="menu-item">
                    <i class="fas fa-home"></i>
                    <a href="Home">Dashboard</a>
                </li>
                <li class="menu-item">
                    <i class="fas fa-file-invoice"></i>
                    <a href="ShowInvoice"><span class="list">Invoice List</span> </a>
                </li>
                <li class="menu-item">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <a href="AddInvoice"><span class="add">Add Invoice</span> </a>
                </li>
                <li class="menu-item">
                    <i class="fa fa-sign-out-alt" style="color:red;"></i>
                    <a href="logout"><span class="log">Logout</span></a>
                </li>
            </ul>
        </nav>

        <div class="content">
            <div class="topbar">
                <div class="searchbar"></div>
                <div class="profile">
                    <!-- User Profile Dropdown -->
                    {{-- <li class="nav-item navbar-dropdown dropdown-user dropdown"> --}}
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{asset('assets/css/avtar.jpg')}}" alt="Profile Image" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-1">
                                        <div class="avatar avatar-online">
                                            <img src="{{asset('assets/css/avtar.jpg')}}" alt="Profile Image" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">Mahendi Hasan</span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    {{-- </li> --}}
                </div>
            </div>

            <div id="page-content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if (session('success'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        const Toast = Swal.mixin({
                            toast: true
                            , position: 'top-right'
                            , iconColor: 'green'
                            , customClass: {
                                popup: 'colored-toast'
                            }
                            , showConfirmButton: false
                            , timer: 1500
                            , timerProgressBar: true
                        });

                        Toast.fire({
                            icon: 'success'
                            , title: "{{ session('success') }}"
                        });

                    </script>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    {{-- <footer class="footer">
        <div class="container">
            {{-- <p>© 2024 Admin Panel. All rights reserved.</p> --}}
            {{-- <p>Powered by <a href="Home">AutoRelax</p></a>
        </div>
    </footer> --}} 


    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
