<?php
// include needed files
include 'libs/load.php';
include 'libs/validate.php';
?>

<!doctype html>
<html lang="en">

<?load_template('_head'); ?>

<body>
    <main>
        <?
        load_template('_login');
        ?>
    </main>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>