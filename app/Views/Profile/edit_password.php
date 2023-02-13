<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit password
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit password</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li>
                <?= $error ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

<?= form_open('dashboard/profile/updatepassword') ?>

<div class="mb-3">
    <label for="current_password" class="form-label">Current password</label>
    <input type="password" class="form-control" name="current_password">
</div>

<div class="mb-3">
    <label for="password" class="form-label">New password</label>
    <input type="password" class="form-control" name="password">
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Repeat New password</label>
    <input type="password" class="form-control" name="password_confirmation">
</div>

<button type="submit" class="btn btn-primary">save</button>
<a href="<?= base_url('dashboard/profile') ?>">Cancel</a>

<?= form_close() ?>

<?= $this->endSection() ?>