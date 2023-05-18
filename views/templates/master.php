<!doctype html>
<html lang="en" data-bs-theme="dark">

	<?php

	use app\core\View;
	use app\core\Session;

	// Load header
	View::loadTemplate('templates/head'); ?>

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
			View::loadTemplate(Session::currentScript());
		}
		// Load the static elements
		View::loadTemplate('templates/elements');
		// Link javascript files
		View::loadTemplate('templates/load_js');
		?>

	</body>

</html>