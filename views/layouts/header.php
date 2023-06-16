<?php

use App\Core\Session;
use App\Model\UserData;

if (Session::isAuthenticated()) {
	$ud = new UserData(Session::getUser());
}
?>

<nav class="navbar navbar-expand-md navbar-dark sticky-top border-bottom bg-body">
	<div class="container-fluid">
		<a class="navbar-brand display-4" href="/">
			<img src="/assets/brand/photogram-logo.png" alt="Logo" width="27" height="31" class="d-inline-block align-text-top">
			<div class="d-none d-sm-inline-block">
				<b class="text-body">Photogram</b>
			</div>
		</a>
		<button id="menu-toggle" class="btn border-0 me-auto" type="button">
			<span><i class="bi bi-list-nested"></i></span>
		</button>
		<ul class="nav flex-nowrap align-items-center ms-sm-3 list-unstyled">
			<li class="nav-item ms-2">
				<a class="nav-link text-dark-emphasis bg-body-tertiary btn border py-1 px-2 rounded-circle border-2" id="themeSwitcher" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Switch theme">
					<i class="bi bi-moon-stars"></i>
				</a>
			</li>
			<li class="nav-item ms-2">
				<a class="nav-link text-dark-emphasis bg-body-tertiary btn border py-1 px-2 rounded-circle border-2 position-relative" href="#" onclick="dialog('Not Implemented!',' This feature is not implemented');">
					<i class="bi bi-chat-dots fs-6"></i>
					<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger p-1 fw-semibold">9+</span>
				</a>
			</li>
			<li class="nav-item dropdown ms-2">
				<a class="nav-link text-dark-emphasis bg-body-tertiary btn border py-1 px-2 rounded-circle border-2" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
					<i class="bi bi-bell fs-6"></i>
					<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger p-1 fw-semibold">9+</span>
				</a>
				<div class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0 mt-2" aria-labelledby="notifDropdown">
					<div class="card" style="width:310px;">
						<div class="card-header d-flex justify-content-between align-items-center py-3">
							<h6 class="m-0">Notifications <span class="badge bg-danger bg-opacity-10 text-danger ms-2">3
									new</span></h6>
							<a class="text-dark-emphasis small text-decoration-none" href="#">Clear all</a>
						</div>
						<div class="card-body p-0">
							<ul class="list-group list-group-flush list-unstyled p-2">
								<li>
									<div class="list-group-item list-group-item-action rounded badge-unread d-flex border-0 mb-1 p-3">
										<div class="avatar text-center d-none d-sm-inline-block">
											<img class="avatar-img rounded-circle" src="/assets/random_images/cj.jpg" alt="CJ" width="28" height="30">
										</div>
										<div class="ms-sm-3">
											<div class=" d-flex">
												<p class="small mb-2"><b>CJ</b> sent you a friend request.</p>
												<p class="small ms-3 text-nowrap">Just now</p>
											</div>
											<div class="d-flex">
												<button class="btn btn-sm py-1 btn-primary me-2">Accept </button>
												<button class="btn btn-sm py-1 btn-outline-danger">Delete </button>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="list-group-item list-group-item-action rounded d-flex border-0 mb-1 p-3 position-relative">
										<div class="avatar text-center d-none d-sm-inline-block">
											<img class="avatar-img rounded-circle" src="/assets/random_images/kratos.jpg" alt="kratos" width="28" height="30">
										</div>
										<div class="ms-sm-3">
											<div class=" d-flex">
												<p class="small mb-2"><b>Kratos</b> liked your post. Do you want to
													follow him?</p>
												<p class="small ms-3 text-nowrap">4 hr</p>
											</div>
											<div class="d-flex">
												<button class="btn btn-sm py-1 btn-primary me-2">Follow </button>
											</div>
										</div>
									</div>
								</li>
								<li>
									<a href="#" class="list-group-item list-group-item-action rounded d-flex border-0 p-3 mb-1">
										<div class="avatar text-center d-none d-sm-inline-block">
											<img class="avatar-img p-1" src="/assets/brand/photogram-logo.png" alt="" width="30" height="34">
										</div>
										<div class="ms-sm-3 d-flex">
											<p class="small mb-2"><b>Photogram updates:</b><br> We updated the post card
												design to include the header as well as a dropdown menu that has some
												key features that will be added soon.</p>
											<p class="small ms-3 text-nowrap">4hr</p>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="card-footer text-center">
							<a href="#" class="btn btn-sm btn-outline-secondary">View all notifications</a>
						</div>
					</div>
				</div>
			</li>
			<li class="nav-item ms-3 dropdown">
				<a class="nav-link btn icon-md p-0 border rounded-circle border-2" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
					<img class="user-profile-img img-fluid rounded-circle" src="<?= $ud->getUserAvatar() ?>" alt="user-avatar" width="32" height="32">
					<span class="position-absolute bottom-0 mt-2 start-0 p-1 bg-success border border-light rounded-circle"></span>
				</a>
				<ul class="dropdown-menu dropdown-animation dropdown-menu-end pt-2 small mt-2" aria-labelledby="profileDropdown">
					<li class="px-2">
						<div class="d-flex align-items-center position-relative btn bg-body-tertiary">
							<div class="avatar avatar-story me-2">
								<a href="#" class="d-block link-dark text-decoration-none" aria-expanded="false">
									<img class="user-profile-img border rounded-circle skeleton-img" src="<?= $ud->getUserAvatar() ?>" width="36" height="36"></a>
							</div>
							<div>
								<a class="h6 stretched-link text-decoration-none" href="/profile"><?= ucfirst(Session::getUser()->getUsername()) ?></a>
							</div>
						</div>
						<hr class="mt-2 mb-1">
					</li>
					<li>
						<a class="dropdown-item" href="/edit-profile">
							<i class="fa-fw bi bi-pencil me-2"></i>Edit profile
						</a>
					</li>
					<li>
						<a class="dropdown-item" href="/settings"><i class="bi bi-gear fa-fw me-2"></i>Settings</a>
					</li>
					<li>
						<a class="dropdown-item" href="#" onclick="dialog('Not Implemented!',' This feature is not implemented');">
							<i class="fa-fw bi bi-life-preserver me-2"></i>Support us
						</a>
					</li>
					<li class="dropdown-divider"></li>
					<li><a class="dropdown-item bg-danger-soft-hover" href="/logout"><i class="bi bi-box-arrow-left fa-fw me-2"></i>Sign Out</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>