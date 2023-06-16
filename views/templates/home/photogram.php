<?php

use App\Core\View;
use App\Core\Session;

if (Session::currentScript() == 'index') {
	View::loadTemplate('templates/home/sidebar'); 
} ?>

<div id="page-content-wrapper">
	<div class="container mt-2 px-5">
		<?= View::loadTemplate('templates/home/breadcrumb'); ?>
		<?php
		// if (Session::isAuthenticated() && Session::currentScript() == "index") {
		// 	View::loadTemplate('templates/home/stories');
		// }		
		?>
		<?= View::loadTemplate('templates/home/show_posts'); ?>
	</div>
	<?= View::loadTemplate('layouts/footer'); ?>
</div>