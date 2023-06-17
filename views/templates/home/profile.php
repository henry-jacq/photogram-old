<?php
use App\Core\Session;
use App\Core\View;
use App\Model\UserData;

$ud = new UserData(Session::getUser());
?>
<div class="container p-5 user-select-none">
	<h3 class="fw-light">Profile Page</h3>
	<hr class="py-3">
	<div class="row">
		<div class="col-lg-4 text-center align-middle">
			<img class="user-profile-img img-fluid rounded-circle mb-3" src="<?= $ud->getUserAvatar() ?>" alt="<?= ucfirst(Session::getUser()->getUsername()) ?>-avatar" width="175" height="175">
			<h2 class="fw-normal fs-4">
				<?= ucfirst(Session::getUser()->getUsername()); ?>
			</h2>
			<p>@<?= lcfirst(Session::getUser()->getUsername()); ?></p>
			<?php
			if (!empty($ud->getTwitter())):?>
			<a class="text-primary fs-5 p-1" target="_blank" href="https://twitter.com/<?= $ud->getTwitter()?>"><i class="bi bi-twitter"></i></a>
			<?php endif; if (!empty($ud->getInstagram())): ?>
			<a class="text-danger fs-5 p-1" target="_blank" href="https://instagram.com/<?= $ud->getInstagram()?>"><i class="bi bi-instagram"></i></a>
			<?php endif; ?>
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
		<div class="col-lg-8">
			<ul class="list-group border-0 my-3">
				<li class="list-group-item border-0">
					Username<br><b>@<?= Session::getUser()->getUsername(); ?></b>
				</li>
				<li class="list-group-item border-0">Email
					address<br><b><?= Session::getUser()->getEmail() ?></b>
				</li>
				<?php if (!empty($ud->getLocation())) {?>
				<li class="list-group-item border-0">Location
					<br><b><i class="bi bi-geo-alt me-1"></i><?= $ud->getLocation() ?></b>
				</li>
				<?}?>
			</ul>
			<?php
			if (!empty($ud->getBio())) {?>
				<div class="container border p-3 rounded">
					<h5 class="fw-normal">About Me</h5>
					<textarea class="form-control border-0 shadow-none p-0 rounded-0" rows="6" style="resize: none; white-space: pre-line;" readonly>
						<?= $ud->getBio()?>
					</textarea>
				</div>
			<?}
			?>
		</div>
		<?= View::renderTemplate('templates/home/photogram'); ?>
	</div>
</div>