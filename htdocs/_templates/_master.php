<!doctype html>
<html lang="en">

<!-- Load header -->
<? Session::loadTemplate('_head'); ?>

<body>

    <?
    if (Session::$isError) {
        Session::loadTemplate('_error');
    } else {
        Session::loadTemplate(Session::currentScript());
    }
    ?>

    <!-- Jquery -->
    <script src="<?=get_config('base_path')?>js/jquery.js"></script>

    <!-- Bootstrap JS -->
    <script src="<?=get_config('base_path')?>js/bootstrap.bundle.min.js"></script>

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