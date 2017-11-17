<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?= $title ? ($title . ' | ') : '' ?>jsmick</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php $all_css = array_merge(array('bootstrap.min.css', 'site.css'), $css) ?>

  <?php for ($file=0; $file < count($all_css); $file++) { ?>
    <link rel="stylesheet" href="css/<?= $all_css[$file] ?>">
  <?php } ?>
</head>

<?php
  function nav_item($href, $title, $active) {
    echo('<li class="nav-item');

    if ($active) {
      echo(' active');
    }

    echo('"><a class="nav-link" href="' . $href . '">' . $title . '</a></li>' . "\n");
  }
?>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <?php nav_item('.', 'Home', $page == 'index') ?>
        <?php nav_item('about.php', 'About', $page == 'about') ?>
        <?php nav_item('current.php', 'Current Work', $page == 'current') ?>

        <li class="nav-random"><button id="background-random" class="icon-dice btn btn-success" title="Random nav color"></button></li>
      </ul>
    </div>
  </nav>

  <main role="main" class="container">