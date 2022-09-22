<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/login.php';
?>


<?php view('header_incognito', ['title' => 'Login']) ?>
<!-- <?php flash() ?> -->

<?php if (isset($errors['login'])) : ?>
  <div class="alert alert-danger">
    <?= $errors['login'] ?>
  </div>
<?php endif ?>

<main class="">
  <div class="container-fluid logforms-container d-flex flex-column ">
    <!-- FORM-->
    <form class="form-container border border-light shadow px-5 mt-5 mb-2" action="login.php" method="post">
      <p class="logo-h2 fw-bolder text-center mt-5 pt-1 mb-5" style="width:inherit">Camagru</p>
      <div class="row mb-3">
        <div class="">
          <input type="text" name="username" class="form-control bg-light" placeholder="Username" aria-label="Username" aria-describedby="" autocomplete="on" value="<?= $inputs['username'] ?? '' ?>" required>
        </div>
        <small class="text-danger"><?= $errors['username'] ?? '' ?></small>
      </div>
      <div class="row mb-3">
        <div class="">
          <input type="password" name="password" class="form-control bg-light" id="" placeholder="Password" aria-label="Password" autocomplete="on" required>
        </div>
        <small class="text-danger"><?= $errors['password'] ?? '' ?></small>
      </div>
      <div class="d-grid mb-4">
        <button class="btn btn-dark p-1" type="submit">Submit</button>
      </div>
      <div class="separator d-flex flex-row mb-3">
        <div class="line"></div>
        <div class="or">OR</div>
        <div class="line"></div>
      </div>
      <div class="form-footer text-center mb-4">
        <a class="text-decoration-none fs-6" href="">Forgot password?</a>
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