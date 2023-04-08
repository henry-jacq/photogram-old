<?php
use app\core\Session;

?>

<div class="album py-5">
	<?=Session::loadTemplate('home/show_posts');?>
</div>