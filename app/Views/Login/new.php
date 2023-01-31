<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Login
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Login</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li>
                <?= $error; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open('login/create'); ?>

<div class="mb-3">
    <label for="email" class="form-label">email</label>
    <input type="text" class="form-control" name="email" id="email" value="<?= old('email') ?>">
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
</div>

<button type="submit" class="btn btn-primary">Login</button>
<a href="<?= base_url(); ?>">Cancel</a>

<?= form_close() ?>

<?= $this->endSection() ?>