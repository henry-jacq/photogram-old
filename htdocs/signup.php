<?php
include_once 'libs/load.php';
?>

<!doctype html>
<html lang="en">

<!-- Load header -->
<?php Session::loadTemplate('_head'); ?>

<body>
    <section class="container">
        <div class="row content d-flex justify-content-center align-items-center">
            <!-- Load the sign up box -->
            <?php Session::loadTemplate('signup'); ?>
        </div>
    </section>

    <!-- Jquery -->
    <script src="<?=get_config('base_path')?>js/jquery.js"></script>

    <!-- Bootstrap JS -->
    <script src="<?=get_config('base_path')?>js/bootstrap.bundle.min.js"></script>
</body>

</html>