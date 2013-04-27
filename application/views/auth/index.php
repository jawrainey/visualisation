<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login &middot; Group 7</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="<?= base_url(); ?>public/css/styles.css" />
</head>
<body>
  <section id="login" class="border">
    <h1>Analyser Login</h1>
    <hr>
    <?php if(!empty($errors)): ?>
<ul class="error">
      <?= $errors; ?>
</ul>
    <?php endif; ?>
<form name="login" method="post" action="<?= base_url(); ?>">
      <input name="identity" type="text" placeholder="Enter your username" value=""/>
      <input name="password" type="password" placeholder="Enter your password" />
      <div id="remember">
        <label for="remember" class="left">Keep me logged in:</label>
        <input type="checkbox" name="remember" value="1" class="right fright" />
      </div>
        <input type="submit" value="Login" />
    </form>
    <div id="forgot">
      <a href="<?= base_url() . 'forgot-password/'; ?>">Forgot your password?</a>
    </div>
  </section>      
</body>
</html>
