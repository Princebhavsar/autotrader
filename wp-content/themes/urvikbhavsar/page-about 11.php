<?php 

/*
Template Name: About Us
*/

get_header(); ?>

<!-- ABOUT US SECTION -->
<section id="about">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h2>About Us</h2>
        <img src="<?php echo esc_url(get_template_directory_uri() ); ?>/images/Purple-Divider.png" alt="divider">
      </div><!-- /col -->
    </div><!-- /row -->
    <div class="row">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sagittis mattis arcu in imperdiet. Pellentesque sit amet orci venenatis, vulputate leo quis, sollicitudin velit. Pellentesque malesuada pretium neque sed rutrum. Mauris bibendum, nisi at mollis porttitor, urna sapien interdum ligula, et porttitor mi arcu sed lacus. Proin dignissim ac justo vel ullamcorper. Etiam tempus lacus massa, eu elementum nibh lobortis ut. Quisque porttitor a nulla eu fringilla. Morbi faucibus laoreet turpis id mattis. Curabitur lacinia consequat eros, et lacinia nisl tincidunt id. Nulla metus enim, dignissim vel ornare vel, tristique vel massa. Suspendisse nec orci vel risus porttitor bibendum congue vitae mi. Ut gravida velit et dolor sollicitudin, ut placerat ligula blandit. Sed varius convallis eros, non hendrerit lacus eleifend sed. Ut dapibus turpis sapien, et mollis arcu iaculis sed. Fusce auctor accumsan scelerisque. Vivamus congue nulla ut leo tempus, eget egestas erat maximus.
      </p>
      <p>
        Etiam convallis tincidunt mi, sit amet finibus neque maximus non. Vestibulum augue sapien, luctus et auctor et, congue eget dui. Ut pretium efficitur dui, eget finibus magna varius non. Praesent dictum sapien in mattis lacinia. Nulla maximus tortor eget dolor condimentum, et egestas ligula pharetra. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec non lacinia orci. Curabitur sit amet libero ac justo vestibulum aliquet et sit amet est. Duis efficitur elementum orci at sodales. Suspendisse eget nisi sed augue tempor mollis et quis ex.
      </p>
    </div>    
    <?php get_template_part('content-facilities'); ?>
  </div><!-- /container -->
</section>

<?php get_footer(); ?>
