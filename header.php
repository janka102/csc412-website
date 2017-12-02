<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?= $title ? ($title . ' | ') : '' ?>jsmick</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <base href="/~jsmick/">

  <?php
  $all_css = array_merge(array('bootstrap.min.css', 'main.css'), $css);

  for ($file=0; $file < count($all_css); $file++) { ?>
    <link rel="stylesheet" href="<?= $base_url ?>css/<?= $all_css[$file] ?>">
  <?php } ?>
</head>

<?php
  function nav_item($href, $title, $active) {
    echo('<li class="nav-item' . ($active ? ' active' : '') . '">');
    echo('<a class="nav-link" href="' . $href . '">' . $title . '</a></li>' . "\n");
  }
?>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="."><img src="<?= $base_url ?>708dc88ce629f35288eaa787b46f9f63.jpeg" alt="jsmick"></a>
    <label class="btn btn-dark navbar-toggler" for="navbarNav" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </label>
    <input type="checkbox" id="navbarNav" class="navbar-collapse-input">
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <?php nav_item('about.php', 'About', $page == 'about') ?>
        <?php nav_item('current.php', 'Current Work', $page == 'current') ?>
        <?php nav_item('visitor.php', 'Visitors', $page == 'visitor') ?>
        <?php nav_item('quotes.php', 'Quotes', $page == 'quotes') ?>
        <?php nav_item('place', 'r/place', $page == 'place') ?>
      </ul>
      <button id="background-random" class="icon-dice btn btn-outline-success" title="Random nav color"></button>
    </div>
  </nav>

  <main role="main" class="container">
