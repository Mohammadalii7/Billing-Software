<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        /* Ensure sidebar and content are properly aligned side by side */
        #wrapper {
            display: flex;
            min-height: 100vh; /* Full page height */
        }
        #sidebar-wrapper {
            width: 250px;
            background-color: #343a40;
            color: white;
            border-right: 1px solid #ddd;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 20px;
            font-size: 1.5rem;
            text-align: center;
            background-color: orange;
            color: white;
            border-bottom: 1px solid #ddd;
        }
        #sidebar-wrapper .list-group-item {
            background-color: #343a40;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }
        #sidebar-wrapper .list-group-item:hover {
            background-color: #007bff;
            color: white;
        }
        #sidebar-wrapper .list-group-item.active {
            background-color: #007bff;
            border: none;
        }
        #page-content-wrapper {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
            overflow-y: auto;
        }
        /* Responsive Design: Make the sidebar collapsible on smaller screens */
        @media (max-width: 768px) {
            #wrapper {
                flex-direction: column;
            }
            #sidebar-wrapper {
                width: 100%;
                height: auto;
            }
            #page-content-wrapper {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">Auto Relax</div>
            <div class="list-group list-group-flush">
                <a href="home" class="list-group-item list-group-item-action "><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="{{url('showlist')}}" class="list-group-item list-group-item-action"><i class="fas fa-file-invoice"></i> Invoices</a>
                <a href="{{url('invoice')}}" class="list-group-item list-group-item-action"><i class="fas fa-plus"></i> Add Invoice</a>
                <a href="logout" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
