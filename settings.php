<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/settings.php';
?>

<?php view('header_logged', ['title' => 'Settings']) ?>
<?php flash() ?>

<main class="">

    <div class="container-fluid forms-container d-flex flex-column ">
        <!-- Notification settings -->
        <form class="form-container border border-light shadow-sm  px-4 py-3 mt-3 mb-2">
            <p class="h5 text-center fw-normal my-2">Notifications Settings</p>
            <div class="d-grid pt-3 pb-2">
                <button class="btn btn-secondary" type="button">Unsubscribe</button>
            </div>
            <div class="d-grid pt-3 pb-2">
                <button class="btn btn-dark" type="button">Subscribe</button>
            </div>
        </form>
        <!-- Change Email-->
        <form class="form-container border border-light shadow-sm  px-4 py-3 my-2">
            <p class="h5 text-center fw-normal mt-2 mb-3">Change Email</p>
            <div class="row mb-3">
                <!-- <label for="" class="col-form-label">New Email</label> -->
                <div class="">
                    <input type="email" name="new_email" autocomplete="on" class="form-control bg-light" placeholder="New email" aria-label="New Email">
                </div>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input type="password" name="password" autocomplete="on" class="form-control bg-light" placeholder="Password" aria-label="Password">
                </div>

            </div>
            <div class="d-grid pt-2 pb-2">
                <button class="btn btn-dark p-1" value="change_email" type="submit">Submit</button>
            </div>
        </form>
        <!-- Change Username -->
        <form class="form-container border border-light shadow-sm  px-4 py-3 my-2">
            <p class="h5 text-center fw-normal mt-2 mb-3">Change Username</p>
            <div class="row mb-3">
                <div class="">
                    <input type="text" name="new_username" class="form-control bg-light" placeholder="New Username" aria-label="New Username" aria-describedby="">
                </div>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input type="password" autocomplete="on" class="form-control bg-light" placeholder="Password" aria-label="Add comment">
                </div>
            </div>
            <div class="d-grid pt-2 pb-2">
                <button class="btn btn-dark p-1" value="change_username" type="submit">Submit</button>
            </div>
        </form>
        <!-- Change Password -->
        <form class="form-container border border-light shadow-sm  px-4 py-3 my-2">
            <p class="h5 text-center fw-normal mt-2 mb-3">Change Password</p>
            <div class="row mb-3">
                <div class="">
                    <input type="password" name="password" autocomplete="on" class="form-control bg-light" placeholder="Old Password" aria-label="Old Password" aria-describedby="">
                </div>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input type="password" name="new_password" autocomplete="on" class="form-control bg-light" placeholder="New Password" aria-label="New Password" aria-describedby="">
                </div>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input type="password" name="new_password2" autocomplete="on" class="form-control bg-light" placeholder="Confirm New Password" aria-label="Confirm New Password">
                </div>
            </div>
            <div class="d-grid pt-2 pb-2">
                <button class="btn btn-dark p-1" value="change_password" type="submit">Submit</button>
            </div>
        </form>
        <!-- Delete Account -->
        <form class="form-container border border-light shadow-sm  px-4 py-3 my-2">
            <p class="h5 text-center fw-normal mt-2 mb-3">Delete Account</p>
            <div class="row mb-3">
                <div class="">
                    <input type="password" class="form-control bg-light" placeholder="Confirm With Password" aria-label="Confirm With Password" aria-describedby="" autocomplete="on">
                </div>
            </div>
            <div class="d-grid pt-2 pb-2">
                <button class="btn btn-danger p-1" value="delete_account" type="submit">Submit</button>
            </div>
        </form>
    </div>
</main>