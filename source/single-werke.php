<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col">
    	<main>
			<?php while ( have_posts() ) : the_post(); ?>

				<article>

					<div class="row pt-5 no-gutters">
    					<div class="col-md-6 mx-auto d-block">
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
							<img class="mx-auto d-block" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
							<?php endif; ?>

							<?php
                            if( get_field('kl_text_bildlizenz') == 'vgbild' ) { ?>
                                <p class="bild_copyright">© VG Bild-Kunst, Bonn <?php the_field('kl_lizenzjahr_vg_bildkunst'); ?>. Foto: <?php the_field('kl_fotograf_vg_bildkunst'); ?></p>
                            <?php } ?>
                            <?php 
                            if( get_field('kl_text_bildlizenz') == 'balgalerie' ) { ?>
                                <p class="bild_copyright">© Bezirksamt Lichtenberg von Berlin. Foto: Galerie 100, <?php the_field('kl_lizenzjahr_ba_lichtenberg'); ?></p>
                            <?php } ?>
                            <?php 
                            if( get_field('kl_text_bildlizenz') == 'bafotograf' ) { ?>
                                <p class="bild_copyright">© Bezirksamt Lichtenberg von Berlin. Foto: <?php the_field('kl_fotograf_ba_lichtenberg'); ?>, <?php the_field('kl_lizenzjahr_ba_lichtenberg'); ?></p>
                            <?php } ?>
    					</div>

    					<div class="col-md-6">
    						<?php $artist_datens = get_field('kl_artist_daten'); ?>
							<?php if( $artist_datens ): ?>
								<?php foreach( $artist_datens as $artist_daten ): ?>
									<p>
										<a class="kuenstler_name_gross" href="<?php echo get_permalink( $artist_daten->ID ); ?>">
											<?php echo get_the_title( $artist_daten->ID ); ?>
										</a>
									</p>
									<?php 
									$nachname = get_field('kl_nachname', $artist_daten->ID);
									$vorname = get_field('kl_vorname', $artist_daten->ID);
									$biografie = get_field('kl_biographie', $artist_daten->ID);
									$website = get_field('kl_website', $artist_daten->ID);
									$artist_id = ($artist_daten->ID);
									?>
							<?php endforeach; ?>
							<?php endif; ?>
							
    						<h1 class="bild_name_gross"><?php the_field('kl_kunstwerk_name'); ?></h1>

    						<div class="row pt-5">
    							<div class="col">
    								<ul class="list-unstyled meta_list">
	    								<li>
	    									<p class="meta_headline">Jahr</p>
	    									<?php if( get_field('kl_jahr') ): ?>
    											<p><?php the_field('kl_jahr'); ?></p>
    										<?php else : ?>
    											<p>keine Angabe</p>
											<?php endif; ?>
	    								</li>
	    								<li>
	    									<p class="meta_headline">Größe</p>
	    									<?php if( get_field('kl_groesse') ): ?>
    											<p><?php the_field('kl_groesse'); ?> cm</p>
    										<?php else : ?>
    											<p>keine Angabe</p>
											<?php endif; ?>
	    								</li>
	    								<li>
	    									<p class="meta_headline">Rahmen</p>
	    									<?php if( get_field('kl_rahmen') ): ?>
    											<p><?php the_field('kl_rahmen'); ?> cm</p>
    										<?php else : ?>
    											<p>keine Angabe</p>
											<?php endif; ?>
	    									
	    								</li>
    								</ul>
    							</div>

    							<div class="col">
    								<ul class="list-unstyled meta_list">
	    								<li>
	    									<p class="meta_headline">Technik</p>
	    									<?php 
											$term_id = get_field('kl_technik_gruppe');
											$term = get_term( $term_id );
											if( $term ): ?>
											    <p><?php echo esc_html( $term->name ); ?></p>
											<?php endif; ?>
	    								</li>
	    								<li>
	    									<p class="meta_headline">Genre</p>
	    									<?php 
											$term_id = get_field('kl_genre_gruppe');
											$term = get_term( $term_id );
											if( $term ): ?>
											    <p><?php echo esc_html( $term->name ); ?></p>
											<?php endif; ?>
	    								</li>
	    								<li>
	    									<p class="meta_headline">Motiv</p>
	    									<?php 
											$term_id = get_field('kl_motiv_gruppe');
											$term = get_term( $term_id );
											if( $term ): ?>
											    <p><?php echo esc_html( $term->name ); ?></p>
											<?php endif; ?>
	    								</li>
    								</ul>
    							</div>
    						</div>
    						<p class="meta_headline">Status</p>
    						<?php 
							if( get_field('kl_verleihstatus') == 'verfuegbar' ) { ?>
							    <p class="kl_status_green">Verfügbar</p>
							    <p>Wenn Sie dieses Bild ausleihen möchten, schauen Sie in unser <a href="<?php echo esc_url( get_page_link( 235 ) ); ?>">Ausleih-Info</a>.</p>
							<?php } ?>
							<?php 
							if( get_field('kl_verleihstatus') == 'reserviert' ) { ?>
							    <p class="kl_status_yellow">Reserviert</p>
							<?php } ?>
							<?php 
							if( get_field('kl_verleihstatus') == 'ausgeliehen' ) { ?>
							    <p class="kl_status_red">Ausgeliehen<?php if( get_field('kl_verliehen_bis') ): ?> bis: <?php the_field('kl_verliehen_bis'); ?><?php endif; ?></p>
							<?php } ?>
    					</div>
    				</div>

    				<div class="row border_gold mt-5 no-gutters">
    					<div class="col-md-6">
    						<?php $postid = get_the_ID(); ?>
    						<?php
								$werke = get_posts(array(
									'post_type' => 'werke',
									'posts_per_page' => 6,
									'post__not_in' => array($postid),
									'meta_query' => array(
										array(
											'key' => 'kl_artist_daten', // name of custom field
											'value' => $artist_id,
											'compare' => 'LIKE'
										)
									)
								));
								?>
							<?php if( $werke ): ?>

							<p class="meta_headline">Weitere Bilder</p>
							<ul class="weitere_werke">
								<?php foreach( $werke as $werk ): ?>
								<li>
									<?php
									$image = get_field('kl_abbildung', $werk->ID);
									if( $image ):
									    $url = $image['url'];
									    $alt = $image['alt'];
									    $size = 'small';
									    $thumb = $image['sizes'][ $size ];
									    $width = $image['sizes'][ $size . '-width' ];
									    $height = $image['sizes'][ $size . '-height' ];
									?>
									<a href="<?php echo get_permalink( $werk->ID ); ?>">
										<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
									</a>
									<?php endif; ?>
									<p><a class="bild_name_klein" href="<?php echo get_permalink( $werk->ID ); ?>">
										<?php the_field('kl_kunstwerk_name', $werk->ID); ?>
									</a></p>
								</li>
								<?php endforeach; ?>
							</ul>
							<?php 
							if( count($werke) > 0 ) { ?>
							<p>Alle Bilder von <a href="<?php echo get_permalink($artist_id); ?>"><?php echo $nachname; ?>, <?php echo $vorname; ?> anzeigen</a>.</p>
							<?php } ?>
							<?php else : ?>
								<p class="meta_headline">Leider keine weiteren Bilder</p>
							<?php endif; ?>
    					</div>
    					<div class="col-md-6">
    						<p class="meta_headline"><?php echo $nachname; ?>, <?php echo $vorname; ?></p>
    						<div class="biografie_inner">
    							<?php if( $biografie ): ?>
    								<?php echo $biografie; ?>
    								<?php else : ?>
    								<p>Leider keine Biografie vorhanden.</p>
								<?php endif; ?>
    						</div>
    						<?php
							if( $website ): ?>
							    <p><a class="website_link" target="_blank" href="<?php echo esc_url( $website ); ?>">Website</a></p>
							<?php endif; ?>
    					</div>
    				</div>
					<div class="row _border_gold mt-5">
    					<div class="col">
    						<?php 
							$term_id_technik = get_field('kl_technik_gruppe');
							$term_technik = get_term( $term_id_technik );
							$term_id_genre = get_field('kl_genre_gruppe');
							$term_genre = get_term( $term_id_genre );
							$term_id_motiv = get_field('kl_motiv_gruppe');
							$term_motiv = get_term( $term_id_motiv );

							$recommendations = get_posts(array(
							    'post_type'             => 'werke',
							    'posts_per_page'        => 6,
							    'orderby'               => 'rand',
							    'post__not_in'          => array( $postid ),
							    'meta_query' => array(
										array(
											'key' => 'kl_artist_daten', // name of custom field
											'value' => $artist_id,
											'compare' => 'NOT LIKE'
										)
									),
							    'tax_query' => array(
							        'relation' => 'OR',
							        array(
							            'taxonomy' => 'technik',
							            'field'    => $term_id_technik,
							            'terms'    => $term_technik,
							        ),
							        array(
							            'taxonomy' => 'genre',
							            'field'    => $term_id_genre,
							            'terms'    => $term_genre,
							        ),
							        array(
							            'taxonomy' => 'motiv',
							            'field'    => $term_id_motiv,
							            'terms'    => $term_motiv,
							        )
							    )

							));
							?>
							<?php if( $recommendations ): ?>
							<p class="meta_headline">Ähnliche Bilder von anderen Künstlern</p>
							<ul class="aehnliche_werke">
								<?php foreach( $recommendations as $recommendation ): ?>
								<li>
									<?php
									$image = get_field('kl_abbildung', $recommendation->ID);
									if( $image ):
									    $url = $image['url'];
									    $alt = $image['alt'];
									    $size = 'small';
									    $thumb = $image['sizes'][ $size ];
									    $width = $image['sizes'][ $size . '-width' ];
									    $height = $image['sizes'][ $size . '-height' ];
									?>
									<a href="<?php echo get_permalink( $recommendation->ID ); ?>">
										<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
									</a>
									<?php endif; ?>
									<p><a href="<?php echo get_permalink( $recommendation->ID ); ?>">
										<span class="bild_name_klein"><?php the_field('kl_kunstwerk_name', $recommendation->ID); ?></span>
									
									<br>
									<?php $artist_datens = get_field('kl_artist_daten', $recommendation->ID); ?>
										<?php if( $artist_datens ): ?>
										<?php foreach( $artist_datens as $artist_daten ): ?>
											<span class="kuenstler_name_klein"><?php echo get_the_title( $artist_daten->ID ); ?></span>
										<?php endforeach; ?>
										<?php endif; ?>
										</a></p>
								</li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>

    					</div>
    				</div>


				</article>

			<?php endwhile; // end of the loop. ?>
		</main>

		</div>
</div>
</div>



<?php get_footer(); ?>
