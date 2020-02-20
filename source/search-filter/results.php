<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */

if ( $query->have_posts() ) { ?>
	
Found <?php echo $query->found_posts; ?> Results<br />

<div class='search-filter-results-list'>

	<div class="grid" data-masonry='{ "columnWidth": ".grid-sizer", "itemSelector": ".grid-item" }'>
		<div class="grid-sizer"></div>
			
			<?php while ($query->have_posts()) { $query->the_post(); ?>

				<div class="grid-item">

					<div class='search-filter-result-item'>
						<a href="<?php the_permalink(); ?>">
		
					<?php
						$image = get_field('kl_abbildung');
						if( $image ):
						    $url = $image['url'];
						    $alt = $image['alt'];
						    $size = 'medium';
						    $thumb = $image['sizes'][ $size ];
						    $width = $image['sizes'][ $size . '-width' ];
						    $height = $image['sizes'][ $size . '-height' ];
						?>
						
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
							
							<?php 
							if( get_field('kl_verleihstatus') == 'ausgeliehen' ) { ?>
							    <div class="kl_status_result_list"><i class="fa fa-lock"></i></div>
								<div class="kl_status_text_result_list"><p>Das Bild ist leider ausgeliehen bis <?php the_field('kl_verliehen_bis'); ?>.</p></div>
							<?php } ?>
							
					<?php endif; ?>

						<p class="bild_name_medium"><?php the_field('kl_kunstwerk_name'); ?></p>

					<?php $artist_datens = get_field('kl_artist_daten'); ?>
					<?php if( $artist_datens ): ?>		
					<?php foreach( $artist_datens as $artist_daten ): ?>

						<p class="kuenstler_name_medium"><?php echo get_the_title( $artist_daten->ID ); ?></p>
								

					<?php endforeach; ?>
							
					<?php endif; ?>	
						</a>		
					</div>
				</div>
			
			<?php } ?>
		</div>
	</div>
	<?php } else { ?>
	<div class='search-filter-results-list' data-search-filter-action='infinite-scroll-end'>
		<!-- <span>End of Results</span> -->
	</div>
	<?php } ?>