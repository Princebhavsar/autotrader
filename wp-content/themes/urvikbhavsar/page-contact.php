<?php 

/*
Template Name: Contact Us
*/

get_header(); ?>

<!-- CONTACT US SECTION -->
<section id="contact">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h2><?php the_title(); ?></h2>
        <img src="<?php echo esc_url(get_template_directory_uri() ); ?>/images/Purple-Divider.png" alt="divider">
      </div><!-- /col -->
    </div><!-- /row -->
    <div class="row">
      <div class="col-sm-6 address well">
        <address><i class="fa fa-map-marker"></i>
          Tranquil Spa<br>
          Address line 1<br>
          Address line 2<br>
          Address line 3<br>
        </address>
        <i class="fa fa-envelope-o"></i>Email: mail@mail.com<br>
        <i class="fa fa-phone"></i>Telephone: 123 456 789
      </div>
      <div class="col-sm-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18635.354632867795!2d-2.9745605606993974!3d54.2788492318288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487c963f7677c10f%3A0x7c4facf781298270!2z0JvQtdC50LrRgdCw0LnQtCwgVWx2ZXJzdG9uLCDQktC10LvQuNC60L7QsdGA0LjRgtCw0L3QuNGP!5e0!3m2!1sru!2s!4v1478869836975" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div>
    <div class="row message-area">
      <div class="col-sm-12">
        <?php echo do_shortcode('[contact-form-7 id="71" title="Contact form 1"]'); ?>
      </div><!-- /col-sm-12 -->
    </div><!-- /row -->
  </div><!-- /container -->
</section>

<?php get_footer(); ?>
