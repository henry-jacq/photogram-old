<?php

use App\Core\Session;
use App\Core\View;

?>

<div class="album py-3">
	<div class="container">
		<?php
		if (Session::isAuthenticated() && Session::currentScript() == "index") {
			View::renderTemplate('templates/home/stories');
		}		
		?>
		<?=View::renderTemplate('templates/home/show_posts');?>
	</div>
</div>