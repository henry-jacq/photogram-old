<?php

use App\Core\Session;
?>

<div class="container">
  	<div class="row">
  		<div class="col-lg-3">
  			<div class="card mb-2 border-0 m-0">
  				<div class="card-header border-0 bg-transparent">
  					<div class="d-none d-lg-inline-block w-100">
  						<h4 class="fs-5 fw-normal ms-3"><i class="bi bi-gear me-2"></i>Settings</h4>
  						<hr>
  					</div>
  					<ul class="nav nav-pills d-lg-block d-none" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  						<li class="nav-item">
  							<a class="nav-link active" id="account-tab" data-bs-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
  								<i class="fas fa-user me-2"></i>My Account
  							</a>
  						</li>
  						<li class="nav-item">
  							<a class="nav-link" id="emails-tab" data-bs-toggle="pill" href="#emails" role="tab" aria-controls="emails" aria-selected="false">
  								<i class="fas fa-envelope me-2"></i>Manage Email
  							</a>
  						</li>
  						<li class="nav-item">
  							<a class="nav-link" id="password-tab" data-bs-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
  								<i class="fas fa-lock me-2"></i>Change Password
  							</a>
  						</li>
  						<li class="nav-item">
  							<a class="nav-link" id="notifications-tab" data-bs-toggle="pill" href="#notifications" role="tab" aria-controls="notifications" aria-selected="false">
  								<i class="fas fa-bell me-2"></i>Notifications
  							</a>
  						</li>
  						<li class="nav-item">
  							<a class="nav-link" id="sessions-tab" data-bs-toggle="pill" href="#sessions" role="tab" aria-controls="sessions" aria-selected="false">
  								<i class="fas fa-desktop me-2"></i>Active Sessions
  							</a>
  						</li>
  					</ul>

  					<ul class="nav nav-tabs d-lg-none" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
  						<li class="nav-item">
  							<a class="nav-link active" id="account-tab" data-bs-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
  								<i class="fas fa-user"></i>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a class="nav-link" id="emails-tab" data-bs-toggle="pill" href="#emails" role="tab" aria-controls="emails" aria-selected="false">
  								<i class="fas fa-envelope"></i>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a class="nav-link" id="password-tab" data-bs-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
  								<i class="fas fa-lock"></i>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a class="nav-link" id="notifications-tab" data-bs-toggle="pill" href="#notifications" role="tab" aria-controls="notifications" aria-selected="false">
  								<i class="fas fa-bell"></i>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a class="nav-link" id="sessions-tab" data-bs-toggle="pill" href="#sessions" role="tab" aria-controls="sessions" aria-selected="false">
  								<i class="fas fa-desktop"></i>
  							</a>
  						</li>
  					</ul>
  				</div>
  			</div>
  		</div>

  		<div class="col-lg-9">
  			<div class="tab-content p-3" id="v-pills-tabContent">
  				<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
  					<div class="card">
  						<div class="card-body">
  							<h5 class="card-title">My Account</h5>
  							<hr>
  							<h6>Change username</h6>
  							<p class="card-text"></p>Changing your username can have unintended side effects.</p>
  							<form>
  								<div class="form-group input-group">
  									<span class="input-group-text">https://<?= $_SERVER['SERVER_NAME'] ?>/</span>
  									<input type="text" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Your Username">
  								</div>
  								<small id="usernameHelp" class="form-text text-muted">After changing your username, your old
  									username becomes available for anyone else to claim.</small>
  								<hr>
  								<form>
  									<div class="form-group">
  										<h6 class="d-block"><i class="fas fa-shield-halved"></i>
  											Two Factor Authentication
  										</h6>
  										<p class="small text-muted mt-2">Two-factor authentication adds an additional layer
  											of security to your account by requiring more than just a password to log in.
  										</p>
  										<p class="small mt-2">Status: <b class="badge bg-danger">Disabled</b></p>
  										<button class="btn btn-outline-primary" type="button"><i class="fas fa-shield-halved me-2"></i>Enable two-factor
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
  									<p>Before deleting your account, take a backup of your data <a href="#" class="text-decoration-none">here.</a></p>
  								</div>
  								<button class="btn btn-danger" type="button" onclick="dialog('Delete account?',' Are you sure want to delete your account ?');" id="delete-account-button"><i class="fa fa-trash me-2"></i>Delete Account</button>
  							</form>
  						</div>
  					</div>
  				</div>
  				<div class="tab-pane fade" id="emails" role="tabpanel" aria-labelledby="emails-tab">
  					<div class="card">
  						<div class="card-body">
  							<h5 class="card-title">Add Email</h5>
  							<hr>
  							<div class="mb-3">
  								<p class="text-muted">You can control emails linked to your account</p>
  							</div>
  							<!-- <h6>Add email address</h6> -->
  							<form>
  								<div class="form-group mb-3">
  									<label class="d-block mb-1">Add email address</label>
  									<input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email">
  								</div>
  								<button class="btn btn-primary">Add email address</button>
  							</form>
  						</div>
  					</div>
  				</div>
  				<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
  					<div class="card">
  						<div class="card-body">
  							<h5 class="card-title">Change Password</h5>
  							<hr>
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
  							<form class="" method="post" action="#">
  								<div class="mb-3">
  									<label for="currentPassword" class="form-label">Current password</label>
  									<input type="password" class="form-control" id="current-password" aria-describedby="passwordHelp" name="current-password" required autocomplete="">
  									<div id="passwordHelp" class="form-text">
  										You must provide your current password in order to change it.
  									</div>
  								</div>
  								<div class="mb-3">
  									<label for="new-password" class="form-label">New password</label>
  									<input type="password" class="form-control" id="new-password" name="new-password" required autocomplete="">
  								</div>
  								<div class="mb-3">
  									<label for="confirm-password" class="form-label">Confirm password</label>
  									<input type="password" class="form-control" id="confirm-password" name="password-confirm" required autocomplete="">
  								</div>
  								<div class="my-2">
  									<button type="submit" id="save-password" class="btn btn-primary" disabled>Change
  										password</button>
  									<a class="p-1 btn btn-link text-decoration-none float-end" rel=" nofollow" data-method="put" href="/-/profile/password/reset">
  										<span>I forgot my password</span>
  									</a>
  								</div>
  							</form>
  						</div>
  					</div>
  				</div>
  				<div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
  					<div class="card">
  						<div class="card-body">
  							<h5 class="card-title">Notifications</h5>
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
  										<option value="2"><?=Session::getUser()->getEmail()?></option>
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
  					</div>
  				</div>
  				<div class="tab-pane fade" id="sessions" role="tabpanel" aria-labelledby="sessions-tab">
  					<div class="card">
  						<div class="card-body">
  							<h5 class="card-title">Active Sessions</h5>
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
  													<div class="mb-5 me-3 p-1" data-toggle="tooltip" title="Desktop"><i class="bi bi-display"></i></div>
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
  													<a class="btn btn-danger btn-sm ms-3"><span class="sr-only">Revoke</span>Revoke</a>
  												</div>
  											</div>
  										</li>
  										<li class="list-group-item">
  											<div class="d-flex align-items-center justify-content-between">
  												<div class="d-flex align-items-center">
  													<div class="mb-5 me-3 p-1" data-toggle="tooltip" title="Phone"><i class="bi bi-phone"></i></div>
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
  													<a class="btn btn-danger btn-sm ms-3"><span class="sr-only">Revoke</span>Revoke</a>
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
  	</div>
</div>