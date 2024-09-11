<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IPExpense')</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Custom Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar-brand, .nav-link, .dropdown-item {
            color: #fff !important;
            font-weight: 500;
        }

        .nav-link:hover, .dropdown-item:hover {
            color: #f0f0f0 !important;
        }

        .navbar-toggler {
            border-color: #f0f0f0;
        }

        .navbar-toggler-icon {
            color: #fff;
        }

        .dropdown-menu {
            background-color: #007bff;
            border: none;
        }

        .dropdown-item {
            color: #fff;
        }

        .dropdown-item:hover {
            background-color: #0056b3;
        }

        .alert {
            border-radius: 0.5rem;
        }

        .footer {
            background-color: #343a40;
            color: #aaa;
            padding: 20px 0;
        }

        .footer a {
            color: #ccc;
            text-decoration: none;
        }

        .footer a:hover {
            color: #fff;
        }

        .footer span {
            font-size: 0.875rem;
        }

        /* Hover Effects for Buttons */
        .btn-primary, .btn-warning, .btn-danger {
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .container {
            padding-top: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-wallet"></i> IPExpense
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('expenses.index') }}"><i class="fas fa-money-bill-wave"></i> Expenses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('incomes.index') }}"><i class="fas fa-coins"></i> Incomes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-tags"></i> Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('budgets.index') }}"><i class="fas fa-chart-pie"></i> Budget</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('recurring-transactions.index') }}"><i class="fas fa-sync-alt"></i> Recurring Transactions</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="container mt-5 pt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">&copy; {{ date('Y') }} IPExpense. All rights reserved. <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></span>
        </div>
    </footer>
</body>
</html>
