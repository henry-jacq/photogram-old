<?php
include_once 'libs/load.php';
?>

<!doctype html>
<html lang="en">

<!-- Load header -->
<?php load_template('_head'); ?>

<body>
    <section class="container">
        <div class="row content d-flex justify-content-center align-items-center">
            <!-- Load the sign up box -->
            <?php load_template('_signup'); ?>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="/photogram/assets/styles/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>