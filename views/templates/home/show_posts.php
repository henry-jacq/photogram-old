<?php

use Carbon\Carbon;
use App\Model\Like;
use App\Model\Post;
use App\Core\Session;

if (Session::currentScript() == 'index' && Session::isAuthenticated()) : ?>
	<h3 class="fs-3 lead user-select-none">Feed</h3>
	<hr class="py-2">
<?php endif; ?>

<div class="row g-3" id="masonry-area">
	<?php
	$username = isset($_GET['user']) ? $_GET['user'] : '';
	if (Session::currentScript() == "profile") :
		$posts = Post::getUserPosts($username);
		// If user has no posts  uploaded, print this message.
		if (Session::getUser()->getUsername() == $username && empty($posts)) : ?>
			<p class="text-muted text-center align-items-center mb-0">You haven't posted pictures. When you share photos, they'll appear on your profile.</p>
		<?php elseif (empty($posts)) : ?>
			<p class="text-muted text-center align-items-center my-5"><?= $username ?> haven't posted pictures. If they share photos, they'll appear on this profile.</p>
		<?php endif;
	elseif (Session::currentScript() == "index") :
		$posts = Post::getAllPosts();
		// If no posts are uploaded, print this message.
		if (empty($posts)) : ?>
			<p class="text-muted text-center align-items-center mb-0">There are no posts available. Try to share some photos.</p>
	<?php endif;
	endif; ?>

	<?php foreach ($posts as $post) {
		$p = new Post($post['id']);
		$uploaded_time = Carbon::parse($p->getUploadedTime());
		$uploaded_time_str = $uploaded_time->diffForHumans(); ?>

		<div class="col-xxl-3 col-lg-4 col-md-6" id="post-<?= $post['id'] ?>">
			<div class="card shadow-lg">
				<?php if (Session::isAuthenticated()) { ?>
					<header class="card-header p-2 user-select-none border-0">
						<div class="d-flex align-items-center justify-content-between">
							<div class="d-flex align-items-center">
								<div class="avatar avatar-story me-2">
									<a href="/profile/<?= $p->getOwner() ?>" class="d-block link-dark text-decoration-none" aria-expanded="false">
										<img class="user-profile-img border rounded-circle skeleton-img" src="<?= $p->getAvatar() ?>" width="40" height="40" loading="lazy"></a>
								</div>
								<div class="skeleton-header">
									<div class="nav nav-divider skeleton skeleton-text">
										<h7 class="nav-item card-title mb-0"> <a href="/profile/<?= $p->getOwner() ?>" class="text-decoration-none" style="color: var(--bs-dark-text)"><?= ucfirst($p->getOwner()); ?></a>
										</h7>

										<div class="ms-1 align-items-center justify-content-between">
											<span class="nav-item small fw-light"> •
												<?= $uploaded_time_str ?></span>
										</div>
									</div>
									<?php
									if (!empty($p->getUserJob())) { ?>
										<p class="mb-0 small fw-light skeleton skeleton-text"><?= $p->getUserJob() ?></p>
									<? } ?>
								</div>
							</div>
							<div class="dropdown">
								<a role="button" class="btn py-1 px-2 rounded-circle" id="postCardAction-<?= $post['id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="bi bi-three-dots-vertical"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="postCardAction-<?= $post['id'] ?>">
									<li>
										<a class="dropdown-item btn-download" role="button" value="<?php echo ($p->getImageUri()) ?>">
											<i class="fa-solid fa-download"></i>
											<span class="ms-2">Download</span>
										</a>
									</li>
									<li data-id="<?= $post['id'] ?>">
										<a class="dropdown-item btn-copy-link" role="button" value="<?= $p->getImageUri() ?>">
											<i class="fa-solid fa-paperclip"></i>
											<span class="ms-2">Copy link</span>
										</a>
									</li>
									<li data-id="<?= $post['id'] ?>"><a class="dropdown-item btn-full-preview" role="button" value="<?= $p->getImageUri() ?>">
											<i class="fa-solid fa-expand"></i>
											<span class="ms-2">Full preview</span>
										</a>
									</li>
									<?php if (Session::isOwnerOf($p->getOwner())) : ?>
										<li data-id="<?= $post['id'] ?>">
											<a class="dropdown-item btn-edit-post" role="button">
												<i class="fa-solid fa-pen-to-square fa-sm"></i>
												<span class="ms-2">Edit post</span>
											</a>
										</li>
										<?php if (Session::isOwnerOf($p->getOwner())) : ?>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li data-id="<?= $post['id'] ?>">
												<a class="dropdown-item btn btn-delete text-danger" role="button">
													<i class="fa-solid fa-trash-can fa-sm"></i>
													<span class="ms-2">Delete</span>
												</a>
											</li>
										<?php endif; ?>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</header>
				<?php }
				if ($p->hasMultipleImages($post['id'])) {
					$images = $p->getMultipleImages($post['id']);
				?>
					<div id="post-image-<?= $post['id'] ?>" class="carousel slide user-select-none" data-id="<?= $post['id'] ?>">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="<?= $images[0] ?>" class="d-block post-img w-100 rounded" loading="lazy">
							</div>
							<?php foreach ($images as $index => $image_uri) :
								if ($index !== 0) : ?>
									<div class="carousel-item">
										<img src="<?= $image_uri ?>" class="d-block post-img w-100 rounded" loading="lazy">
									</div>
							<? endif;
							endforeach; ?>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#post-image-<?= $post['id'] ?>" data-bs-slide="prev">
							<span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#post-image-<?= $post['id'] ?>" data-bs-slide="next">
							<span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
				<?php
				} else { ?>
					<img class="post-card-image post-img user-select-none rounded" src="<?= $p->getImageUri() ?>" loading="lazy" data-id="<?= $post['id'] ?>">
				<? } ?>
				<?php if (Session::isAuthenticated()) : ?>
					<div class="card-body px-3 py-2">
						<div class="btn-group fs-5 user-select-none w-100 skeleton skeleton-text gap-3 mb-1">
							<div class="btn-like" data-id="<?= $post['id'] ?>">
								<a id="like-<?= $post['id'] ?>" role="button"><i class="btn fs-5 mb-1 p-0 border-0 <?php echo (Like::isUserLiked($post['id'])) ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart'; ?>"></i></a>
							</div>
							<div class="btn-comment">
								<a role="button"><i class="fa-regular fa-comment"></i></a>
							</div>
							<div class="btn-share">
								<a role="button"><i class="fa-regular fa-paper-plane mt-1"></i></a>
							</div>
							<div class="btn-bookmark ms-auto">
								<a role="button"><i class="fa-regular fa-bookmark"></i></a>
							</div>
						</div>
						<p class="card-text skeleton skeleton-text user-select-none fw-semibold mb-2">
							<span class="likedby-users" role="button" data-id="<?= $post['id'] ?>">
								<span class="like-count me-1"><?= Like::getLikeCount($post['id']) ?></span>Likes
							</span>
						</p>
						<p class="card-text post-text skeleton skeleton-text mb-2"><?= nl2br($p->getPostText()) ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php } ?>
</div>