<?php
/*
 *  Author: Andreas Perzborn
 *  URL: https://buero-perzborn.de
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, 700, false); // Large Thumbnail
    add_image_size('medium', 400, 400, false); // Medium Thumbnail
    add_image_size('small', 100, 100, false); // Small Thumbnail
    //add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Navigation
/*
function html5blank_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => false,
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => '',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}
*/


// Register Custom Navigation Walker
//require_once( get_template_directory_uri() . '/inc/class-wp-bootstrap-navwalker.php');

require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

add_action( 'wp_enqueue_scripts', 'site_scripts' );
 
function site_scripts() {
    wp_enqueue_script('masonry');
    wp_enqueue_script( 'site-script', get_template_directory_uri() . '/js/scripts.js', array(), false, true );

    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), false, true );
    wp_enqueue_script( 'bootstrap-select', get_template_directory_uri() . '/js/bootstrap-select.min.js', array(), false, true );
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.3.1', 'all');
    wp_enqueue_style('bootstrap'); // Enqueue it!

    wp_register_style('bootstrap-select', get_template_directory_uri() . '/css/bootstrap-select.min.css', array(), '1.13.9', 'all');
    wp_enqueue_style('bootstrap-select'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
}

// Register Navigation
function register_html5_menu()
{
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'html5blank'), // Main Navigation
        'top-menu' => __('Top Menu', 'html5blank') // Top Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Footer 1
    register_sidebar(array(
        'name' => __('Widget Footer 1', 'html5blank'),
        'description' => __('Footer 1', 'html5blank'),
        'id' => 'widget-footer-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Footer 2
    register_sidebar(array(
        'name' => __('Widget Footer 2', 'html5blank'),
        'description' => __('Footer 2', 'html5blank'),
        'id' => 'widget-footer-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Footer 3
    register_sidebar(array(
        'name' => __('Widget Footer 3', 'html5blank'),
        'description' => __('Footer 3', 'html5blank'),
        'id' => 'widget-footer-3',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Footer 4
    register_sidebar(array(
        'name' => __('Widget Footer 4', 'html5blank'),
        'description' => __('Footer 4', 'html5blank'),
        'id' => 'widget-footer-4',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));


    // Define Sidebar Widget Sponsor 1
    register_sidebar(array(
        'name' => __('Widget Sponsor 1', 'html5blank'),
        'description' => __('Sponsor 1', 'html5blank'),
        'id' => 'widget-sponsor-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Sponsor 2
    register_sidebar(array(
        'name' => __('Widget Sponsor 2', 'html5blank'),
        'description' => __('Sponsor 2', 'html5blank'),
        'id' => 'widget-sponsor-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Sponsor 3
    register_sidebar(array(
        'name' => __('Widget Sponsor 3', 'html5blank'),
        'description' => __('Sponsor 3', 'html5blank'),
        'id' => 'widget-sponsor-3',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Headline Sponsor
    register_sidebar(array(
        'name' => __('Widget Sponsor Head', 'html5blank'),
        'description' => __('Sponsor Head', 'html5blank'),
        'id' => 'widget-sponsor-head',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_werke'); // Add our HTML5 Blank Custom Post Type
add_action('init', 'create_post_type_artist'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Custom Post type Werke
function create_post_type_werke()
{
    register_taxonomy_for_object_type('category', 'werke'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'werke');
    register_post_type('werke', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Werke/Bilder', 'html5blank'), // Rename these to suit
            'singular_name' => __('Werk', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New Werk', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit Werk', 'html5blank'),
            'new_item' => __('New Werk', 'html5blank'),
            'view' => __('View Werk', 'html5blank'),
            'view_item' => __('View Werk', 'html5blank'),
            'search_items' => __('Search Werk', 'html5blank'),
            'not_found' => __('No Werke found', 'html5blank'),
            'not_found_in_trash' => __('No Werke found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

// Custom Post type Künstler
function create_post_type_artist()
{
    register_taxonomy_for_object_type('category', 'artist'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'artist');
    register_post_type('artist', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Künstler', 'html5blank'), // Rename these to suit
            'singular_name' => __('Artist', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New Artist', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit Artist', 'html5blank'),
            'new_item' => __('New Artist', 'html5blank'),
            'view' => __('View Artist', 'html5blank'),
            'view_item' => __('View Artist', 'html5blank'),
            'search_items' => __('Search Artist', 'html5blank'),
            'not_found' => __('No Artist found', 'html5blank'),
            'not_found_in_trash' => __('No Artist found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}


// Taxonomy Künstler
 
add_action( 'init', 'create_kuenstler_nonhierarchical_taxonomy', 0 );
 
function create_kuenstler_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Künstler', 'taxonomy general name' ),
    'singular_name' => _x( 'Künstler', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Künstler' ),
    'popular_items' => __( 'Popular Künstler' ),
    'all_items' => __( 'Alle Künstler' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Künstler' ), 
    'update_item' => __( 'Update Künstler' ),
    'add_new_item' => __( 'Add New Künstler' ),
    'new_item_name' => __( 'New Künstler Name' ),
    'separate_items_with_commas' => __( 'Separate kuenstler with commas' ),
    'add_or_remove_items' => __( 'Add or remove kuenstler' ),
    'choose_from_most_used' => __( 'Choose from the most used kuenstler' ),
    'menu_name' => __( 'Künstler' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('kuenstler','werke',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'kuenstler' ),
  ));
}

// Taxonomy Genre
 
add_action( 'init', 'create_genre_nonhierarchical_taxonomy', 0 );
 
function create_genre_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Genre', 'taxonomy general name' ),
    'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Genre' ),
    'popular_items' => __( 'Popular Genre' ),
    'all_items' => __( 'Alle Genre' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Genre' ), 
    'update_item' => __( 'Update Genre' ),
    'add_new_item' => __( 'Add New Genre' ),
    'new_item_name' => __( 'New Genre Name' ),
    'separate_items_with_commas' => __( 'Separate genre with commas' ),
    'add_or_remove_items' => __( 'Add or remove genre' ),
    'choose_from_most_used' => __( 'Choose from the most used genre' ),
    'menu_name' => __( 'Genre' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('genre','werke',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'genre' ),
  ));
}
// Taxonomy Technik
 
add_action( 'init', 'create_technik_nonhierarchical_taxonomy', 0 );
 
function create_technik_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Technik', 'taxonomy general name' ),
    'singular_name' => _x( 'Technik', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Technik' ),
    'popular_items' => __( 'Popular Technik' ),
    'all_items' => __( 'Alle Techniken' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Technik' ), 
    'update_item' => __( 'Update Technik' ),
    'add_new_item' => __( 'Add New Technik' ),
    'new_item_name' => __( 'New Technik Name' ),
    'separate_items_with_commas' => __( 'Separate technik with commas' ),
    'add_or_remove_items' => __( 'Add or remove technik' ),
    'choose_from_most_used' => __( 'Choose from the most used technik' ),
    'menu_name' => __( 'Technik' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('technik','werke',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'technik' ),
  ));
}
// Taxonomy Motiv
 
add_action( 'init', 'create_motiv_nonhierarchical_taxonomy', 0 );
 
function create_motiv_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Motiv', 'taxonomy general name' ),
    'singular_name' => _x( 'Motiv', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Motive' ),
    'popular_items' => __( 'Popular Motive' ),
    'all_items' => __( 'Alle Motive' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Motiv' ), 
    'update_item' => __( 'Update Motiv' ),
    'add_new_item' => __( 'Add New Motiv' ),
    'new_item_name' => __( 'New Motiv Name' ),
    'separate_items_with_commas' => __( 'Separate motive with commas' ),
    'add_or_remove_items' => __( 'Add or remove motive' ),
    'choose_from_most_used' => __( 'Choose from the most used motive' ),
    'menu_name' => __( 'Motiv' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('motiv','werke',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'motiv' ),
  ));
}





/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}



add_shortcode( 'search-form', 'search_form' );

function search_form(){
  ob_start();
  include_once(TEMPLATEPATH.'/searchform.php');
  return ob_get_clean();
}
// [search-form]


add_filter( 'pre_get_posts', 'tgm_io_cpt_search' );
/**
 * This function modifies the main WordPress query to include an array of 
 * post types instead of the default 'post' post type.
 *
 * @param object $query  The original query.
 * @return object $query The amended query.
 */
function tgm_io_cpt_search( $query ) {
    
    if ( $query->is_search ) {
    $query->set( 'post_type', array( 'post', 'werke', 'artist' ) );
    }
    
    return $query;
    
}


add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);
function add_search_form($items, $args) {
if( ($args->theme_location == 'top-menu') OR ($args->theme_location == 'main-menu'))
        $items .= '<li class="search"><form class="search" method="get" action="'.home_url( '/' ).'" role="search"><input class="search-input" type="search" name="s" placeholder="Suchbegriff..."><button class="search-submit" type="submit" role="button"><i class="fa fa-search"></i></button></form></li>';
        return $items;
}

/*
Diverse Einstellungen
*/
 
// Diverse Einträge entfernen
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
 
// Generator-Angaben, z.B. im Feed, entfernen
function remove_wp_generator() { return ''; }
add_filter('the_generator','remove_wp_generator');
// prev+next Links in Beiträgen entfernen
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
 
// shortlink entfernen
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
 
// Post+Kommentar+Kategorie RSS Feed-Links entfernen (entfernt nicht die Feeds selbst)
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
 
// wp Versions-Parameter ?ver=... von Skripts entfernen, falls unsere WordPress-Version angegeben wird
function vc_remove_wp_ver_css_js( $src )
{
   if (  strpos($src, 'ver='. get_bloginfo('version') )  )
      $src = remove_query_arg('ver', $src);
   return $src;
}
add_filter('style_loader_src',  'vc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'vc_remove_wp_ver_css_js', 9999);
 
// Emoji js, css und dns-preload entfernen
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
add_filter('emoji_svg_url', '__return_false');
 
// REST Api Hinweise entfernen
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
 
function remove_json_api ()
{
   // REST API Zeilen aus dem HTML Header entfernen
   remove_action('wp_head', 'rest_output_link_wp_head', 10);
   remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
   // REST API endpoint entfernen
   remove_action('rest_api_init', 'wp_oembed_register_route');
   // oEmbed auto discovery entfernen
   add_filter('embed_oembed_discover', '__return_false');
   // oEmbed results nicht filtern
   remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
   // oEmbed discovery links entfernen
   remove_action('wp_head', 'wp_oembed_add_discovery_links');
   // oEmbed-JavaScript entfernen
   remove_action('wp_head', 'wp_oembed_add_host_js');
   // rewrite rules zum Einbetten entfernen
   //add_filter('rewrite_rules_array', 'disable_embeds_rewrites');
}
add_action('after_setup_theme', 'remove_json_api');

?>
