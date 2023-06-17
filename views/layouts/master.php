<!doctype html>
<html lang="en" data-bs-theme="dark">

	<?php

	use App\Core\View;
	use App\Core\Session;

	// Load header
	View::renderLayout('head'); ?>

	<body class="d-flex flex-column min-vh-100">
		
		<noscript>
			<h1>Photogram</h1>
			<p><strong>Photo-sharing web application</strong></p>
			<p data-nosnippet>You need to enable JavaScript to run this app.</p>
		</noscript>
	
		<?php
		if (Session::$isError) {
			// If it is error, load the error page
			View::loadErrorPage();
		} else {
			// If no error, load the current script
			View::renderTemplate(Session::currentScript());
		}
		// Load the static elements
		View::renderLayout('elements');
		// Link javascript files
		View::renderLayout('load_js');
		?>

	</body>

</html>