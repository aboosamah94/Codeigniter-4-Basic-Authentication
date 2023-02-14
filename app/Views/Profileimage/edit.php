<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit profile image
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit profile image</h1>

<?= form_open_multipart('dashboard/profile/profileimage/update') ?>

<div class="mb-3">
    <label for="image" class="form-label">File</label>
    <input type="file" class="form-control" name="image" id="image" />
</div>

<button type="submit" class="btn btn-primary">upload</button>
<a href="<?= base_url('dashboard/profile') ?>">Cancel</a>

<?= form_close() ?>

<?= $this->endSection() ?>