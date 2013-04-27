<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Forgot password &middot; Group 7</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="<?= base_url(); ?>public/css/styles.css" />
</head>
<body>
  <section id="login" class="border">
    <h1>Forgot Password</h1>
    <p>Enter your email address below and we can send you an email to reset your password.</p>
    <hr>
    <?php if(!empty($errors)): ?>
<ul class="error">
      <?= $errors; ?>
</ul>
    <?php endif; ?>
<form name="fpassword" method="post" action="<?= base_url() . 'forgot-password/'; ?>">
      <input name="email" type="text" placeholder="Enter your email address." value=""/>
      <input type="submit" value="Submit" />
    </form>
  </section>   
</body>
</html>
