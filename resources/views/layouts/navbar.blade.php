    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">

            </li>

            <li class="nav-item dropdown">

            </li>
            <li class="nav-item">

            </li>
            <li class="nav-item">
                <form action="{{ url('/auth/logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
