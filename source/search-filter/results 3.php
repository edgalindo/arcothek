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
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
							<!--
							<?php 
							if( get_field('kl_verleihstatus') == 'verfuegbar' ) { ?>
							    <p class="kl_status_green">Verfügbar</p>
							<?php } ?>
							<?php 
							if( get_field('kl_verleihstatus') == 'reserviert' ) { ?>
							    <p class="kl_status_yellow">Reserviert</p>
							<?php } ?>
							<?php 
							if( get_field('kl_verleihstatus') == 'ausgeliehen' ) { ?>
							    <p class="kl_status_red">Ausgeliehen bis: <?php the_field('kl_verliehen_bis'); ?></p>
							<?php } ?>
							-->
						</a>
					<?php endif; ?>

						<p><a class="bild_name_medium" href="<?php the_permalink(); ?>"><?php the_field('kl_kunstwerk_name'); ?></a></p>

					<?php $artist_datens = get_field('kl_artist_daten'); ?>
						<?php if( $artist_datens ): ?>
							
							<?php foreach( $artist_datens as $artist_daten ): ?>

								<p>
									<a class="kuenstler_name_medium" href="<?php the_permalink(); ?>">
									<!-- <a href="<?php echo get_permalink( $artist_daten->ID ); ?>"> -->
										<?php echo get_the_title( $artist_daten->ID ); ?>
									</a>
								</p>
								<!--
								<p><?php $nachname = get_field('kl_nachname', $artist_daten->ID); 
								echo $nachname;
								?></p>-->

							<?php endforeach; ?>
							
						<?php endif; ?>			
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