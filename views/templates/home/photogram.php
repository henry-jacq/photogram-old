<?php

use app\core\Session;
use app\core\View;

?>

<div class="album py-3">
	<div class="container">
		<?php
		if (Session::currentScript() == "index") {
			View::loadTemplate('templates/home/stories');
		}		
		?>
		<?=View::loadTemplate('templates/home/show_posts');?>
	</div>
</div>