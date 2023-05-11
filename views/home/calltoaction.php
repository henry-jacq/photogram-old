<?php

use app\core\Session;
?>

<section class="py-4 text-center">
	<div class="row py-lg-5 border-bottom ">
		<div class="col-lg-7 col-md-8 mx-auto">
			<h1 class="display-6">What's on your mind,
				<?= strtolower(Session::getUser()->getUsername()); ?>?
			</h1>
			<p class="text-muted fs-5 fw-light">Share a photo that talks about it</p>
			<form class="dropzone border-1 rounded mb-3" method="POST" action="/api/posts/create">
				<textarea class="form-control mb-3" name="post_text" rows="3" placeholder="Say something..."></textarea>
				<p id="total_chars" class="visually-hidden text-end"></p>
				<div class="dz-message py-2">
					<i class="bi bi-images display-4"></i>
					<p>Drop files here or Click to Upload</p>
				</div>
			</form>
			<button class="btn btn-primary btn-upload" type="submit" disabled>Post</button>
			<button class="btn btn-secondary btn-reset" disabled>Clear</button>
		</div>
	</div>
</section>