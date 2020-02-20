<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col">

	<main role="main">
		<!-- section -->
		<section>

			<h1><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>
		</div>
</div>
</div>



<?php get_footer(); ?>
