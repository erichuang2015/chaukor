</div><!-- container END! -->
<footer class="footer" id="footer">
      <div class="container">
        <p class="text-center">
            <?php  $getActiveTheme = wp_get_theme();?>
            Powered by <strong><a href="https://chaukor.canitia.nl" target="_blank"><?php  echo $getActiveTheme->get( 'Name' ); ?></a></strong>
        </p>
      </div>
          <!-- close with Wordpress footer aka adminbar etc. -->
       <?php wp_footer();?>
</footer>
<script>
  WebFont.load({
    google: {
      families: ['Dancing Script', 'Merriweather', 'Prompt']
    }
  });
</script>

  </body>
</html>