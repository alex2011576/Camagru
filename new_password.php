<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/login.php';
?>


<?php view('header_incognito', ['title' => 'Reset Password']) ?>
<!-- <?php flash() ?> -->

<main class="">
    <div class="container-fluid logforms-container d-flex flex-column ">
        <!-- FORM-->
        <form class="form-container border border-light shadow px-5 mt-5 mb-2" action="reset_pass.php" method="post">
            <p class="logo-h2 fw-bolder text-center mt-3 pt-1 mb-2" style="width:inherit">Camagru</p>
            <p class="text text-center fs-5 fw-bold px-2" style="width: inherit">
                Set New Password
            </p>
            <p class="text-muted text-start px-0" style="width: inherit">
                Your password must be at least 8 characters long, contain
                uppercase and lowercase letters, numbers and at least one
                special character.
            </p>
            <div class="row mb-3">
                <div class="">
                    <input name="password" type="password" class="form-control bg-light" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}" placeholder="New Password" aria-label="new-password" aria-describedby="passHel" autocomplete="on" value="<?= $inputs['password'] ?? '' ?>" required />
                    <small class="text-danger"><?= $errors['password'] ?? '' ?></small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input name="password2" type="password" class="form-control bg-light" placeholder="Confirm New Password" aria-label="confirm-password" aria-describedby="cpassHelp" autocomplete="on" value="<?= $inputs['password2'] ?? '' ?>" required />
                    <div id="cpassHelp" class="form-text"></div>
                </div>
                <small class="text-danger"><?= $errors['password2'] ?? '' ?></small>
            </div>
            <div class="d-grid mb-4">
                <button class="btn btn-dark p-1" type="submit">Submit</button>
            </div>
        </form>
    </div>
</main>

<?php view('footer') ?>