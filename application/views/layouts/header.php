<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= $title; ?> &middot; Group 7</title>
  <script src="<?= base_url() . '/public/js/libs/pack.js' ?>"></script>
  <script src="<?= base_url() . '/public/js/libs/d3.js' ?>"></script>
  <script src="<?= base_url() . '/public/js/libs/underscore-min.js' ?>"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_XDIuyANwbDmupuR-sFVYSTmiydhiQLE&sensor=false"></script>
  <script src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1","packages":["corechart","table"]}]}'></script>
  <script src="<?= base_url() . '/public/js/gcharts/pieChart.js' ?>"></script>
  <script src="<?= base_url() . '/public/js/gcharts/lineChart.js' ?>"></script>
  <script src="<?= base_url() . '/public/js/gcharts/barChart.js' ?>"></script>
  <script src="<?= base_url() . '/public/js/gcharts/columnChart.js' ?>"></script>
  <script src="<?= base_url() . '/public/js/gcharts/scatterChart.js' ?>"></script>
  <script src="<?= base_url() . '/public/js/gcharts/steppedAreaChart.js' ?>"></script>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="<?= base_url(); ?>public/css/styles.css" />
</head>
<body>
  <div class="wrapper">
    <header role="banner">
      <div id="logo"><a href="<?= base_url() . 'dashboard/'; ?>">G7</a></div>
      <nav role="navigation">
        <ul>
          <li><a href="<?= base_url() . 'dashboard/'?>">Dashboard</a></li>
          <li><a href="<?= base_url() . 'settings/'?>">Settings</a></li>
          <li><a href="<?= base_url() . 'auth/logout/'?>">Sign out</a></li>
        </ul>
      </nav>
    </header>
    <div id="main" role="main">
      <section>
