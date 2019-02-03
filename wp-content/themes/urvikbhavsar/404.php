<?php 

/*
Template Name: 404 page
*/

get_header(); ?>

<!-- ABOUT US SECTION -->
<section id="about">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h2><?php _e("Let's get back on track:"); ?></h2>
        <img src="<?php echo esc_url(get_template_directory_uri() ); ?>/images/Purple-Divider.png" alt="divider">
      </div><!-- /col -->
    </div><!-- /row -->
    <div class="row">
      <div class="col-sm-6">
        <?php the_widget( 'WP_Widget_Archives' ); ?>
      </div>
      <div class="col-sm-6">
        <?php the_widget( 'WP_Widget_Categories' ); ?>
      </div>
      <div class="col-sm-6">
        <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
      </div>
      <div class="col-sm-6">
        <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
      </div>
    </div>    
    <?php get_template_part('content-facilities'); ?>
  </div><!-- /container -->
</section>

<?php get_footer(); ?>
