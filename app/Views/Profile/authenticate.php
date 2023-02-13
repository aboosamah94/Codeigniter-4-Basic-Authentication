<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit profile
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit profile</h1>

<p>Please enter your password to continue</p>

<?= form_open('dashboard/profile/processauthenticate') ?>

<div class="mb-3">
    <label for="password" class="form-label">Your password</label>
    <input type="password" class="form-control" name="password">
</div>

<button type="submit" class="btn btn-primary">send</button>
<a href="<?= base_url('dashboard/profile') ?>">Cancel</a>

<?= form_close() ?>

<?= $this->endSection() ?>