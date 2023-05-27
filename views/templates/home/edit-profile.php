<div class="container rounded p-4">
    <div class="row border rounded-3">
        <div class="col-lg-3 bg-body-tertiary rounded-3 py-5">
            <div class="d-flex flex-column align-items-center text-center p-3 mt-3">
                <img class="rounded-circle" width="150" src="/assets/default-user-big.jpg">
                <span class="fs-5 fw-bold mt-3">Henry</span>
                <span class="fs-6">henry@gmail.com</span>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="px-3 mt-4">
                <h4 class="fw-normal">Edit Profile</h4>
                <hr>
            </div>
            <form class="p-3" novalidate="" autocomplete="off">
                <div class="form-group mb-3 row">
                    <div class="col">
                        <label for="fname" class="form-label fw-semibold">Firstname</label>
                        <input type="text" id="fname" class="form-control" placeholder="First name" aria-label="First name">
                    </div>
                    <div class="col">
                        <label for="lname" class="form-label fw-semibold">Lastname</label>
                        <input type="text" id="lname" class="form-control" placeholder="Last name" aria-label="Last name">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input id="email" class="form-control" type="text" placeholder="Email">
                </div>
                <div class="form-group mb-3">
                    <label for="job" class="form-label fw-semibold">Job</label>
                    <select id="job" class="form-select" aria-label="Default select example">
                        <option selected>None</option>
                        <option value="1">App Developer</option>
                        <option value="2">Content Creator</option>
                        <option value="3">Photographer</option>
                        <option value="4">Software Engineer</option>
                        <option value="5">Student</option>
                        <option value="6">UI/UX Designer</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">Bio</label>
                    <textarea class="form-control" rows="3" placeholder="Write about you..."></textarea>
                    <p class="form-text mb-0">Tell us about yourself in fewer than 250 characters.</p>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">Location</label>
                    <input class="form-control" type="text" placeholder="City, Country">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">Twitter</label>
                    <input class="form-control" type="text" placeholder="@username">
                </div>
                <div class="form-group mb-5">
                    <label class="form-label fw-medium">Instagram</label>
                    <input class="form-control" type="text" placeholder="username">
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-start">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>