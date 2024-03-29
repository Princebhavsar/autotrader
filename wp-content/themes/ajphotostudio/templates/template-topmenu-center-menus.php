<?php
//Get page ID
if(is_object($post))
{
    $obj_page = get_page($post->ID);
}
$current_page_id = '';

if(isset($obj_page->ID))
{
    $current_page_id = $obj_page->ID;
}
elseif(is_home())
{
    $current_page_id = get_option('page_on_front');
}
?>

<div class="header_style_wrapper">
<?php
    //Check if display top bar
    $tg_topbar = kirki_get_option('tg_topbar');
    if(THEMEDEMO && isset($_GET['topbar']) && !empty($_GET['topbar']))
	{
	    $tg_topbar = true;
	}
    
    global $photography_topbar;
    $photography_topbar = $tg_topbar;
    
    if(!empty($tg_topbar))
    {
?>

<!-- Begin top bar -->
<div class="above_top_bar">
    <div class="page_content_wrapper">
    
    <div class="top_contact_info">
		<?php
		    $tg_menu_contact_hours = kirki_get_option('tg_menu_contact_hours');
		    
		    if(!empty($tg_menu_contact_hours))
		    {	
		?>
		    <span id="top_contact_hours"><i class="fa fa-clock-o"></i><?php echo esc_html($tg_menu_contact_hours); ?></span>
		<?php
		    }
		?>
		<?php
		    //Display top contact info
		    $tg_menu_contact_number = kirki_get_option('tg_menu_contact_number');
		    
		    if(!empty($tg_menu_contact_number))
		    {
		?>
		    <span id="top_contact_number"><a href="tel:<?php echo esc_attr($tg_menu_contact_number); ?>"><i class="fa fa-phone"></i><?php echo esc_html($tg_menu_contact_number); ?></a></span>
		<?php
		    }
		?>
    </div>
    	
    <?php
    	//Display Top Menu
    	if ( has_nav_menu( 'top-menu' ) ) 
		{
		    wp_nav_menu( 
		        	array( 
		        		'menu_id'			=> 'top_menu',
		        		'menu_class'		=> 'top_nav',
		        		'theme_location' 	=> 'top-menu',
		        	) 
		    ); 
		}
    ?>
    <br class="clear"/>
    </div>
</div>
<?php
    }
?>
<!-- End top bar -->

