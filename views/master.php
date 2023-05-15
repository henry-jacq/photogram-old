<!doctype html>
<html lang="en" data-bs-theme="dark">

	<!-- Load header -->
	<?php

	use app\core\View;
	use app\core\Session;

	View::loadTemplate('templates/head'); ?>

	<body class="d-flex flex-column min-vh-100">
		
		<noscript><h1>Photogram</h1><p><strong>Photo-sharing web application</strong></p><p data-nosnippet>You need to enable JavaScript to run this app.</p></noscript>
	
		<?php
		if (Session::$isError) {
			View::loadTemplate('_error');
		} else {
			View::loadTemplate(Session::currentScript());
		}
		?>

		<div id="modalsGarbage">
			<div class="modal fade user-select-none" data-bs-backdrop="static" id="dummy-dialog-modal" tabindex="-1" role="dialog"
				aria-labelledby="" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content blur">
						<div class="modal-header">
							<h4 class="modal-title"></h4>
						</div>
						<div class="modal-body">
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		View::loadTemplate('templates/load_js');
		?>

	</body>

</html>