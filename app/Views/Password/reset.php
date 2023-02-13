<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Password reset
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Password reset</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach (session('errors') as $error): ?>
            <li>
                <?= $error ?>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

<?= form_open('password/processReset/' . $token); ?>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
</div>


<div class="mb-3">
    <label for="password_confirmation" class="form-label">Repeat password</label>
    <input type="password" class="form-control" name="password_confirmation">
</div>

<button type="submit" class="btn btn-primary">Send</button>

<?= form_close() ?>


<?= $this->endSection() ?>