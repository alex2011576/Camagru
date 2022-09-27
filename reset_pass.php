<?php
require __DIR__ . '/src/bootstrap.php';
//require __DIR__ . '/src/reset_pass.php';
?>


<?php view('header_incognito', ['title' => 'Forgot Password']) ?>
<!-- <?php flash() ?> -->

<main class="">
    <div class="container-fluid logforms-container d-flex flex-column ">
        <!-- FORM-->
        <form class="form-container border border-light shadow px-5 mt-5 mb-2" action="reset_pass.php" method="post">
            <p class="logo-h2 fw-bolder text-center mt-3 pt-1 mb-2" style="width:inherit">Camagru</p>
            <p class="text text-center fs-5 fw-bold px-2" style="width: inherit">
                Reset Password
            </p>
            <p class="text-muted text-start px-0" style="width: inherit">
                Enter your email or username and we'll send you a link to get back into your account.
            </p>
            <div class="row mb-3">
                <div class="">
                    <input name="password" type="password" class="form-control bg-light" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}" placeholder="Password" aria-label="new-password" aria-describedby="passHel" autocomplete="on" value="<?= $inputs['password'] ?? '' ?>" required />
                    <small id="passHelp" class="form-text <?= error_class($errors, 'password') ?>">
                        Your password must be at least 8 characters long, contain
                        uppercase and lowercase letters, numbers and at least one
                        special character.
                    </small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input name="password2" type="password" class="form-control bg-light" placeholder="Confirm Password" aria-label="confirm-password" aria-describedby="cpassHelp" autocomplete="on" value="<?= $inputs['password2'] ?? '' ?>" required />
                    <div id="cpassHelp" class="form-text"></div>
                </div>
                <small class="text-danger"><?= $errors['password2'] ?? '' ?></small>
            </div>
            <div class="d-grid mb-4">
                <button class="btn btn-dark p-1" type="submit">Send Login Link</button>
            </div>
        </form>

        <!-- Sihn UP -->
        <form class="form-container border border-light shadow px-5 mt-2 mb-5">
            <div class="form-footer text-center my-2">
                <span> Don't have an account?
                    <a class="text-decoration-none fs-6" href="register.php">Sign up</a>
                </span>
            </div>
        </form>
    </div>
</main>

<?php view('footer') ?>