<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>title &middot; Group 7</title>
  <script src="<?php echo $this->config->base_url() . '/public/js/libs/pack.js' ?>"></script>
  <script src="<?php echo $this->config->base_url() . '/public/js/libs/d3.js' ?>"></script>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>public/css/styles.css" />
</head>
<body>
  <div class="wrapper">
    <header role="banner">
      <div id="logo"><a href="#">logo</a></div>
      <nav role="navigation">
        <ul>
          <li><a href="<?php echo $this->config->base_url() . 'dashboard/'?>">Dashboard</a></li>
          <li><a href="<?php echo $this->config->base_url() . 'settings/'?>">Settings</a></li>
        </ul>
      </nav>
    </header>
    <div id="main" role="main">
      <section>
