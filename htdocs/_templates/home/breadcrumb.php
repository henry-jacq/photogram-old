<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb border rounded p-3">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-secondary-emphasis">Home</a></li>
            <?
            // echo($_SERVER['REQUEST_URI']);
            if ($_SERVER['REQUEST_URI'] == '/settings') { ?>
                <li class="breadcrumb-item active"><a href="/settings" class="text-decoration-none text-secondary-emphasis">Settings</a></li>
                <li class="breadcrumb-item active"><a href="/settings" class="text-decoration-none text-secondary-emphasis"><?= ucfirst(Session::getUser()->getUsername()) ?></a></li>
            <? } elseif ($_SERVER['REQUEST_URI'] == '/profile') { ?>
                <li class="breadcrumb-item active"><a href="/profile" class="text-decoration-none text-secondary-emphasis">Profile</a></li>
                <li class="breadcrumb-item"><a href="/profile" class="text-decoration-none text-secondary-emphasis"><?= ucfirst(Session::getUser()->getUsername()) ?></a></li>
            <? } ?>
        </ol>
    </nav>
</div>
