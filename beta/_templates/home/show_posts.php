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
            <div class="card shadow-lg border-0 text-light">
                <img src="<?=$p->getImageUri()?>">
                <div class="card-body" style="background-color: #2a2d2e;">
                    <?
                    if (Session::isAuthenticated()) {
                        if (Session::isOwnerOf($p->getOwner())) {
                            ?><p class="badge bg-secondary">@<?=lcfirst($p->getOwner());?></p><?
                        } else {
                            ?><p class="badge bg-secondary">@<?=lcfirst($p->getOwner());?></p><?
                        }
                    }
                    ?>
                    <p class="card-text"><?=$p->getPostText()?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group p-2" data-id="<?=$post['id']?>">
                                
                            <? if (!Session::isAuthenticated()) { ?>
                                <button type="button" class="btn btn-sm btn-outline-primary btn-like" onclick="dialog('Login Now!',' Login to photogram to view and like the post.');"><i class="fa-regular fa-heart"></i> Like</button>
                            <? } else { ?>
                                <button type="button" class="btn btn-sm btn-outline-primary btn-like" onclick="dialog('Not Implemented!',' This feature is not implemented');"><i class="fa-regular fa-heart"></i> Like</button>
                            <? } ?>

                            <!-- <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-paper-plane"></i> Share</button> -->
                            <? if (Session::isOwnerOf($p->getOwner())) { ?>
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete"><i class="fa-solid fa-trash"></i> Delete</button>
                            <? } ?>
                        </div>
                        <small class="text-muted"><?=$uploaded_time_str?></small>
                    </div>
                </div>
            </div>
        </div>
    <? } ?>
    </div>
</div>