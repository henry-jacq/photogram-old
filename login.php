<?php
include 'libs/load.php';
?>

<!doctype html>
<html lang="en">

<?php load_template('_head'); ?>

<body>
    <section class="container">
        <div class="row content d-flex justify-content-center align-items-center">
            <div class="col-md-4">
                <div class="box shadow p-5 rounded">
                    <?php load_template('_login'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="/photogram/assets/styles/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Jquery required for popup box -->    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous">
        document.addEventListener('DOMContentLoaded', () => {
            $('.alert').alert()
        })
    </script>
</body>

</html>