<?php
	//Get Page Menu Transparent Option
	$page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);

    $pp_page_bg = '';
    //Get page featured image
    if(has_post_thumbnail($current_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        $pp_page_bg = $image_thumb[0];
    }
    
   if(!empty($pp_page_bg) && basename($pp_page_bg)=='default.png')
    {
    	$pp_page_bg = '';
    }
	
	//Check if Woocommerce is installed	
	if(class_exists('Woocommerce') && photography_is_woocommerce_page())
	{
		//Check if woocommerce page
		$shop_page_id = get_option( 'woocommerce_shop_page_id' );
		$page_menu_transparent = get_post_meta($shop_page_id, 'page_menu_transparent', true);
	}
	
	if(is_single() && !empty($pp_page_bg) && !photography_is_woocommerce_page())
	{
	    $post_type = get_post_type();
	    
	    switch($post_type)
	    {
	    	case 'events':
	    	default:
	    		$page_menu_transparent = 1;	
	    	break;
	    	
	    	case 'post':
	    		$page_menu_transparent = get_post_meta(get_the_ID(), 'post_menu_transparent', true);
	    	break;
	    	
	    	case 'galleries':
	    		global $photography_screen_class;
				if($photography_screen_class == 'split' OR $photography_screen_class == 'split wide')
				{
					$page_menu_transparent = 0;
				}
	    		else if(has_post_thumbnail($current_page_id, 'full'))
	    		{
		    		$tg_gallery_feat_content = kirki_get_option('tg_gallery_feat_content');
		    		
		    		if(!empty($tg_gallery_feat_content))
		    		{
		    			$page_menu_transparent = 1;
		    		}
	    		}
	    	break;
	    	
	    	case 'clients':
	    		if(class_exists('MultiPostThumbnails'))
				{
					$pp_page_bg = MultiPostThumbnails::get_post_thumbnail_url('clients', 'cover-image', $current_page_id);
					
					if(!empty($pp_page_bg))
					{
						$page_menu_transparent = 1;
					}
				}
	    	break;
	    	
	    	case 'portfolios':
	    		$page_menu_transparent = get_post_meta(get_the_ID(), 'portfolio_menu_transparent', true);
	    	break;
	    }
	}
	else if(is_single() && empty($pp_page_bg) && !photography_is_woocommerce_page())
	{
		$page_menu_transparent = 0;	
	}
	
	if(is_search())
	{
	    $page_menu_transparent = 0;
	}
	
	if(is_404())
	{
	    $page_menu_transparent = 0;
	}
	
	global $photography_homepage_style;
	if($photography_homepage_style == 'fullscreen')
	{
	    $page_menu_transparent = 1;
	}
?>
<div class="top_bar <?php if(!empty($page_menu_transparent)) { ?>hasbg<?php } ?>">
    <div class="standard_wrapper">
    	<!-- Begin logo -->
    	<div id="logo_wrapper">
    	
    	<?php
    	    //get custom logo
    	    $tg_retina_logo = kirki_get_option('tg_retina_logo');

    	    if(!empty($tg_retina_logo))
    	    {	
    	    	//Get image width and height
		    	$image_id = photography_get_image_id($tg_retina_logo);
		    	if(!empty($image_id))
		    	{
		    		$obj_image = wp_get_attachment_image_src($image_id, 'original');
		    		
		    		$image_width = 0;
			    	$image_height = 0;
			    	
			    	if(isset($obj_image[1]))
			    	{
			    		$image_width = intval($obj_image[1]/2);
			    	}
			    	if(isset($obj_image[2]))
			    	{
			    		$image_height = intval($obj_image[2]/2);
			    	}
		    	}
		    	else
		    	{
			    	$image_width = 0;
			    	$image_height = 0;
		    	}
    	?>
    	<div id="logo_normal" class="logo_container">
    		<div class="logo_align">
	    	    <a id="custom_logo" class="logo_wrapper <?php if(!empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo esc_url(home_url('/')); ?>">
	    	    	<?php
						if($image_width > 0 && $image_height > 0)
						{
					?>
					<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
					<?php
						}
						else
						{
					?>
	    	    	<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="192" height="16"/>
	    	    	<?php 
		    	    	}
		    	    ?>
	    	    </a>
    		</div>
    	</div>
    	<?php
    	    }
    	?>
    	
    	<?php
    		//get custom logo transparent
    	    $tg_retina_transparent_logo = kirki_get_option('tg_retina_transparent_logo');

    	    if(!empty($tg_retina_transparent_logo))
    	    {
    	    	//Get image width and height
		    	$image_id = photography_get_image_id($tg_retina_transparent_logo);
		    	$obj_image = wp_get_attachment_image_src($image_id, 'original');
		    	$image_width = 0;
		    	$image_height = 0;
		    	
		    	if(isset($obj_image[1]))
		    	{
		    		$image_width = intval($obj_image[1]/2);
		    	}
		    	if(isset($obj_image[2]))
		    	{
		    		$image_height = intval($obj_image[2]/2);
		    	}
    	?>
    	<div id="logo_transparent" class="logo_container">
    		<div class="logo_align">
	    	    <a id="custom_logo_transparent" class="logo_wrapper <?php if(empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo esc_url(home_url('/')); ?>">
	    	    	<?php
						if($image_width > 0 && $image_height > 0)
						{
					?>
					<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
					<?php
						}
						else
						{
					?>
	    	    	<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="192" height="16"/>
	    	    	<?php 
		    	    	}
		    	    ?>
	    	    </a>
    		</div>
    	</div>
    	<?php
    	    }
    	?>
    	<!-- End logo -->
    	
        <div id="menu_wrapper">
	        <div id="nav_wrapper">
	        	<div class="nav_wrapper_inner">
	        		<div id="menu_border_wrapper">
	        			<?php 	
	        				//Check if has custom menu
	        				if(is_object($post) && $post->post_type == 'page')
	    					{
	    						$page_menu = get_post_meta($current_page_id, 'page_menu', true);
	    					}
	        			
	        				if(empty($page_menu))
	    					{
	    						if ( has_nav_menu( 'primary-menu' ) ) 
	    						{
	    		    			    wp_nav_menu( 
	    		    			        	array( 
	    		    			        		'menu_id'			=> 'main_menu',
	    		    			        		'menu_class'		=> 'nav',
	    		    			        		'theme_location' 	=> 'primary-menu',
	    		    			        		'walker' => new photography_walker(),
	    		    			        	) 
	    		    			    ); 
	    		    			}
	    	    			}
	    	    			else
	    				    {
	    				     	if( $page_menu && is_nav_menu( $page_menu ) ) {  
	    						    wp_nav_menu( 
	    						        array(
	    						            'menu' => $page_menu,
	    						            'walker' => new photography_walker(),
	    						            'menu_id'			=> 'main_menu',
	    		    			        	'menu_class'		=> 'nav',
	    						        )
	    						    );
	    						}
	    				    }
	        			?>
	        		</div>
	        		
	        		<!-- Begin right corner buttons -->
			    	<div id="logo_right_button">
			    		<?php
			    			$photography_page_gallery_id = photography_get_page_gallery_id();
			    			
							if(is_single() OR !empty($photography_page_gallery_id))
							{
							$post_type = get_post_type();
							
							$gallery_download = get_post_meta($current_page_id, 'gallery_download', true);
							
							if(is_single() && $post_type == 'galleries' && !empty($gallery_download))
							{
								//Check if password protected
								$gallery_password = get_post_meta($current_page_id, 'gallery_password', true);
								
								if(empty($gallery_password) OR (isset($_SESSION['gallery_page_'.$current_page_id]) && !empty($_SESSION['gallery_page_'.$current_page_id])))
								{
						?>
						<div class="post_download_wrapper">
							<a id="gallery_download" class="tooltip" href="<?php echo esc_url($gallery_download); ?>" title="<?php esc_html_e('Download', 'photography' ); ?>"><i class="fa fa-download"></i></a>
						</div>
						<?php	}
								}
						
							}
						?>
			    	
			    		<?php
							if($photography_homepage_style == 'fullscreen' OR $photography_homepage_style == 'fullscreen_white')
							{
						?>
						<div class="view_fullscreen_wrapper">
							<a class="tooltip" id="page_maximize" href="javascript:;" title="<?php esc_html_e('View Fullscreen', 'photography' ); ?>"><i class="fa fa-expand"></i></a>
							<a class="tooltip" id="page_minimize" href="javascript:;" title="<?php esc_html_e('Exit Fullscreen', 'photography' ); ?>"><i class="fa fa-compress"></i></a>
						</div>
						<?php
							}
						?>
						
						<?php
						if (class_exists('Woocommerce')) {
						    //Check if display cart in header
						
						    global $woocommerce;
						    $cart_url = wc_get_cart_url();
						    $cart_count = $woocommerce->cart->cart_contents_count;
						?>
						<div class="header_cart_wrapper">
						    <div class="cart_count"><?php echo esc_html($cart_count); ?></div>
						    <a class="tooltip" href="<?php echo esc_url($cart_url); ?>" title="<?php esc_html_e('View Cart', 'photography' ); ?>"><i class="fa fa-shopping-cart"></i></a>
						</div>
						<?php
						}
						?>
			    	
				    	<!-- Begin side menu -->
						<a href="javascript:;" id="mobile_nav_icon"></a>
						<!-- End side menu -->
						
			    	</div>
			    	<!-- End right corner buttons -->
	        		
	        		<div id="menu_border_wrapper_right">
	        			<?php 	
	        				if(empty($page_menu))
	    					{
	    						if ( has_nav_menu( 'secondary-menu' ) ) 
	    						{
	    		    			    wp_nav_menu( 
	    		    			        	array( 
	    		    			        		'menu_id'			=> 'main_right_menu',
	    		    			        		'menu_class'		=> 'nav',
	    		    			        		'theme_location' 	=> 'secondary-menu',
	    		    			        		'walker' => new photography_walker(),
	    		    			        	) 
	    		    			    ); 
	    		    			}
	    	    			}
	    	    			else
	    				    {
	    				     	if( $page_menu && is_nav_menu( $page_menu ) ) {  
	    						    wp_nav_menu( 
	    						        array(
	    						            'menu' => $page_menu,
	    						            'walker' => new photography_walker(),
	    						            'menu_id'			=> 'main_right_menu',
	    		    			        	'menu_class'		=> 'nav',
	    						        )
	    						    );
	    						}
	    				    }
	        			?>
	        		</div>
	        	</div>
	        </div>
	        <!-- End main nav -->
        </div>
        
    	</div>
		</div>
    </div>
</div>
