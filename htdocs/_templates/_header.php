<header>
    <nav class="navbar p-1 border-bottom border-secondary" style="background-color: #dedede;">
        <div class="container-fluid my-0 ml-auto">
            <a class="navbar-brand display-6 text-dracula" href="/">
            <img src="/assets/brand/photogram-logo.png" alt="Logo" width="28" height="30" class="d-inline-block align-text-top"> Photogram</a>
            <div>
                <? // TODO: Profile Dropdown menu which contains edit profile, preferences and logout
                if (Session::isAuthenticated()) {
                    $userobj = new User(Session::get('session_UsernameOrEmail'));?>
                    <a href="#" class="btn border-0 text-decoration-none"><?=ucfirst($userobj->getUsername());?></a>
                    <a href="/?logout" class="btn btn-sm btn-outline-danger">Logout</a><?
                } else { ?>
                    <a href="/login.php" class="btn btn-sm btn-outline-success float-right">Login</a>
                    <a href="./signup.php" class="btn btn-sm btn-outline-secondary">Register</a>
                    <?
                } ?>
            </div>
        </div>
    </nav>
</header>

