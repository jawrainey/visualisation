<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login &middot; Group 7</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="<?= $this->config->base_url(); ?>public/css/styles.css" />
</head>
<body>
  <section id="login" class="border">
    <h1>Analyser Login</h1>
    <hr>
<?php echo validation_errors(); ?>
    <form name="login" method="post" action="<?= $this->config->base_url(); ?>">
      <input name="username" type="text" placeholder="Enter your username" value=""/>
      <input name="password" type="password" placeholder="Enter your password" />
      <input type="submit" value="Login" />
    </form>
    <div id="forgot">
      <a href="<?= $this->config->base_url() . 'login/password/'; ?>">Forgot your password?</a>
    </div>
  </section>      
</body>
</html>
