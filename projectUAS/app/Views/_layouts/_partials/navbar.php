<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="home" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php
                        if (session()->get('id')) {
                            echo base_url('AuthController/logout');
                        } else {
                            echo base_url('AuthController/login');
                        }
                        ?>" class="nav-link">
                <?php
                if (session()->get('id')) {
                    echo "Logout";
                } else {
                    echo "Login";
                }
                ?></a>
        </li>
    </ul>
</nav>