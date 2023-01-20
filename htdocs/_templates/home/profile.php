<div class="border-bottom border-secondary shadow-lg">
    <div class="container p-5">
        <h3 class="text-light">Your Profile</h3>
        <hr class="hr text-light p-4">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="/assets/brand/pic.jpg" class="img-fluid rounded-circle mb-3" alt="Profile Picture" width="200" height="200">
                <h2 class="text-light"><?=ucfirst(Session::getUser()->getUsername());?></h2>
                <p class="text-muted">Web Developer</p>
                <button class="btn btn-sm btn-dracula" onclick="dialog('Not Implemented!',' This feature is not implemented');">Change profile icon</button>
            </div>
            <div class="col-md-8">
                <ul class="list-group border-0 my-3">
                    <li class="list-group-item bg-dark text-light border-0">Username<br><b>@<?=Session::getUser()->getUsername();?></b></li>
                    <li class="list-group-item bg-dark text-light border-0">Phone number<br><b><?=Session::getUser()->getPhone();?></b></li>
                    <li class="list-group-item bg-dark text-light border-0">Email address<br><b><?=Session::getUser()->getEmail()?></b></li>
                </ul>
                <div class="card my-3 border-0">
                    <div class="card-body text-bg-dark">
                        <h5 class="card-title text-muted">About Me</h5>
                        <p class="card-text fw-light">#!/bin/bash<br>Full stack Developer<br>I convert caffeine into code.</p>
                        <a class="text-decoration-none" href="https://github.com/henry-jacq/">Check Out my Github Page</a>.<br><br>
                        <i class="text-primary">#IoT #electronics #hacking</i>
                    </div>
                </div>
                <i class="text-bg-dark">You can edit your details in <a href="#" class="text-decoration-none">Here</a>.</i>
            </div>
            <h3 class="text-light my-3">Your Posts</h3>
            <hr class="hr text-light p-4">
            <?=Session::loadTemplate('home/show_posts');?>
        </div>
    </div>
</div>