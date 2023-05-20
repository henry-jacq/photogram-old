<?php
use app\models\Like;
use app\models\Post;
use app\core\Session;

?>

<div class="container p-3">
	<div class="row g-3" id="masonry-area">
		<?php

        use Carbon\Carbon;

if (Session::currentScript() == "profile") {
    $posts = Post::getUserPosts(Session::getUser()->getUsername());
    // If user has no posts  uploaded, print this message.
    if (empty($posts)) { ?>
		<p class="text-muted text-center align-items-center mb-0">You haven't posted pictures. When you share photos,
			they'll appear on your profile.</p>
		<?php }
    } else {
        $posts = Post::getAllPosts();
        // If no posts are uploaded, print this message.
        if (empty($posts)) { ?>
		<p class="text-muted text-center align-items-center mb-0">There are no posts available. Try to share some photos.
		</p>
		<?php }
        } ?>

		<?php foreach ($posts as $post) {
		    $p = new Post($post['id']);
		    $uploaded_time = Carbon::parse($p->getUploadedTime());
		    $uploaded_time_str = $uploaded_time->diffForHumans(); ?>

		<div class="col-lg-3"
			id="post-<?= $post['id'] ?>">
			<div class="card shadow-lg">
				<?php if (Session::isAuthenticated()) { ?>
				<header class="card-header p-2 user-select-none">
					<div class="d-flex align-items-center justify-content-between">
						<div class="d-flex align-items-center">
							<!-- Avatar -->
							<div class="avatar avatar-story me-2">
								<a href="#" class="d-block link-dark text-decoration-none" aria-expanded="false">
									<img class="border rounded-circle"
										src="https://api.dicebear.com/5.x/identicon/svg?seed=<?= ucfirst($p->getOwner()) ?>"
										width="35" height="35"></a>
							</div>
							<!-- Info -->
							<div>
								<div class="nav nav-divider">
									<h7 class="nav-item card-title mb-0"> <a href="#!" class="text-decoration-none"
											style="color: var(--bs-dark-text)"><?= ucfirst($p->getOwner()); ?></a>
									</h7>

									<div class="ms-1 align-items-center justify-content-between">
										<span class="nav-item small fw-light"> •
											<?= $uploaded_time_str ?></span>
									</div>
								</div>
								<p class="mb-0 small fw-light">Web Developer</p>
							</div>
						</div>
						<div class="dropdown">
							<a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2 rounded-circle"
								id="postCardFeedAction" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-three-dots-vertical"></i>
							</a>
							<!-- Card feed action dropdown menu -->
							<ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="postCardFeedAction">
								<li>
									<a class="dropdown-item btn btn-download"
										value="<?php echo($p->getImageUri()) ?>">
										<i class="bi bi-download fa-fw pe-2">
										</i>Download</a>
								</li>
								<li data-id="<?= $post['id'] ?>">
									<a class="dropdown-item btn btn-copy-link"
										value="<?= $p->getImageUri() ?>">
										<i class="bi bi-link-45deg fa-fw pe-2"></i>Copy link</a>
								</li>
								<li onclick="dialog('Not Implemented!',' This feature is not implemented');"><a
										class="dropdown-item" href="#"> <i
											class="bi bi-bookmark fa-fw pe-2"></i>Bookmark</a></li>
								<?php if (Session::isOwnerOf($p->getOwner())) { ?>
								<li onclick="dialog('Not Implemented!',' This feature is not implemented');"><a
										class="dropdown-item" href="#"> <i class="bi bi-pencil fa-fw pe-2"></i>Edit
										post</a></li>
								<!-- <li><a class="dropdown-item" href="#"> <i class="bi bi-archive fa-fw pe-2"></i>Archive post</a></li> -->

								<?php if (Session::isOwnerOf($p->getOwner())) { ?>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li
									data-id="<?= $post['id'] ?>">
									<a class="dropdown-item btn btn-delete"><i
											class="bi bi-trash fa-fw pe-2 text-danger"></i> Delete</a>
								</li>
								<?php } ?>
								<?php } ?>
							</ul>
						</div>
					</div>
				</header>
				<?php } ?>
				<img class="post-card-image user-select-none"
					src="<?= $p->getImageUri() ?>" loading="eager" data-id="<?= $post['id']?>">
				<div class="card-body">
					<div class="btn-group user-select-none">
						<?php if (!Session::isAuthenticated()) { ?>
						<span class="me-3">
							<span class="me-1"><?= Like::getLikeCount($post['id']) ?></span>Likes
						</span>
						<?php } else { ?>
						<div class="btn-like me-3" data-id="<?= $post['id'] ?>">
							<i class="btn border-0 p-0 fa fa-heart-o me-1" id="like-<?= $post['id'] ?>" aria-hidden="true"></i>
							<span class="me-1"><?= Like::getLikeCount($post['id']) ?></span>Likes
						</div>
						<div class="btn-share card-items">
							<i class="bi bi-send me-1 small"></i>Share
						</div>
						<?php } ?>
					</div>
					<p class="card-text mt-2 user-select-all">
						<?= $p->getPostText() ?>
					</p>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>