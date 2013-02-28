<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login &middot; Group 7</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>public/css/styles.css" />
</head>
<body>
  <section id="login" class="border">
    <h1>Analyser Login</h1>
    <hr>
    <form name="login" method="post" action="#">
      <input name="username" type="text" placeholder="Enter your username" value=""/>
      <input name="password" type="password" placeholder="Enter your password" />
      <input type="submit" value="Login" />
    </form>
    <div id="forgot">
      <a href="<?php echo $this->config->base_url() . 'login/password/'; ?>">Forgot your password?</a>
    </div>
  </section>      
</body>
</html>
