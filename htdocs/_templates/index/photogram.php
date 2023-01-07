<div class="album py-5 border-top border-bottom border-secondary shadow-lg" style="background-color: #242829;">
    <div class="container p-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <? for ($i=0; $i < 12; $i++) { ?>
            <div class="col">
                <div class="card shadow-lg border-0 text-light">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Picture</text>
                    </svg>

                    <div class="card-body"  style="background-color: #2a2d2e;">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional
                            content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group p-2">
                                <button type="button" class="btn btn-sm btn-outline-primary"><i class="fa-regular fa-heart"></i> Like</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-paper-plane"></i> Share</button>
                                <button type="button" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                            </div>
                            <small class="text-muted">5 mins ago</small>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
        </div>
    </div>
</div>
