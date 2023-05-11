<?php
use app\core\Session;
use app\core\View;

?>
<div class="container p-5 user-select-none">
	<h3 class="fw-light">Profile Page</h3>
	<hr class="py-3">
	<div class="row">
		<div class="col-md-4 text-center align-middle">
			<img src="https://api.dicebear.com/5.x/identicon/svg?seed=<?= ucfirst(Session::getUser()->getUsername()) ?>"
				class="img-fluid border rounded-circle mb-3" alt="Profile Picture" width="175" height="175">
			<h2 class="fw-normal fs-4">
				<?= ucfirst(Session::getUser()->getUsername()); ?>
			</h2>
			<p>@<?= lcfirst(Session::getUser()->getUsername()); ?>
			</p>
			<!-- <button class="btn btn-sm btn-secondary" onclick="dialog('Not Implemented!',' This feature is not implemented');"><i class="bi bi-pencil me-2"></i>Change Profile</button> -->

			<div class="row mt-4 mb-3 px-3">
				<div class="col">
					<p class="fw-normal fs-5 mb-0" id="totalUserPosts">0</p>
					<p class="fw-light fs-5">Posts</p>
				</div>
				<div class="col">
					<p class="fw-normal fs-5 mb-0">0</p>
					<p class="fw-light fs-5">Followers</p>
				</div>
				<div class="col">
					<p class="fw-normal fs-5 mb-0">0</p>
					<p class="fw-light fs-5">Following</p>
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
		<h3 class="fw-light py-3 mt-3">My Posts</h3>
		<hr class="p-4">
		<?= View::loadTemplate('home/show_posts'); ?>
	</div>
</div>