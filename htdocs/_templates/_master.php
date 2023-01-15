<!doctype html>
<html lang="en">

<!-- Load header -->
<? Session::loadTemplate('_head'); ?>

<body class="bg-dark d-flex flex-column min-vh-100">

    <?
    if (Session::$isError) {
        Session::loadTemplate('_error');
    } else {
        Session::loadTemplate(Session::currentScript());
    }
    ?>
   
   <!-- Jquery -->
   <script src="<?=get_config('base_path')?>js/jquery/jquery.js"></script>
   
   <!-- ImageLoaded -->
   <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
   
   <!-- Masonry -->
    <script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>

    <!-- App JS -->
    <script src="<?=get_config('base_path')?>js/app.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="<?=get_config('base_path')?>js/bootstrap/bootstrap.bundle.js"></script>

    <!-- Custom icons from fontawesome -->
    <script src="https://kit.fontawesome.com/cd2caad5e8.js" crossorigin="anonymous"></script>

    <script>
        // Initialize the agent at application startup.
        const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
            .then(FingerprintJS => FingerprintJS.load())

        // Get the visitor identifier when you need it.
        fpPromise
            .then(fp => fp.get())
            .then(result => {
                // This is the visitor identifier:
                const visitorId = result.visitorId;
                console.log(visitorId);
                $("#fingerprint").val(visitorId);
            })
    </script>
</body>

</html>