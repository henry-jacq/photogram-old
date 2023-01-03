
<? if (Session::isset('session_token')){
    $token = Session::get('session_token');

    if (UserSession::authorize($token)){
        ?>
        <main>
            <?
            Session::loadTemplate("index/photogram"); ?>
        </main>
    <? } else {
        ?><script>window.location.href = "<?=get_config('base_path')?>login.php"</script><?
    }
}else{
    ?><script>window.location.href = "<?=get_config('base_path')?>login.php"</script><?   
}
?>