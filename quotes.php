<?php
$title = 'Quotes';
$page = 'quotes';
$css = array('visitor.css');
$js = array();
include('header.php');
?>

<div class="row">
  <?php

  // Create connection
  $mysqli = new mysqli('localhost','csc412','csc412','csc412');

  // Check connection
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

  if ($_POST['quote'] && $_POST['author']) {
    $stmt = $mysqli->prepare("INSERT INTO jsmick_quotes (quote, author) VALUES (?, ?)");
    $stmt->bind_param('ss', $_POST['quote'], $_POST['author']);
    $stmt->execute();
  }


  $result = $mysqli->query("SELECT * FROM jsmick_quotes");

  $result->data_seek(0);
  while ($row = $result->fetch_assoc()) {
    echo '<div class="col-6"><blockquote>' . $row['quote'] . '<cite>' . $row['author'] . '</cite></blockquote></div>' . "\n";
  }

  $mysqli->close();
  ?>
</div>

<?php include('footer.php'); ?>