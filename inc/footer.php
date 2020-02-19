<?php
// LOGOUT EVERYONE

// unset($_SESSION['success']);
// session_destroy();
?>
    <footer class="footer dark-bg-1 text-light text-muted p-2 mt-2">
      <div class="container">
      <div class="row">
      <div class="col">© <?php echo date('Y');?> <a href="https://moonmatt.cf" class="text-muted">moonmatt</a> aka Matteo Galavotti</div>
      <div class="col text-right">Progetto su <a href="https://github.com/moonmatt/forumjuve" class="text-light">GitHub</a></div>
      </div>
      </div>
    </footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/ui/trumbowyg.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/trumbowyg.min.js"></script>

<script>
    // Doing this in a loaded JS file is better, I put this here for simplicity
    $('#my-editor').trumbowyg();
</script>
  
  
  </body>
</html>