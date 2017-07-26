</div><!-- container END! -->
<footer class="footer">
      <div class="container">
        <p class="text-center">
            <?php  $getActiveTheme = wp_get_theme();?>
            Powered by <strong><a href="https://github.com/boumannm/chaukor" target="_blank"><?php  echo $getActiveTheme->get( 'Name' ); ?></a></strong>
        </p>
      </div>
          <!-- close with Wordpress footer aka adminbar etc. -->
       <?php wp_footer();?>
</footer>
  </body>
</html>