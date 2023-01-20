<header>
    <nav class="navbar p-1 border-bottom border-secondary navbar-expand-lg navbar-dark shadow-lg" style="background-color: #242829;">
        <div class="container-fluid my-0 ml-auto">
            <a class="navbar-brand display-6 text-dracula" href="/">
            <img src="/assets/brand/photogram-logo.png" alt="Logo" width="28" height="30" class="d-inline-block align-text-top"><b> Photogram</b></a>

            <? if (Session::isAuthenticated()) { ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-sharp fa-solid fa-user"></i> Your Account </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                    <? $userobj = new User(Session::get('session_UsernameOrEmail'));?>
                                    <li><a href="/profile" class="dropdown-item" href="">@<?=ucfirst($userobj->getUsername());?></a></li>
                                    <li><hr class="dropdown-divider border-secondary"></li>
                                    <li><a class="dropdown-item" href="#" onclick="dialog('Not Implemented!',' This feature is not implemented');"><i class="fa-solid fa-pen-to-square"></i> Edit profile</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="dialog('Not Implemented!',' This feature is not implemented');"><i class="fa-solid fa-gear"></i> Settings</a></li>
                                    <li><hr class="dropdown-divider border-secondary"></li>
                                    <li><a class="dropdown-item" href="/logout"><i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i> Sign out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            <? } else { ?>
            <div>
                <a href="/login" class="btn btn-sm btn-success float-right">Sign in</a>
                <a href="/signup" class="btn btn-sm btn-secondary">Register</a>
            </div>
            <? } ?>
        </div>
    </nav>
</header>

