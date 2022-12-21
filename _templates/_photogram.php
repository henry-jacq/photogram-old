<div class="album py-5 bg-light">
    <div class="container">

    <? if (isset($_POST['logout'])) {
        if (Session::isset('session_token')) {
            UserSession::removeSession(Session::get('session_token'));
        }
        Session::destroy();
        // Load the base path
        ?><script>window.location.href = "<?=get_config('base_path')?>"</script><?

    } else { ?>
        <form method="post" href="<?=get_config('base_path')?>" class="float-end p-4">
            <button type="submit" name="logout" class="btn btn-danger">Log out</button>
        </form>
    <? } ?>
        <div class="text-bg-secondary text-light rounded-3 p-5 mb-4">
            <? $userobj = new User(Session::get('session_username')); ?>
            <h1 class="display-6">Welcome back, <?=ucfirst($userobj->getUsername());?></h1>
            <p class="lead">Bio: <?=!is_null($userobj->getBio()) ? $userobj->getBio() : "Not set"?></p>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <? for ($i=0; $i < 12; $i++) { ?>
            <div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Thumbnail</text>
                    </svg>

                    <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional
                            content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">5 mins ago</small>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
