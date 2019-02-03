<?php 

/*
Template Name: Latest News
*/

get_header(); ?>

<!-- BLOG SECTION -->
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-8 blog-main">
      
      <?php query_posts('category_name=news'); ?>

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="blog-post">
          <h2 class="blog-post-title">
            <a href="<?php the_permalink(); ?>" 
              title="<?php the_title_attribute(); ?>">
              <?php the_title(); ?></a>
            </h2>
            <p class="blog-post-meta"><?php echo get_the_date('F, j, Y'); ?> by 
            <a href="#"><?php the_author(); ?></a></p>

            <i class="fa fa-tag"></i>
            <?php the_tags(); ?><br>

            <i class="fa fa-folder-open"></i>
            <?php _e( 'Category: ' ); ?>
            <?php the_category(', '); ?>

            <?php the_post_thumbnail(); ?>
            <?php the_excerpt(); ?>

            <a href="<?php echo get_permalink(); ?>">
              <?php _e( 'Read more...' ); ?>
            </a>

          </div> <!-- blog post -->

        <?php endwhile; else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>

      <nav>
        <ul class="pager">
          <li><?php next_posts_link('Older Posts'); ?></li>
          <li><?php previous_posts_link('Newer Posts'); ?></li>
        </ul>
      </nav>
    </div><!-- /.blog-main -->

    <!-- SIDEBAR SECTION -->
    <div class="col-sm-12 col-md-3 col-md-offset-1 blog-sidebar">

      <?php get_sidebar(); ?>

    </div><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</div><!-- /.container -->

<?php get_footer(); ?>
