<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Profile<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Profile</h1>

<dl>
    <dt>Name</dt>
    <dd><?= esc($user->name) ?></dd>
    
    <dt>email</dt>
    <dd><?= esc($user->email) ?></dd>
</dl>

<a href="<?= base_url('dashboard/profile/edit') ?>">Edit</a>
<a href="<?= base_url('dashboard/profile/editpassword') ?>">Change Password</a>

<?= $this->endSection() ?>