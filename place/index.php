<?php
$title = 'r/place';
$page = 'place';
$base_url = '../';
$css = array('place.css');
$js = array('place.js');
include('../header.php');
?>

<div class="row">
  <div class="col-12">
  <h1>Welcome to r/place</h1>
  
  <div id="place-grid"></div>

  <input id="color-picker">
  <div id="colors"></div>
  </div>
</div>

<?php include('../footer.php'); ?>
