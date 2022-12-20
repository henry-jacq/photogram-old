<?php
include 'libs/load.php';
?>

<!doctype html>
<html lang="en">

<!-- Load header -->
<?php load_template('_head'); ?>

<body>
    <section class="container">
        <div class="row content d-flex justify-content-center align-items-center">
            <!-- Load the login box -->
            <?php load_template('_login'); ?>
        </div>
    </section>

    <!-- Jquery -->
    <script src="<?=get_config('base_path')?>assets/styles/node_modules/jquery/dist/jquery.js"></script>

    <!-- Bootstrap JS -->
    <script src="<?=get_config('base_path')?>assets/styles/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

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