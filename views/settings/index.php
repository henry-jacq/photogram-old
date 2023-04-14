<?php
use app\core\Session;

?>
<div class="container mt-3">
	<div class="row gutters-lg">
		<div class="col-md-3 d-none d-md-block">
			<div class="card border-0">
				<div class="card-body">
					<h4 class="fs-5 fw-normal ms-3"><i class="bi bi-gear me-2"></i>Settings</h4>
					<hr>
					<nav class="nav flex-column nav-pills nav-gap-y-1">
						<a href="#profile" data-toggle="tab"
							class="nav-item nav-link has-icon nav-link-faded bi bi-person active">
							Profile Details
						</a>
						<a href="#account" data-toggle="tab"
							class="nav-item nav-link has-icon nav-link-faded bi bi-person-circle">
							Account Settings
						</a>
						<a href="#email" data-toggle="tab"
							class="nav-item nav-link has-icon nav-link-faded bi bi-envelope">
							Email
						</a>
						<a href="#password" data-toggle="tab"
							class="nav-item nav-link has-icon nav-link-faded bi bi-key">
							Password
						</a>
						<a href="#notification" data-toggle="tab"
							class="nav-item nav-link has-icon nav-link-faded bi bi-bell">
							Notifications
						</a>
						<a href="#sessions" data-toggle="tab"
							class="nav-item nav-link has-icon nav-link-faded bi bi-display">
							Active Sessions
						</a>
					</nav>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-header border-bottom mb-3 d-flex d-md-none">
					<ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
						<li class="nav-item">
							<a href="#profileSection" data-toggle="tab" class="nav-link has-icon active"><i
									class="fa-regular fa-user"></i></a>
						</li>
						<li class="nav-item">
							<a href="#accountSection" data-toggle="tab" class="nav-link has-icon"><i
									class="fa-regular fa-circle-user"></i></a>
						</li>
						<li class="nav-item">
							<a href="#emailSection" data-toggle="tab" class="nav-link has-icon"><i
									class="fa-regular fa-envelope"></i></a>
						</li>
						<li class="nav-item">
							<a href="#passwordSection" data-toggle="tab" class="nav-link has-icon"><i
									class="fa-sharp fa-regular fa-key"></i></a>
						</li>
						<li class="nav-item">
							<a href="#notificationSection" data-toggle="tab" class="nav-link has-icon"><i
									class="fa-regular fa-bell"></i></a>
						</li>
						<li class="nav-item">
							<a href="#sessions" data-toggle="tab" class="nav-link has-icon"><i
									class="fa-sharp fa-regular fa-desktop"></i></i></a>
						</li>
					</ul>
				</div>
				<div class="card-body tab-content">
					<div class="tab-pane active" id="profile">
						<h6>Your Profile Information</h6>
						<hr>
						<form>
							<div class="form-group mb-3">
								<label for="fullName" class="form-label">Full Name</label>
								<input type="text" class="form-control" id="fullName" aria-describedby="fullNameHelp"
									placeholder="Enter your full name"
									value="<?= Session::getUser()->getUsername() ?>">
								<small id="fullNameHelp" class="form-text text-muted">Your name may appear around here
									where you are mentioned. You can change or remove it at any time.</small>
							</div>
							<div class="form-group mb-3">
								<label for="bio" class="form-label">Your Bio</label>
								<textarea class="form-control" id="bio"
									placeholder="Write something about you">A front-end developer that focus more on user interface design, a web interface wizard, a connector of awesomeness.</textarea>
							</div>
							<label for="url" class="form-label">Share Profile Link</label>
							<div class="form-group mb-3 input-group">
								<input type="text" class="form-control user-select-all" id="url"
									placeholder="Enter your website address"
									value="https://<?= $_SERVER['SERVER_NAME'] ?>/<?= Session::getUser()->getUsername() ?>"
									disabled>
								<button class="btn btn-outline-secondary input-group-text" id="copyUserLink"
									type="button" data-toggle="tooltip" title="Click to copy"><i
										class="bi bi-clipboard"></i></button>
							</div>
							<div class="form-group mb-3">
								<label for="location" class="form-label">Location</label>
								<input type="text" class="form-control" id="location" placeholder="Enter your location"
									value="52 Fake st, San Francisco, CA">
							</div>
							<div class="form-group small text-muted mb-3">
								All of the fields on this page are optional and can be deleted at any time, and by
								filling them out, you're giving us consent to share this data wherever your user profile
								appears.
							</div>
							<button type="button" class="btn btn-primary">Save changes</button>
						</form>
					</div>
					<div class="tab-pane" id="account">
						<h6>Account settings</h6>
						<hr>
						<h6>Change username</h6>
						<p>Changing your username can have unintended side effects.</p>
						<form>
							<div class="form-group input-group">
								<span
									class="input-group-text">https://<?= $_SERVER['SERVER_NAME'] ?>/</span>
								<input type="text" class="form-control" id="username" aria-describedby="usernameHelp"
									placeholder="Enter your username"
									value="<?= Session::getUser()->getUsername() ?>">
							</div>
							<small id="usernameHelp" class="form-text text-muted">After changing your username, your old
								username becomes available for anyone else to claim.</small>
							<hr>
							<form>
								<div class="form-group">
									<h6 class="d-block"><i class="bi bi-shield-lock me-2"></i> Two Factor Authentication
									</h6>
									<p class="small text-muted mt-2">Two-factor authentication adds an additional layer
										of security to your account by requiring more than just a password to log in.
									</p>
									<p class="small mt-2">Status: <b class="badge bg-danger">Disabled</b></p>
									<button class="btn btn-outline-primary" type="button">Enable two-factor
										authentication</button>
								</div>
							</form>
							<hr>
							<h6>Delete account</h6>
							<div class="form-group">
								<p>Deleting an account has the following effects:</p>
								<ul>
									<li>Certain user content will be moved to a system-wide "Ghost User" in order to
										maintain content for posterity.</li>
									<li>Your all posts will be removed and cannot be restored.</li>
									<li>Once you delete your account, there is no going back. Please be certain.</li>
								</ul>
								<p>Before deleting your account, take a backup of your data <a href="#"
										class="text-decoration-none">here.</a></p>
							</div>
							<button class="btn btn-danger" type="button"
								onclick="dialog('Delete account?',' Are you sure want to delete your account ?');"
								id="delete-account-button" data-qa-selector="delete_account_button">Delete
								Account</button>
						</form>
					</div>
					<div class="tab-pane" id="email">
						<h6>Email</h6>
						<div class="mb-3">
							<p class="text-muted">You can control emails linked to your account</p>
						</div>
						<!-- <h6>Add email address</h6> -->
						<form>
							<div class="form-group mb-3">
								<label class="d-block mb-1">Add email address</label>
								<input type="email" class="form-control" id="email" aria-describedby="emailHelp"
									placeholder="Enter your email">
							</div>
							<button class="btn btn-primary">Add email address</button>
						</form>
					</div>
					<div class="tab-pane" id="password">
						<h6>Password</h6>
						<hr>
						<p>After a successful password update, you will be redirected to the login page where you can
							log in with your new password.</p>
						<div class="mb-4">
							<p class="mb-2"><b>Password requirements</b></p>
							<p class="small text-muted mb-2">To create a new password, you have to meet all of the
								following requirements:</p>
							<ul class="small text-muted pl-4 mb-0">
								<li>Minimum 8 characters</li>
								<li>At least one special character</li>
								<li>At least one number</li>
								<li>Can't be the same as a previous password</li>
							</ul>
						</div>
						<p><b>Change your password or recover your current one</b></p>
						<!-- <hr> -->
						<form class="" method="post" action="update.php">
							<div class="mb-3">
								<label for="currentPassword" class="form-label">Current password</label>
								<input type="password" class="form-control" id="current-password"
									aria-describedby="passwordHelp" name="current-password" required autocomplete="">
								<div id="passwordHelp" class="form-text">
									You must provide your current password in order to change it.
								</div>
							</div>
							<div class="mb-3">
								<label for="new-password" class="form-label">New password</label>
								<input type="password" class="form-control" id="new-password" name="new-password"
									required autocomplete="">
							</div>
							<div class="mb-3">
								<label for="confirm-password" class="form-label">Confirm password</label>
								<input type="password" class="form-control" id="confirm-password"
									name="password-confirm" required autocomplete="">
							</div>
							<div class="mb-3">
								<button type="submit" id="save-password" class="btn btn-success">Change
									password</button>
								<a class="p-1 btn btn-link text-decoration-none float-end" rel=" nofollow"
									data-method="put" href="/-/profile/password/reset">
									<span>I forgot my password</span>
								</a>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="notification">
						<h6>Notification Settings</h6>
						<hr>
						<form>
							<div class="form-group mb-3">
								<label class="d-block mb-0">Email notifications</label>
								<div class="small text-muted mb-3">Receive alert notifications via email</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="mailIfUserPosted">
									<label class="form-check-label" for="mailIfUserPosted">
										Email when a user is posted
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="mailProductUpdates">
									<label class="form-check-label" for="mailProductUpdates">
										Send me the product updates
									</label>
								</div>
							</div>
							<div class="form-group mb-3">
								<label class="d-block mb-2">Notification Email</label>
								<select class="form-select" aria-label="Default select example">
									<option selected>Use primary email</option>
									<option value="2">thomas@peakyblinders.com</option>
								</select>
							</div>
							<div class="form-group">
								<label class="d-block mb-2">Notifications</label>
								<ul class="list-group list-group-sm">
									<li class="list-group-item has-icon">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="checkComments">
											<label class="form-check-label" for="checkComments">
												Comments
										</div>
										<label class="form-text" for="checkComments">
											Send me an email if someone commented on my post.
										</label>
									</li>
									<li class="list-group-item has-icon">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="checkFollows">
											<label class="form-check-label" for="checkFollows">
												Follows
										</div>
										<label class="form-text" for="checkFollows">
											Send me an email if someone starts following me.
										</label>
									</li>
									<li class="list-group-item has-icon">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="checkDeletePost">
											<label class="form-check-label" for="checkDeletePost">
												Post deletion
										</div>
										<label class="form-text" for="checkDeletePost">
											Send me an email, if post was deleted.
										</label>
									</li>
								</ul>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="sessions">
						<h6>Active Sessions</h6>
						<hr>
						<form>
							<div class="form-group">
								<label class="d-block">Sessions</label>
								<p class="font-size-sm text-secondary">This is a list of devices that have logged into
									your account. Revoke any sessions that you do not recognize.</p>
								<ul class="list-group list-group-sm">
									<li class="list-group-item">
										<div class="d-flex align-items-center justify-content-between">
											<div class="d-flex align-items-center">
												<div class="mb-5 me-3 p-1" data-toggle="tooltip" title="Desktop"><i
														class="bi bi-display"></i></div>
												<div class="float-left my-3">
													<div>
														<h6 class="mb-1">223.228.184.131</h6>
													</div>
													<div>
														Last accessed on 22 Feb 17:11
													</div>
													<div>
														<strong>Brave</strong>
														on
														<strong>Windows</strong>
													</div>
													<div>
														<strong>Signed in</strong>
														on 22 Feb 17:11
													</div>
												</div>
											</div>
											<div class="float-right">
												<a class="btn btn-danger btn-sm ms-3"><span
														class="sr-only">Revoke</span>Revoke</a>
											</div>
										</div>
									</li>
									<li class="list-group-item">
										<div class="d-flex align-items-center justify-content-between">
											<div class="d-flex align-items-center">
												<div class="mb-5 me-3 p-1" data-toggle="tooltip" title="Phone"><i
														class="bi bi-phone"></i></div>
												<div class="float-left my-3">
													<div>
														<h6 class="mb-1">137.212.56.223</h6>
													</div>
													<div>
														Last accessed on 23 Feb 13:32
													</div>
													<div>
														<strong>Chrome</strong>
														on
														<strong>Android</strong>
													</div>
													<div>
														<strong>Signed in</strong>
														on 23 Feb 13:32
													</div>
												</div>
											</div>
											<div class="float-right">
												<a class="btn btn-danger btn-sm ms-3"><span
														class="sr-only">Revoke</span>Revoke</a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://www.bootdey.com/cache-js/cache-1678916941-9f392a38a70f04980b0da6b3640a7a76.js"></script>
</div>