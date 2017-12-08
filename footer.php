  </main>
  <footer>
    <div class="container">
      @janka102
      <a href="https://www.github.com/janka102"><i class="icon-github"></i></a>
      <a href="https://www.twitter.com/janka102"><i class="icon-twitter"></i></a>
      <a href="https://stackoverflow.com/users/1307440/janka102"><i class="icon-stackoverflow"></i></a>
      <a href="https://www.linkedin.com/in/jesse-smick-36b04884/"><i class="icon-linkedin"></i></a>
      <a href="https://keybase.io/janka102"><i class="icon-key"></i></a>
    </div>
  </footer>

<?php
  $all_js = array_merge(array('main.js'), $js);

  foreach ($all_js as $js_file) {
    echo "  <script src=\"js/$js_file\"></script>\n";
  }
?>
</body>

</html>