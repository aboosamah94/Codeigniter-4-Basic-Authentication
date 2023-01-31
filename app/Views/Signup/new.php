<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Signup
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Signup</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li>
                <?= $error; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open('signup/create'); ?>

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= old('name') ?>">
</div>

<div class="mb-3">
    <label for="email" class="form-label">email</label>
    <input type="text" class="form-control" name="email" id="email" value="<?= old('email') ?>">
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Repeat password</label>
    <input type="password" class="form-control" name="password_confirmation">
</div>

<button type="submit" class="btn btn-primary">Sign up</button>
<a href="<?= base_url(); ?>">Cancel</a>

<?= form_close() ?>

<?= $this->endSection() ?>