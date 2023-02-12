<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit user<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Edit user</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>


<?= form_open('dashboard/users/update/' . $user->id); ?>

    <?= $this->include('Admin/Users/form') ?>
    
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="<?= base_url('dashboard/users/ . $user->id') ?>">Cancel</a>

</form>

<?= $this->endSection() ?>