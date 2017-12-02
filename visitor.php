<?php
  $title = 'Visitors';
  $css = array('visitor.css');
  $js = array();
  include('header.php');
?>

<div class="row">
  <div class="col-12">
    <h1>Visitors</h1>

    <form action="quotes.php" method="POST">
      <fieldset>
        <legend>Enter a quote:</legend>
        <div class="form-group">
          <label for="quote">Quote:</label>
          <textarea name="quote" id="quote" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="author">Author:</label>
          <input name="author" id="author" class="form-control">
        </div>
        <button class="btn btn-primary">Submit</button>
      </<fieldset>
    </form>
  </div>
</div>

<?php include('footer.php'); ?>
