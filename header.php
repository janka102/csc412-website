<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?= $title ? ($title . ' | ') : '' ?>jsmick</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <base href="/<?= $_SERVER['SERVER_PORT'] == 80 ? '~jsmick/' : '' ?>">

<?php
  $all_css = array_merge(array('bootstrap.min.css', 'main.css'), $css);

  foreach ($all_css as $css_file) {
    echo "  <link rel=\"stylesheet\" href=\"css/$css_file\">\n";
  }

  function nav_item($href, $nav_title) {
    global $title;
    echo '<li class="nav-item', ($title == $nav_title ? ' active' : ''), '">';
    echo "<a class=\"nav-link\" href=\"$href\">$nav_title</a></li>\n";
  }
?>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="."><img src="708dc88ce629f35288eaa787b46f9f63.jpeg" alt="jsmick"></a>
    <label class="btn btn-dark navbar-toggler" for="navbarToggle" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </label>

    <input type="checkbox" id="navbarToggle" class="navbar-collapse-input">
    <div id="navbarNav" class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <?php nav_item('about.php', 'About') ?>
        <?php nav_item('resume.php', 'Resume') ?>
        <?php nav_item('visitor.php', 'Visitors') ?>
        <?php nav_item('quotes.php', 'Quotes') ?>
        <?php nav_item('place', 'r/place') ?>
      </ul>
      <button id="background-random" class="icon-dice btn btn-outline-success" title="Random nav color"></button>
    </div>
  </nav>

  <main role="main" class="container">
