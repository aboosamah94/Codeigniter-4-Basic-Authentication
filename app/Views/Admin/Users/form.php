<div class="mb-3">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= old('name', esc($user->name)) ?>">
</div>

<div class="mb-3">
    <label for="email">email</label>
    <input type="text" class="form-control" name="email" id="email" value="<?= old('email', esc($user->email)) ?>">
</div>

<div class="mb-3">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password">
    <?php if ($user->id): ?>
        <p>Leave blank to keep existing password</p>
    <?php endif; ?>
</div>

<div class="mb-3">
    <label for="password_confirmation">Repeat password</label>
    <input type="password" class="form-control" name="password_confirmation">
</div>

<div class="mb-3">
    <label for="is_active">
        <?php if ($user->id == current_user()->id): ?>
            <input type="checkbox" checked disabled> active
            
        <?php else: ?>
        
            <input type="hidden" name="is_active" value="0">
            
            <input type="checkbox" class="form-check-label" id="is_active" name="is_active" value="1"
                    <?php if (old('is_active', $user->is_active)): ?>checked<?php endif; ?>> active
        <?php endif; ?>
    </label>
</div>

<div class="mb-3">
    <label for="is_admin">
    <?php if ($user->id == current_user()->id): ?>
            <input type="checkbox" checked disabled> administrator
        <?php else: ?>
            <input type="hidden" name="is_admin" value="0">
            <input type="checkbox" class="form-check-label" id="is_admin" name="is_admin" value="1"
                <?php if (old('is_admin', $user->is_admin)): ?>checked<?php endif; ?>> administrator
        <?php endif; ?>
    </label>
</div>