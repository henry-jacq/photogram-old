<?
if(isset($_FILES['post_image']) and isset($_POST['post_text'])){
    $image_tmp = $_FILES['post_image']['tmp_name'];
    $text = $_POST['post_text'];
    Post::registerPost($image_tmp, $text);
}
?>

<section class="py-3 text-center bg-dark">
    <div class="row py-lg-5">
        <div class="col-lg-7 col-md-8 mx-auto">
            <h1 class="display-6 text-light">What's on your mind, <?=strtolower(Session::getUser()->getUsername());?>?</h1>
            <p class="lead text-muted">Share a photo that talks about it</p>
            <form class="my-3" action="/" method="POST" enctype="multipart/form-data">
                <div class="mb-2">
                    <input class="form-control" accept="image/*" name="post_image" type="file" id="formFile" required>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="post_text" placeholder="Say something..." id="floatingTextarea2" style="height: 160px;"></textarea>
                    <label for="floatingTextarea2">Say something...</label>
                </div>
                <button type="submit" class="btn btn-success my-4"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Upload</button>
                <a class="btn btn-secondary my-2" onclick="dialog('Remove picture ?',' It removes the upload picture');">Remove</a>
            </form>

        </div>
    </div>
</section>