<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $title ?? 'Camagru' ?></title>
  <link href="static/icon.ico" rel="icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
  <link href="static/style1.css" rel="stylesheet" type="text/css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Molle&family=Righteous&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
  <script type="text/javascript" src="/camagru/mine/static/view_actions.js"></script>
</head>

<body>
  <!-- Header NOT Logged in -->
  <header class="navbar sticky-top shadow-sm bg-light">
    <nav class="container-fluid">
      <a class="navbar-brand" href="feed.php">
        <h1 class="fs-2 fw-bolder pt-2 ps-lg-3">Camagru</h1>
      </a>
      <ul class="nav px-0 justify-content-end flex-nowrap">
        <li class="nav-item">
          <a class="btn btn-outline-dark me-2 fs-6 border-0 mt-sm-1" href="login.php" role="button" style="
                --bs-btn-padding-y: 0.25rem;
                --bs-btn-padding-x: 0.5rem;
                --bs-btn-font-size: 0.75rem;
              ">Log In</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-dark me-2 fs-6 border-0 mt-sm-1" href="register.php" role="button" style="
                --bs-btn-padding-y: 0.25rem;
                --bs-btn-padding-x: 0.5rem;
                --bs-btn-font-size: 0.75rem;
              ">Register</a>
        </li>
      </ul>
    </nav>
  </header>