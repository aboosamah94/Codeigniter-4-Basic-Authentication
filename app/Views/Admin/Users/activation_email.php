<h1>Account activation for <?=$username;?></h1>
<h1>email <?=$useremail;?></h1>
<p>password: <?=$userpass;?></p>
<p><?= $is_active ? 'login' : 'call admin fo active' ?></p>
<p><a href="<?= base_url('login') ?>">login</a></p>