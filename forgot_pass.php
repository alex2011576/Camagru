<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/forgot_pass.php';
?>


<?php view('header_incognito', ['title' => 'Forgot Password']) ?>
<?php flash() ?>

<?php if (isset($errors['identifier'])) : ?>
    <div class="alert alert-danger">
        <?= $errors['identifier'] ?>
    </div>
<?php endif ?>


<main class="">
    <div class="container-fluid logforms-container d-flex flex-column ">
        <!-- FORM-->
        <form class="form-container border border-light shadow px-5 mt-5 mb-2" action="forgot_pass.php" method="post">
            <p class="logo-h2 fw-bolder text-center mt-3 pt-1 mb-2" style="width:inherit">Camagru</p>
            <p class="text text-center fs-5 fw-bold px-2" style="width: inherit">
                Trouble logging in?
            </p>
            <p class="text-muted text-start px-0" style="width: inherit">
                Enter your email or username and we'll send you a link to get back into your account.
            </p>
            <div class="row mb-3">
                <div class="">
                    <input type="text" name="identifier" class="form-control bg-light" maxlength="200" placeholder="Username or Email" aria-label="Username or Email"  autocomplete="on" value="<?= $inputs['identifier'] ?? '' ?>" required>
                </div>
                <small class="text-danger"><?= $errors['identifier'] ?? '' ?></small>
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