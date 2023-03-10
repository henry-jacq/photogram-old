<div class="container p-5">
    <h3 class="fw-light">Profile Page</h3>
    <hr class="py-3">
    <div class="row">
        <div class="col-md-4 text-center align-middle">
            <img src="https://api.dicebear.com/5.x/identicon/svg?seed=<?= ucfirst(Session::getUser()->getUsername()) ?>" class="img-fluid border rounded-circle mb-3" alt="Profile Picture" width="175" height="175">
            <h2 class="fw-normal fs-4"><?= ucfirst(Session::getUser()->getUsername()); ?></h2>
            <p>Web Developer</p>
            <button class="btn btn-sm btn-secondary" onclick="dialog('Not Implemented!',' This feature is not implemented');"><i class="bi bi-pencil me-2"></i>Change Profile</button>

            <div class="text-center mt-3">
                <p class="mt-5 fw-normal fs-5 mb-0">5</p>
                <p class="fw-light fs-5">My Posts</p>
            </div>
        </div>
        <div class="col-md-8">
            <ul class="list-group border-0 my-3">
                <li class="list-group-item border-0">Username<br><b>@<?= Session::getUser()->getUsername(); ?></b></li>
                <li class="list-group-item border-0">Phone number<br><b><?= Session::getUser()->getPhone(); ?></b></li>
                <li class="list-group-item border-0">Email address<br><b><?= Session::getUser()->getEmail() ?></b></li>
            </ul>
            <div class="container border p-3 rounded">
                <h5 class="fw-normal">About Me</h5>
                <p class="fw-light">#!/bin/bash<br>Full stack Developer<br>I convert caffeine into code.</p>
                <a class="text-decoration-none" href="https://github.com/henry-jacq/">Check Out my Github Page</a>.<br><br>
                <i>#IoT #electronics #hacking</i>
            </div>
        </div>
        <h3 class="fw-light py-3 mt-3">My Posts</h3>
        <hr class="p-4">
        <?= Session::loadTemplate('home/show_posts'); ?>
    </div>
</div>