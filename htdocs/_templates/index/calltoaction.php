<section class="py-3 text-center">
    <div class="row py-lg-5">
        <div class="col-lg-7 col-md-8 mx-auto">
            <? $userobj = new User(Session::get('session_UsernameOrEmail'));?>
            <h1 class="display-6 text-dark">What are you upto <?=strtolower($userobj->getUsername());?> ?</h1>
            <p class="lead text-muted">Share a photo that talks about it</p>
            <form class="my-3" action="#" method="POST" enctype="multipart/form-data">
                <div class="mb-2">
                    <input class="form-control" name="" type="file" id="formFile">
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="" placeholder="Write your description" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label class="text-black" for="floatingTextarea2">Write your Description</label>
                </div>
                <button type="submit" class="btn btn-success my-4">Share a Memory</button>
                <a href="" class="btn btn-secondary my-2">Remove</a>
            </form>
        </div>
    </div>
</section>