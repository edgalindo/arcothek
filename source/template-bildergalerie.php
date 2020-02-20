<?php /* Template Name: Bilder-Galerie Template */ get_header(); ?>
<div class="container content">
  <div class="row">
    <div class="col">

	<main role="main">
		<!-- section -->
		<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>
				<?php echo do_shortcode('[searchandfilter id="40"]'); ?>
                <?php echo do_shortcode('[searchandfilter id="40" show="results"]'); ?>
				<div class="grid"> </div>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>
		</div>
</div>
</div>

<?php get_footer(); ?>