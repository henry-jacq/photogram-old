<?
include 'libs/load.php';

?>

<!doctype html>
<html lang="en">

<!-- Load header -->
<? load_template('_head'); ?>

<body>
    <? if (Session::isset('session_token')){
        $token = Session::get('session_token');

        if (UserSession::authorize($token)){
            ?>
            <main>
              <? load_template("_photogram");?>
            </main>
        <? } else {
          ?><script>window.location.href = "<?=get_config('base_path')?>login.php"</script><?
        }
    }else{
        ?><script>window.location.href = "<?=get_config('base_path')?>login.php"</script><?   
    }
    ?>

    <!-- Bootstrap JS -->
    <script src="<?=get_config('base_path')?>js/bootstrap.bundle.min.js"></script>

</body>

</html>