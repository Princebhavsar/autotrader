<?php
/**
 * Template Name: Portfolio Striped
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

/**
*	Get Current page object
**/
$ob_page = get_page($post->ID);
$current_page_id = '';

if(isset($ob_page->ID))
{
    $current_page_id = $ob_page->ID;
}

get_header();

wp_enqueue_script("photography-horizontal-gallery", get_template_directory_uri()."/js/horizontal_gallery.js", false, THEMEVERSION, true);

//Check if disable slideshow hover effect
$tg_gallery_hover_slide = kirki_get_option( "tg_gallery_hover_slide" );

//Get portfolio grid title style
$tg_portfolio_grid_info_style = kirki_get_option( "tg_portfolio_grid_info_style" );

if(!empty($tg_gallery_hover_slide))
{
	wp_enqueue_script("photography-jquery-cycle2", get_template_directory_uri()."/js/jquery.cycle2.min.js", false, THEMEVERSION, true);
	wp_enqueue_script("photography-custom-cycle", get_template_directory_uri()."/js/custom_cycle.js", false, THEMEVERSION, true);
}

global $photography_screen_class;
$photography_screen_class = 'single_gallery';

//Include custom header feature
get_template_part("/templates/template-header");
?>

<!-- Begin content -->
<div class="transparent horizontal horizontal_portfolio <?php echo esc_attr($tg_portfolio_grid_info_style); ?>">
	<div id="horizontal_gallery">
	<table id="horizontal_gallery_wrapper">
	<tbody><tr>
	<?php
	    //Get all portfolio items for paging
		global $wp_query;
		
		if(is_front_page())
		{
		    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
		}
		else
		{
		    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		
		$query_string = 'paged='.$paged.'&orderby=menu_order&order=ASC&post_type=portfolios&numberposts=-1&suppress_filters=0&posts_per_page=-1';
	
		if(!empty($term))
		{
			$ob_term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$custom_tax = $wp_query->query_vars['taxonomy'];
		    $query_string .= '&posts_per_page=-1&'.$custom_tax.'='.$term;
		}
		query_posts($query_string);
	
	    $key = 0;
	    if (have_posts()) : while (have_posts()) : the_post();
	    	$key++;
			$image_url = '';
			$thumb_url = '';
			$portfolio_ID = get_the_ID();
					
			if(has_post_thumbnail($portfolio_ID, 'photography-gallery-striped'))
			{
			    $image_id = get_post_thumbnail_id($portfolio_ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'photography-gallery-striped', true);
			    $original_image_url = wp_get_attachment_image_src($image_id, 'original', true);
			    $thumb_url = wp_get_attachment_image_src($image_id, 'medium', true);
			}
			
			$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
			
			if(empty($portfolio_link_url))
			{
			    $permalink_url = get_permalink($portfolio_ID);
			}
			else
			{
			    $permalink_url = $portfolio_link_url;
			}
	        
		    if(!empty($image_url[0]))
		    {
		    	$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
				$portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
				
				switch($portfolio_type)
			    {
				    case 'External Link':
				    	$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
	?>	
	<td>
		<a href="<?php echo esc_url($portfolio_link_url); ?>">
	    	<div class="gallery_image_wrapper archive">
			    <div class="gallery_archive_desc">
				    <div class="gallery_archive_desc_content">
				    	<div class="gallery_archive_desc_inner">
					        <h6><?php the_title(); ?></h6>
					        <div class="post_detail"><?php the_excerpt(); ?></div>
					    </div>
				    </div>
			    </div>
			    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="horizontal_gallery_img"/>
			</div>
		</a>
	</td>
	<?php
					break;
				    
				    case 'Portfolio Content':
				    default:
	?>
	<td>
		<a href="<?php echo esc_url(get_permalink($portfolio_ID)); ?>">
	    	<div class="gallery_image_wrapper archive">
			    <div class="gallery_archive_desc">
				    <div class="gallery_archive_desc_content">
				    	<div class="gallery_archive_desc_inner">
					        <h6><?php the_title(); ?></h6>
					        <div class="post_detail"><?php the_excerpt(); ?></div>
					    </div>
				    </div>
			    </div>
			    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="horizontal_gallery_img"/>
			</div>
		</a>
	</td>
	<?php 
				    break;
				    
				    case 'Image':
	?>
	<td>
		<a data-rel="photography_portfolio_<?php echo esc_attr($current_page_id); ?>" <?php echo photography_get_portfolio_lightbox_caption_attr(get_the_title()); ?> href="<?php echo esc_url($original_image_url[0]); ?>" class="fancy-gallery" data-thumb="<?php echo esc_url($thumb_url[0]); ?>">
	    	<div class="gallery_image_wrapper archive">
			    <div class="gallery_archive_desc">
				    <div class="gallery_archive_desc_content">
				    	<div class="gallery_archive_desc_inner">
					        <h6><?php the_title(); ?></h6>
					        <div class="post_detail"><?php the_excerpt(); ?></div>
					    </div>
				    </div>
			    </div>
			    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="horizontal_gallery_img"/>
			</div>
		</a>
	</td>
	<?php
				    break;
				    
				    case 'Youtube Video':
	?>
	<td>
		<a data-rel="photography_portfolio_<?php echo esc_attr($current_page_id); ?>" href="https://www.youtube.com/embed/<?php echo esc_attr($portfolio_video_id); ?>" <?php echo photography_get_portfolio_lightbox_caption_attr(get_the_title(), $original_image_url[0]); ?> class="lightbox_youtube" data-options="width:900, height:488" data-thumb="<?php echo esc_url($thumb_url[0]); ?>">
	    	<div class="gallery_image_wrapper archive">
			    <div class="gallery_archive_desc">
				    <div class="gallery_archive_desc_content">
				    	<div class="gallery_archive_desc_inner">
					        <h6><?php the_title(); ?></h6>
					        <div class="post_detail"><?php the_excerpt(); ?></div>
					    </div>
				    </div>
			    </div>
			    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="horizontal_gallery_img"/>
			</div>
		</a>
	</td>
	<?php			    
				    break;
				    
				    case 'Vimeo Video':
	?>
	<td>
		<a data-rel="photography_portfolio_<?php echo esc_attr($current_page_id); ?>" href="https://player.vimeo.com/video/<?php echo esc_attr($portfolio_video_id); ?>?badge=0" <?php echo photography_get_portfolio_lightbox_caption_attr(get_the_title(), $original_image_url[0]); ?> class="lightbox_vimeo" data-options="width:900, height:506" data-thumb="<?php echo esc_url($thumb_url[0]); ?>">
	    	<div class="gallery_image_wrapper archive">
			    <div class="gallery_archive_desc">
				    <div class="gallery_archive_desc_content">
				    	<div class="gallery_archive_desc_inner">
					        <h6><?php the_title(); ?></h6>
					        <div class="post_detail"><?php the_excerpt(); ?></div>
					    </div>
				    </div>
			    </div>
			    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="horizontal_gallery_img"/>
			</div>
		</a>
	</td>
	<?php
				    break;
				    
				    case 'Self-Hosted Video':
				    
				    //Get video URL
					$portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
					$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
	?>
	<td>
		<a data-rel="photography_portfolio_<?php echo esc_attr($current_page_id); ?>"  href="<?php echo esc_url($portfolio_mp4_url); ?>" data-src="<?php echo esc_url($portfolio_mp4_url); ?>" <?php echo photography_get_portfolio_lightbox_caption_attr(get_the_title(), $original_image_url[0]); ?> class="lightbox_vimeo" data-thumb="<?php echo esc_url($thumb_url[0]); ?>">
	    	<div class="gallery_image_wrapper archive">
			    <div class="gallery_archive_desc">
				    <div class="gallery_archive_desc_content">
				    	<div class="gallery_archive_desc_inner">
					        <h6><?php the_title(); ?></h6>
					        <div class="post_detail"><?php the_excerpt(); ?></div>
					    </div>
				    </div>
			    </div>
			    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="horizontal_gallery_img"/>
			</div>
		</a>
	</td>
	<?php				
					break;
				}
		    }

	    $key++;
	    endwhile; endif;	
	?>
	</tr></tbody>
	</table>
	</div>
	</div>
</div>

<?php
	get_footer();
?>