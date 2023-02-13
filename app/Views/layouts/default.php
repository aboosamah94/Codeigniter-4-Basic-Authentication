<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>
    <?= $this->renderSection("title") ?>
  </title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url(); ?>">Auth App<?php if (current_user()): ?> / Hello: <?=
              esc(current_user()->name) ?><?php endif; ?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Home</a>
          </li>

          <?php if (current_user()): ?>

            <?php if (current_user()->is_admin): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard/users'); ?>">Users</a>
              </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard/profile'); ?>">Profile</a>
              </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('logout'); ?>">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('login'); ?>">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('signup'); ?>">Signup</a>
            </li>
          <?php endif; ?>

        </ul>
      </div>
    </div>
  </nav>

  <div class="container p-4">
    <div class="row">

      <?php if (session()->has('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?= session('warning'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <?php if (session()->has('info')): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <?= session('info'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <?php if (session()->has('error')): ?>
        <div class="alert alert-error alert-dismissible fade show" role="alert">
          <?= session('error'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <?= $this->renderSection("content") ?>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>