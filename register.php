<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/register.php';
?>


<?php view('header_incognito', ['title' => 'Register']) ?>
<?php flash() ?>
<main class="">
    <div class="container-fluid logforms-container d-flex flex-column">
        <!-- FORM-->
        <form action="" method="post" class="form-container border border-light shadow px-5 mt-5 mb-2">
            <p class="logo-h2 fw-bolder text-center mt-5 pt-1 mb-1" style="width: inherit">
                Camagru
            </p>
            <p class="text-muted text-center px-2" style="width: inherit">
                Sign up to see photos and videos from your friends.
            </p>
            <div class="row mb-3">
                <div class="">
                    <input name="email" type="email" class="form-control bg-light" placeholder="Email" aria-label="Email" aria-describedby="" autocomplete="on" value="<?= $inputs['email'] ?? '' ?>" required />
                </div>
                <small class="text-danger"><?= $errors['email'] ?? '' ?></small>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input name="username" type="text" class="form-control bg-light" title="Username should be 3-15 characters, no spaces allowed." pattern="^(?!.*\s)(\w|\W){3,15}$" placeholder="Username" aria-label="Username" aria-describedby="" autocomplete="on" value="<?= $inputs['username'] ?? '' ?>" required />
                </div>
                <small class="text-danger"><?= $errors['username'] ?? '' ?></small>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input name="password" type="password" class="form-control bg-light" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}" placeholder="Password" aria-label="new-password" aria-describedby="passHel" autocomplete="on" value="<?= $inputs['password'] ?? '' ?>" required />
                    <small id="passHelp" class="form-text <?= error_class($errors, 'username') ?>">
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
                <button class="btn btn-dark p-1" type="submit">Next</button>
            </div>
        </form>

        <!-- Sihn UP -->
        <form action="login.php" class="form-container border border-light shadow px-5 mt-2 mb-5">
            <div class="form-footer text-center my-2">
                <span>
                    Have an account?
                    <a class="text-decoration-none fs-6" href="login.php">Log in</a>
                </span>
            </div>
        </form>
    </div>
</main>

<?php view('footer') ?>