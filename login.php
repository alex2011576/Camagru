<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/register.php';
?>


<?php view('header_incognito', ['title' => 'Login']) ?>
<?php flash() ?>

<main class="">

  <div class="container-fluid logforms-container d-flex flex-column ">
    <!-- FORM-->
    <form class="form-container border border-light shadow px-5 mt-5 mb-2">
      <p class="logo-h2 fw-bolder text-center mt-5 pt-1 mb-5" style="width:inherit">Camagru</p>
      <div class="row mb-3">
        <div class="">
          <input type="text" class="form-control bg-light" placeholder="Username" aria-label="Username" aria-describedby="" autocomplete="on">
        </div>
      </div>
      <div class="row mb-3">
        <div class="">
          <input type="password" class="form-control bg-light" id="" placeholder="Password" aria-label="Password" autocomplete="on">
        </div>
      </div>
      <div class="d-grid mb-4">
        <button class="btn btn-dark p-1" type="button">Submit</button>
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
          <a class="text-decoration-none fs-6" href="">Sign up</a>
        </span>
      </div>
    </form>
  </div>
</main>

<?php view('footer') ?>