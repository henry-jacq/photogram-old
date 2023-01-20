<!doctype html>
<html lang="en">

<!-- Load header -->
<? Session::loadTemplate('_head'); ?>

<body class="bg-dark d-flex flex-column min-vh-100">

    <?
    if (Session::$isError) {
        Session::loadTemplate('_error');
    } else {
        Session::loadTemplate(Session::currentScript());
    }
    ?>

	<div id="modalsGarbage">
		<div class="modal fade animate__animated" id="dummy-dialog-modal" tabindex="-1" role="dialog" aria-labelledby=""
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
				<div class="modal-content blur text-bg-dark" style="box-shadow: rgba(99, 92, 168, 0.3) 0px 0px 0px 3px">
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
   <script src="<?=get_config('base_path')?>js/jquery/jquery.js"></script>
   
   <!-- ImageLoaded -->
   <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
   
   <!-- Masonry -->
    <script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="<?=get_config('base_path')?>js/bootstrap/bootstrap.bundle.js"></script>
    
    <!-- Custom icons from fontawesome -->
    <script src="https://kit.fontawesome.com/cd2caad5e8.js" crossorigin="anonymous"></script>

    <!-- App JS -->
    <script src="<?=get_config('base_path')?>js/app.min.js"></script>

    <!-- Dialog JS -->
    <script src="<?=get_config('base_path')?>js/dialog/dialog.js"></script>

</body>

</html>