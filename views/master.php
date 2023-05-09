<!doctype html>
<html lang="en" data-bs-theme="dark">

	<!-- Load header -->
	<?php

use app\core\Session;
	use app\core\View;

	View::loadTemplate('_head'); ?>

	<body class="d-flex flex-column min-vh-100">

		<?php
	if (Session::$isError) {
	    View::loadTemplate('_error');
	} else {
	    View::loadTemplate(Session::currentScript());
	}
	?>

		<div id="modalsGarbage">
			<div class="modal fade" data-bs-backdrop="static" id="dummy-dialog-modal" tabindex="-1" role="dialog"
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

		<!-- Jquery -->
		<script src="<?= URL_ROOT ?>js/jquery/jquery.js">
		</script>

		<!-- Bootstrap JS -->
		<script src="<?= URL_ROOT ?>js/bootstrap/bootstrap.bundle.js"></script>

		<?php
	    if (Session::isAuthenticated()) {?>
		<script src="<?= URL_ROOT ?>js/theme-switcher.js"></script>
		<script src="<?= URL_ROOT ?>js/hello.js"></script>
		<?php } ?>

		<!-- Custom icons from font-awesome -->
		<script src="https://kit.fontawesome.com/cd2caad5e8.js" crossorigin="anonymous"></script>

		<!-- ImageLoaded -->
		<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>

		<!-- Masonry -->
		<script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>

		<!-- App JS -->
		<script src="<?= URL_ROOT ?>js/app.min.js"></script>
		
		<!-- Dropzone JS -->
		<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
		
		<!-- Dialog JS -->
		<script src="<?= URL_ROOT ?>js/dialog/dialog.js"></script>
		
		<!-- Toast JS -->
		<script src="<?= URL_ROOT ?>js/toast/toast.js"></script>

		<!-- Test JS -->
		<script src="<?= URL_ROOT ?>js/test.js"></script>

	</body>

</html>