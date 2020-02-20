<?php /* Template Name: Künstler A-Z Template */ get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col">

        	<main role="main">
        		<!-- section -->
        		<section>
        			
        		      <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        			<!-- article -->
        			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        				<?php the_content(); ?>
        				<br class="clear">
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

        		<?php 
                /*
                 * Create a custom query that pulls all published posts in the custom post type
                 * "term", orders alphabetically by title
                 */
                $query = new WP_Query([
                    'post_type' => 'artist',
                    'posts_per_page' => -1,
                    'order' => 'ASC',
                    'orderby' => 'title'
                ]);

                 $alphabet = []; ?>

                <?php while( $query->have_posts() ) : $query->the_post(); ?>
                    <?php
                        // Start the output buffer
                        ob_start();
                        
                        // Get the first letter of the post title    
                        $firstLetter = substr(get_the_title(), 0, 1);
                        
                        // If this is the first instance of this letter, add it to the list.    
                        if (! isset($alphabet[$firstLetter])) {
                            $alphabet[$firstLetter] = [];
                        }
                    ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php
                        $alphabet[$firstLetter][] = ob_get_contents();
                        ob_end_clean();
                    ?>
                <?php endwhile; ?>
                    <nav class="alphabet-navigation" id="alphabet-nav">
                        <ul>
                            <?php foreach ($alphabet as $letter => $items) : ?>
                                <li><a href="#starts-with-<?php echo htmlentities($letter); ?>"><?php echo htmlentities($letter); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                    <ul class="glossary">
                        <?php foreach ($alphabet as $letter => $items) : ?>
                            <li>
                                <h3><a class="kuenstler_name_gross sprunglink" name="starts-with-<?php echo $letter; ?>"><?php echo $letter; ?></a></h3>
                                <ul>
                                    <?php foreach ($items as $item) : ?>
                                        <?php echo $item; ?>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                        <?php endforeach;?>
                    </ul>
        		</section>
        		<!-- /section -->
        	</main>

        </div>
    </div>
</div>

<?php get_footer(); ?>