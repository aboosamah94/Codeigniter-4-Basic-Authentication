<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Forgot password
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Forgot password</h1>

<?= form_open('password/processForgot'); ?>

<div class="mb-3">
    <label for="email" class="form-label">email</label>
    <input type="text" class="form-control" name="email" id="email" value="<?= old('email') ?>">
</div>

<button type="submit" class="btn btn-primary">Send</button>
<a href="<?= base_url('login'); ?>">Login</a>

<?= form_close() ?>

<?= $this->endSection() ?>