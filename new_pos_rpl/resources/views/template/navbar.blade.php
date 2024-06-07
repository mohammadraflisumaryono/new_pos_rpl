<!-- Navbar -->
<style>
    /* Style the dropdown button */
    .dropbtn {
        background-color: transparent;
        color: #562D33;
        font-size: 16px;
        border: none;
        cursor: pointer;
        padding: 0;
        margin: 0;
        line-height: inherit;
    }

    .dropbtn i {
        margin: 0;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #F9DAD6;
        min-width: 160px;
        z-index: 1;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        left: -140px;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: #562D33;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background-color: #ddd;
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Navbar styling */
    .navbar {
        background-color: #F9DAD6;
        padding: 0.75rem 1rem;
    }

    .navbar-nav .nav-link {
        color: #562D33;
        font-weight: bold;
    }

    .navbar-nav .nav-link:hover {
        color: #7D6040;
    }
    .navbar-brand {
    color: #562D33;
    font-weight: bold;
    font-size: 20px;
}

.navbar-search input {
    background-color: #FFCCCB; /* Pink peach background */
    border: 1px solid #ddd;
    border-radius: 5px;
}

.navbar-search button {
    background-color: #FFCCCB; /* Pink peach button */
    color: #562D33;
    border-color: #FFCCCB;
    border-radius: 5px;
    padding: 0.375rem 0.75rem;
    font-weight: bold;"
}

.navbar-search button:hover {
    background-color: #FF6347; /* Darker pink peach on hover */
}
</style>

<nav class="main-header navbar navbar-expand navbar-light justify-content-between">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Category</a>
        </li>
    </ul>

    <!-- Center search form slightly more to the right -->
    <div class="navbar-search d-flex" style="flex: 1; justify-content: center;">
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search">
            <button class="btn my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('dashboard')}}" class="nav-link active">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="contact.html" class="nav-link">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cart.index') }}">
                <span class="badge badge-pill bg-danger">{{ \App\Models\Cart::countByUserId(auth()->id()) }}</span>
                <span><i class="fas fa-shopping-cart"></i></span>
            </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block mr-3">
            <div class="dropdown">
                <button class="nav-link dropbtn"><i class="fas fa-user"></i></button>
                <div class="dropdown-content">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <a href="#" class="nav-link"><i class="fas fa-history"></i> Riwayat Transaksi</a>
                    <a href="#" class="nav-link"><i class="fas fa-user-edit"></i> Edit Profile</a>
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link"><i class="fas fa-user-plus"></i> Register</a>
                    @endif
                    @endauth
                    @endif
                </div>
            </div>
        </li>
    </ul>
</nav>

<script>
    // Tambahkan event listener untuk menangani klik pada tombol dropdown
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.dropbtn').forEach(function(dropbtn) {
            dropbtn.addEventListener('click', function() {
                this.nextElementSibling.classList.toggle('show');
            });
        });
    });

    // Tutup dropdown saat pengguna mengklik di luar dropdown
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
