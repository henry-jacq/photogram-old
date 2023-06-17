<?php

use App\Core\View;
use App\Core\Session;

if (Session::currentScript() == 'index') {
	View::renderTemplate('templates/home/sidebar'); 
} ?>

<div id="page-content-wrapper">
	<div class="container mt-2 px-5">
		<?= View::renderTemplate('templates/home/breadcrumb'); ?>
		<?php
		if (Session::isAuthenticated() && Session::currentScript() == "index") {
			View::renderTemplate('templates/home/stories');
		}		
		?>
		<?=View::renderTemplate('templates/home/show_posts');?>
	</div>
	<?= View::renderLayout('footer'); ?>
</div>