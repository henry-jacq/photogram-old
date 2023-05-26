<?php
use App\Core\Session;
use App\Core\View;

?>
<div class="container p-5 user-select-none">
	<h3 class="fw-light">Profile Page</h3>
	<hr class="py-3">
	<div class="row">
		<div class="col-md-4 text-center align-middle">
			<img class="user-profile-img img-fluid rounded-circle mb-3 opacity-50" src="<?= URL_ROOT ?>assets/default-user-big.jpg" alt="<?= ucfirst(Session::getUser()->getUsername()) ?>-avatar" width="175" height="175">
			<h2 class="fw-normal fs-4">
				<?= ucfirst(Session::getUser()->getUsername()); ?>
			</h2>
			<p>@<?= lcfirst(Session::getUser()->getUsername()); ?>
			</p>
			<!-- <button class="btn btn-sm btn-secondary" onclick="dialog('Not Implemented!',' This feature is not implemented');"><i class="bi bi-pencil me-2"></i>Change Profile</button> -->

			<div class="row text-center mt-4 rounded-3">
				<div class="col p-2">
					<h4 class="fs-5" id="totalUserPosts">0</h4>
					<small class="fs-5 fw-light">Posts</small>
				</div>
				<div class="col p-2">
					<h4 class="fs-5">0</h4>
					<small class="fs-5 fw-light">Followers</small>
				</div>
				<div class="col p-2">
					<h4 class="fs-5">0</h4>
					<small class="fs-5 fw-light">Following</small>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<ul class="list-group border-0 my-3">
				<li class="list-group-item border-0">
					Username<br><b>@<?= Session::getUser()->getUsername(); ?></b>
				</li>
				<li class="list-group-item border-0">Email
					address<br><b><?= Session::getUser()->getEmail() ?></b>
				</li>
			</ul>
			<div class="container border p-3 rounded">
				<h5 class="fw-normal">About Me</h5>
				<p class="fw-light">#!/bin/bash<br>Full stack Developer<br>I convert caffeine into code.</p>
				<a class="text-decoration-none" href="https://github.com/henry-jacq/">Check Out my Github
					Page</a>.<br><br>
				<i>#IoT #electronics #hacking</i>
			</div>
		</div>
		<?= View::loadTemplate('templates/home/photogram'); ?>
	</div>
</div>