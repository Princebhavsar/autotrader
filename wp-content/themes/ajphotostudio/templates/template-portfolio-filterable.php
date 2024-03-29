<?php 
global $photography_page_content_class;

//Get all project service and sorting option
$tg_portfolio_filterable = kirki_get_option('tg_portfolio_filterable');

//Get all sets and sorting option
$tg_portfolio_filterable_sort = kirki_get_option('tg_portfolio_filterable_sort');

//Check filterable link option
$tg_portfolio_filterable_link = kirki_get_option('tg_portfolio_filterable_link');

$tg_page_title_font_alignment = kirki_get_option('tg_page_title_font_alignment');
 
//Get all portfolio sets
$sets_arr = get_terms('portfoliosets', 'hide_empty=0&hierarchical=0&parent=0&orderby='.$tg_portfolio_filterable_sort);
    
if(!empty($tg_portfolio_filterable) && !empty($sets_arr) && empty($term))
{
	if($photography_page_content_class == 'wide' && ($tg_page_title_font_alignment == 'left' OR $tg_page_title_font_alignment == 'right'))
	{
?>
<div class="standard_wrapper">
<?php
	}
?>
<ul id="portfolio_wall_filters" class="portfolio-main filter full"> 
	<li class="all-projects active">
		<a class="active" href="javascript:;" data-filter=""><?php echo esc_html_e('All', 'photography-translation' ); ?></a>
		<span class="separator">/</span>
	</li>
	<?php
		foreach($sets_arr as $key => $set_item)
		{
			$filter_link_url = 'javascript:;';
			    			
			if(!empty($tg_portfolio_filterable_link))
			{
			    $filter_link_url = get_term_link($set_item);
			}
	?>
	<li class="cat-item <?php echo esc_attr($set_item->slug); ?>" data-type="<?php echo esc_attr($set_item->slug); ?>" style="clear:none">
		<a data-filter="<?php echo esc_attr($set_item->slug); ?>" href="<?php echo esc_attr($filter_link_url); ?>" title="<?php echo esc_attr($set_item->name); ?>"><?php echo esc_html($set_item->name); ?></a>
		<span class="separator">/</span>
	</li> 
	<?php
		}
	?>
</ul>
<?php
	if($photography_page_content_class == 'wide' && ($tg_page_title_font_alignment == 'left' OR $tg_page_title_font_alignment == 'right'))
	{
?>
</div>
<?php
	}
}
?>