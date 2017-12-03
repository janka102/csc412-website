<?php
  $title = 'Quotes';
  $css = array('quotes.css');
  $js = array();
  include('header.php');
?>

<div class="row">
  <?php
  // Create connection
  $mysqli = new mysqli('localhost','csc412','csc412','csc412');

  // Check connection
  if ($mysqli->connect_errno) {
    echo '<div class="alert alert-danger col-12" role="alert">Failed to connect to MySQL: (', htmlspecialchars($mysqli->connect_errno), ') ', htmlspecialchars($mysqli->connect_error), '</div>';
  }

  if ($_POST['quote'] && $_POST['author']) {
    $_POST['quote'] = substr($_POST['quote'], 0, 256);
    $_POST['author'] = substr($_POST['author'], 0, 128);

    // Global rate limit for quote submissions
    $min_time = 5;
    $max_quotes = 50;
    $utc = new DateTimeZone('UTC');
    $now = new DateTime('now', $utc);
    $result = $mysqli->query('SELECT `date` FROM `jsmick_quotes` ORDER BY `date` DESC LIMIT 1');

    if ($row = $result->fetch_assoc()) {
      // Get last quote insert time
      $last_date = new DateTime($row['date'], $utc);
      $diff = $now->getTimestamp() - $last_date->getTimestamp();
    } else {
      // If no previous quotes, insert right away
      $diff = $min_time + 1;
    }

    if ($diff > $min_time) {
      $stmt = $mysqli->prepare('INSERT INTO `jsmick_quotes` (`quote`, `author`, `date`) VALUES (?, ?, ?)');
      $stmt->bind_param('sss', $_POST['quote'], $_POST['author'], $now->format('Y-m-d H:i:s'));
      $stmt->execute();

      // Delete old quotes
      $result = $mysqli->query("SELECT `date` FROM `jsmick_quotes` ORDER BY `date` DESC LIMIT 1 OFFSET $max_quotes");

      if ($row = $result->fetch_assoc()) {
        $min_date = $row['date'];
        $mysqli->query("DELETE FROM `jsmick_quotes` WHERE `date` <= \"$min_date\"");
      }
    } else {
      $last_quote = $_POST['quote'];
      $last_author = $_POST['author'];
      echo '<div class="alert alert-danger col-12" role="alert"><b>Quote limit reached.</b> Try again in ', (1 + $min_time - $diff), ' second(s).</div>';
    }
  }
  ?>

  <div class="col-12">
    <h1>Quotes</h1>

    <input type="checkbox" id="quote-form-toggle"<?= $last_quote || $last_author ? ' checked="checked"' : '' ?>>
    <label class="btn btn-outline-primary" for="quote-form-toggle">Submit a quote</label>
    <form action="quotes.php" method="POST">
      <fieldset>
        <legend>Enter a quote</legend>
        <div class="form-group">
          <label for="quote">Quote:</label>
          <textarea name="quote" id="quote" class="form-control" maxlength="256"><?= $last_quote ? htmlspecialchars($last_quote) : '' ?></textarea>
        </div>
        <div class="form-group">
          <label for="author">Author:</label>
          <input name="author" id="author" class="form-control" size="128"<?= $last_author ? ' value="' . htmlspecialchars($last_author) . '"' : '' ?>>
        </div>
        <button class="btn btn-primary">Submit</button>
      </fieldset>
    </form>
  </div>

  <?php
  $result = $mysqli->query("SELECT `quote`, `author` FROM `jsmick_quotes`");

  if ($row = $result->fetch_assoc()) {
    do {
      echo '<div class="col-6"><blockquote><pre>', htmlspecialchars($row['quote']), '</pre><cite>', htmlspecialchars($row['author']), '</cite></blockquote></div>', "\n";
    } while (($row = $result->fetch_assoc()));
  } else {
    echo '<div class="col-12 text-center"><i>No Quotes</i></div>';
  }

  $mysqli->close();
  ?>
</div>

<?php include('footer.php'); ?>