<header>
    <nav class="navbar p-1 border-bottom border-secondary navbar-expand-lg" style="background-color: #dedede;">
        <div class="container-fluid my-0 ml-auto">
            <a class="navbar-brand display-6 text-dracula" href="/">
            <img src="/assets/brand/photogram-logo.png" alt="Logo" width="28" height="30" class="d-inline-block align-text-top"> Photogram</a>

            <? if (Session::isAuthenticated()) { ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Your Profile </a>
                                <ul class="dropdown-menu dropdown-menu-end" style="background-color: #dedddd;">
                                    <?
                                    $userobj = new User(Session::get('session_UsernameOrEmail'));?>
                                    <li><a href="#" class="dropdown-item" href="">@<?=ucfirst($userobj->getUsername());?></a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Edit profile</a></li>
                                    <li><a class="dropdown-item" href="#">Preferences</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/?logout">Sign out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            <? } else { ?>
            <div>
                <a href="/login.php" class="btn btn-sm btn-success float-right">Sign in</a>
                <a href="./signup.php" class="btn btn-sm btn-secondary">Register</a>
            </div>
            <? } ?>
        </div>
    </nav>
</header>

