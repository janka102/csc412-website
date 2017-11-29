<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?= $title ? ($title . ' | ') : '' ?>jsmick</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php $all_css = array_merge(array('bootstrap.min.css', 'main.css'), $css) ?>

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
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="."><img src="708dc88ce629f35288eaa787b46f9f63.jpeg" alt="jsmick"></a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <?php nav_item('about.php', 'About', $page == 'about') ?>
        <?php nav_item('current.php', 'Current Work', $page == 'current') ?>
        <?php nav_item('visitor.php', 'Visitors', $page == 'visitor') ?>
        <?php nav_item('quotes.php', 'Quotes', $page == 'quotes') ?>
      </ul>
      <button id="background-random" class="icon-dice btn btn-outline-success" title="Random nav color"></button>
    </div>
  </nav>

  <main role="main" class="container">