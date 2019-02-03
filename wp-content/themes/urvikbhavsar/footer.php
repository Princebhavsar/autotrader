 <!-- FOOTER SECTION -->
 <footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 text-center margin-bottom">
        <h2>Keep in touch</h2>
        <img src="<?php echo esc_url(get_template_directory_uri() ); ?>/images/Purple-Divider.png" alt="divider">
      </div><!-- /col -->
    </div><!-- /row -->
    <div class="row">
      <div class="col-sm-4">
        <address>
          <b>Auto Trader</b><br> 
          405 The West Mall,<br>
          Etobicoke, ON<br>
          M9C 5J1<br>
        </address>  
      </div><!-- /col-sm-4 -->
      <div class="col-sm-4">
        <?php 
        wp_nav_menu( array(
          'menu'              => 'footer',
         'container'         => 'ul',
         'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
         'walker'            => new wp_bootstrap_navwalker())
        );
        ?>
      </div><!-- /col-sm-4 -->
      <div class="col-sm-4">
        <p>Follow Us:</p>
        <i class="fa fa-facebook fa-lg"></i>
        <i class="fa fa-twitter fa-lg"></i>
        <i class="fa fa-google-plus fa-lg"></i>
        <i class="fa fa-pinterest fa-lg"></i>
        <i class="fa fa-youtube fa-lg"></i>
      </div><!-- /col-sm-4 -->
    </div><!-- /row -->
  </div><!-- /container -->
  <div class="container-fluid" id="copy">
    <div class="col-sm-12">
      <p>&copy; <?php echo date('Y'); ?> Auto Trader</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>