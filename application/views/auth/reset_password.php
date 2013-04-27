<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Reset Password &middot; Group 7</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="<?= base_url(); ?>public/css/styles.css" />
</head>
<body>
  <section id="login" class="border">
    <h1>Reset password</h1>
    <hr>
    <?php if(!empty($errors)): ?>
<ul class="error">
      <?= $errors; ?>
</ul>
    <?php endif; ?>
<form name="rpassword" method="post" action="<?= base_url() . 'reset-password/' . $code; ?>">
      <input name="new" type="password" placeholder="New Password (at least 8 characters long): " value=""/>
      <input name="new_confirm" type="password" placeholder="Confirm New Password:" />
      <?= form_input($user_id);?>
      <?= form_hidden($csrf); ?>
      <input type="submit" value="Change" />
    </form>
  </section>      
</body>
</html>