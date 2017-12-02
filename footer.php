  </main>

<?php
  $all_js = array_merge(array('main.js'), $js);

  foreach ($all_js as $js_file) {
    echo "  <script src=\"js/$js_file\"></script>\n";
  }
?>
</body>

</html>