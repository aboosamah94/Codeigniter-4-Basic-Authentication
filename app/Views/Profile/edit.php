<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit profile
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit profile</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li>
                <?= $error ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

<?= form_open('dashboard/profile/update') ?>

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= old('name', esc($user->name)) ?>">
</div>

<div class="mb-3">
    <label for="email" class="form-label">email</label>
    <input type="text" class="form-control" name="email" id="email" value="<?= old('email', esc($user->email)) ?>">
</div>

<button type="submit" class="btn btn-primary">save</button>
<a href="<?= base_url('dashboard/profile') ?>">Cancel</a>

<?= form_close() ?>


<?= $this->endSection() ?>