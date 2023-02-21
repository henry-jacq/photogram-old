<header>
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-lg px-3 border-bottom shadow shadow-bottom">
        <!-- Logo START -->
        <a class="navbar-brand display-6 me-auto" href="/">
            <img src="/assets/brand/photogram-logo.png" alt="Logo" width="27" height="31" class="d-inline-block align-text-top"><b> Photogram</b></a>
        <!-- Logo END -->
        <? if (Session::isAuthenticated()) { ?>
            <!-- Nav right START -->
            <ul class="nav flex-nowrap align-items-center ms-sm-3 list-unstyled">
                <li class="nav-item ms-2">
                    <a class="nav-link btn btn-dark border py-1 px-2" href="/">
                        <i class="bi bi-upload fs-6"></i>
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link btn btn-dark border py-1 px-2" href="#">
                        <i class="bi bi-heart fs-6"></i>
                    </a>
                </li>

                <li class="nav-item ms-3 dropdown">
                    <a class="nav-link btn icon-md p-0 border" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="avatar-img rounded-2" src="https://api.dicebear.com/5.x/identicon/svg?seed=<?= ucfirst(Session::getUser()->getUsername()) ?>" alt="<?= ucfirst(Session::getUser()->getUsername()) ?> avatar" width="32" height="32">
                        <span class="position-absolute bottom-0 mt-2 start-0 p-1 bg-success border border-light rounded-circle"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-animation dropdown-menu-end pt-2 small mt-2" aria-labelledby="profileDropdown">
                        <!-- Profile info -->
                        <li class="px-2">
                            <div class="d-flex align-items-center position-relative btn btn-primary-soft">
                                <!-- Avatar -->
                                <div class="avatar me-3">
                                    <img class="avatar-img rounded-circle" src="https://api.dicebear.com/5.x/identicon/svg?seed=<?= ucfirst(Session::getUser()->getUsername()) ?>" alt="<?= ucfirst(Session::getUser()->getUsername()) ?> avatar" width="35" height="35">
                                </div>
                                <div>
                                    <a class="h6 stretched-link text-decoration-none" href="/profile"><?= ucfirst(Session::getUser()->getUsername()) ?></a>
                                    <!-- <p class="small m-0">Web Developer</p> -->
                                </div>
                            </div>
                            <hr class="mt-1 mb-1">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="dialog('Not Implemented!',' This feature is not implemented');">
                                <i class="fa-fw bi bi-pencil me-2"></i>Edit profile</a>
                        </li>
                        <!-- Links -->
                        <li><a class="dropdown-item" href="#" onclick="dialog('Not Implemented!',' This feature is not implemented');"><i class="bi bi-gear fa-fw me-2"></i>Settings</a></li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="dialog('Not Implemented!',' This feature is not implemented');">
                                <i class="fa-fw bi bi-life-preserver me-2"></i>Support us
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item bg-danger-soft-hover" href="/logout"><i class="bi bi-box-arrow-left fa-fw me-2"></i>Sign Out</a></li>
                    </ul>
                </li>
                <!-- Profile START -->
            </ul>
        <? } else { ?>
            <div>
                <a href="/login" class="btn btn-success">Sign in</a>
                <a href="/signup" class="btn btn-secondary">Register</a>
            </div>
        <? } ?>
    </nav>
    <!-- Logo Nav END -->
</header>