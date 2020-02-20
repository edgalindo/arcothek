<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<?php
if ( is_single() && 'werke' == get_post_type() ) { ?>
<?php $artist_datens = get_field('kl_artist_daten', $post_id); ?>
<?php if( $artist_datens ): ?>
	<?php foreach( $artist_datens as $artist_daten ): ?>						
		<?php $kuenster_title = get_the_title( $artist_daten->ID ); ?>
	<?php endforeach; ?>
<?php endif; ?>
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' -'; } ?> <?php echo $kuenster_title ?> : <?php bloginfo('name'); ?></title>
<?php } else { ?>
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<?php } ?>
<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php the_field('kl_seitenbeschreibung'); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- header -->
	<header class="header clear">
		<nav class="navbar navbar-expand-lg fixed-top bg-light navbar-light navbar_kl py-4">
    		<div class="container">
	       		<a class="navbar-brand" href="<?php echo home_url(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo" class="logo-img">
				</a>
	        	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
	           		<span class="navbar-toggler-icon"></span>
	       		</button>
	        	<div class="collapse navbar-collapse flex-column align-items-end" id="navbarCollapse">
		            <!-- navbar1 -->
		            <?php
						wp_nav_menu( array(
						    'theme_location' => 'top-menu',
						    'depth'          => 1,
						    'container'      => false,
						    'menu_class'     => 'navbar-nav ml-auto',
						    'menu_id'		 => 'top_menu',
						    'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
						    // Process nav menu using our custom nav walker.
						    'walker'         => new WP_Bootstrap_Navwalker(),
						) );
					?>
		            <!-- navbar2 -->
		            <?php
						wp_nav_menu( array(
						    'theme_location' => 'main-menu',
						    'depth'          => 1,
						    'container'      => false,
						    'menu_class'     => 'navbar-nav ml-auto',
						    'menu_id'		 => 'main_menu',
						    'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
						    // Process nav menu using our custom nav walker.
						    'walker'         => new WP_Bootstrap_Navwalker(),
						) );
					?>
	        	</div>
    		</div>
		</nav>
	</header>
	<!-- /header -->