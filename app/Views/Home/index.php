<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Home
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Welcome</h1>

<?php if (current_user()): ?>

    <p>User is logged in</p>

    <p>Hello <?= esc(current_user()->name) ?></p>

<?php else: ?>

    <p>User is not logged in</p>

<?php endif; ?>

<?= $this->endSection() ?>