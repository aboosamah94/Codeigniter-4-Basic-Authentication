<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Profile
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Profile</h1>

<div class="col-12">
<?php if ($user->profile_image): ?>
    

    <img src="<?= base_url('uploads/profile_images/' .$user->profile_image) ?>" width="200" height="200" alt="profile image">


    <a href="<?= base_url('dashboard/profile/profileimage/delete'); ?>" onclick="return confirm('Are you sure?');">Delete
        profile image</a>

<?php else: ?>

    <img src="<?= base_url('uploads/profile_images/blank_profile.png') ?>" width="200" height="200" alt="profile image">

<?php endif; ?>

</div>



<dl>
    <dt>Name</dt>
    <dd>
        <?= esc($user->name) ?>
    </dd>

    <dt>email</dt>
    <dd>
        <?= esc($user->email) ?>
    </dd>
</dl>

<a href="<?= base_url('dashboard/profile/edit') ?>">Edit</a>
<a href="<?= base_url('dashboard/profile/profileimage/edit') ?>">Edit Image</a>
<a href="<?= base_url('dashboard/profile/editpassword') ?>">Change Password</a>

<?= $this->endSection() ?>