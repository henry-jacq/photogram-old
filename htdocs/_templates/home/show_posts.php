<div class="container p-3 mb-5">
    <div class="row g-3" id="masonry-area">
        <? 
        use Carbon\Carbon;
        
        if (Session::currentScript() == "profile") {
            $posts = Post::getUserPosts(Session::getUser()->getUsername());
        } else {
            $posts = Post::getAllPosts();
        }

        // If no posts are uploaded, print this message.
        if (empty($posts)) {
            ?><p class="text-muted text-center align-items-center">Memories are Unavailable. Try to upload new one.</p><?
        }

        foreach ($posts as $post){ 
            $p = new Post($post['id']);
            $uploaded_time = Carbon::parse($p->getUploadedTime());
            $uploaded_time_str = $uploaded_time->diffForHumans();
        ?>
        <div class="col-lg-3" id="post-<?=$post['id']?>">
            <div class="card shadow-lg">
                <? if(Session::isAuthenticated()) { ?>
                    <header class="card-header p-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <!-- Avatar -->
                                <div class="avatar avatar-story me-2">
                                    <a href="#" class="d-block link-dark text-decoration-none" aria-expanded="false">
                                        <img class="avatar-img rounded-circle" src="https://api.dicebear.com/5.x/identicon/svg?seed=<?=ucfirst($p->getOwner())?>" width="35" height="35"></a>
                                </div>
                                <!-- Info -->
                                <div>
                                    <div class="nav nav-divider">
                                        
                                        <? if (Session::isOwnerOf($p->getOwner())) { ?>
                                            <h7 class="nav-item card-title mb-0"> <a href="#!" class="text-decoration-none" style="color: var(--bs-dark-text)"><?=ucfirst($p->getOwner());?></a></h7>
                                        <? } else { ?>
                                            <h7 class="nav-item card-title mb-0"> <a href="#!" class="text-decoration-none" style="color: var(--bs-dark-text)"><?=ucfirst($p->getOwner());?></a></h7>
                                        <? } ?>

                                        <div class="ms-1 align-items-center justify-content-between">
                                            <span class="nav-item small fw-light"> • <?=$uploaded_time_str?></span>
                                        </div>
                                    </div>
                                    <p class="mb-0 small fw-light">Web Developer</p>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2"
                                    id="cardFeedAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </a>
                                <!-- Card feed action dropdown menu -->
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardFeedAction1">
                                    <li onclick="dialog('Not Implemented!',' This feature is not implemented');"><a class="dropdown-item" href="#"> <i class="bi bi-download fa-fw pe-2"></i>Download</a></li>
                                    <li onclick="dialog('Not Implemented!',' This feature is not implemented');"><a class="dropdown-item" href="#"> <i class="bi bi-link-45deg fa-fw pe-2"></i>Copy link</a></li>
                                    <li onclick="dialog('Not Implemented!',' This feature is not implemented');"><a class="dropdown-item" href="#"> <i class="bi bi-bookmark fa-fw pe-2"></i>Bookmark</a></li>
                                    <? if (Session::isOwnerOf($p->getOwner())) { ?>
                                        <li onclick="dialog('Not Implemented!',' This feature is not implemented');"><a class="dropdown-item" href="#"> <i class="bi bi-pencil fa-fw pe-2"></i>Edit post</a></li>
                                        <!-- <li><a class="dropdown-item" href="#"> <i class="bi bi-archive fa-fw pe-2"></i>Archive post</a></li> -->
                                        
                                        <? if (Session::isOwnerOf($p->getOwner())) { ?>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li data-id="<?=$post['id']?>"><a class="dropdown-item btn btn-delete"><i class="bi bi-trash fa-fw pe-2 text-danger"></i> Delete</a></li>
                                        <? } ?>
                                        
                                        
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                    </header>
                <? } ?>
                <img src="<?=$p->getImageUri()?>">
                <div class="card-body" style="background-color: #2a2d2e;">
                    <p class="card-text"><?=$p->getPostText()?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- <div class="btn-group p-2"> -->
                                
                            <? if (!Session::isAuthenticated()) { ?>
                                <button type="button" class="btn btn-sm btn-outline-primary btn-like" onclick="dialog('Login Now!',' Login to photogram to view and like the post.');"><i class="fa-regular fa-heart"></i> Like</button>
                            <? } else { ?>
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-like" onclick="dialog('Not Implemented!',' This feature is not implemented');"><i class="fa-regular fa-heart"></i> Like</button>
                            <? } ?>

                            <!-- <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-paper-plane"></i> Share</button> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    <? } ?>
    </div>
</div>