</main>

<?php $all_js = array_merge(array('main.js'), $js) ?>

<?php for ($file=0; $file < count($all_js); $file++) { ?>
  <script src="js/<?= $all_js[$file] ?>"></script>
<?php } ?>

</body>

</html>