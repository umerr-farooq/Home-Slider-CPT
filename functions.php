<?php

// Register Custom Post Type Home Slider
function create_homeslider_cpt() {

	$labels = array(
		'name' => _x( 'Home Slider', 'Post Type General Name', 'textdomain' ),
		'singular_name' => _x( 'Home Slider', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => _x( 'Home Slider', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar' => _x( 'Home Slider', 'Add New on Toolbar', 'textdomain' ),
		'archives' => __( 'Home Slider Archives', 'textdomain' ),
		'attributes' => __( 'Home Slider Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Home Slider:', 'textdomain' ),
		'all_items' => __( 'All Home Slider', 'textdomain' ),
		'add_new_item' => __( 'Add New Home Slider', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Home Slider', 'textdomain' ),
		'edit_item' => __( 'Edit Home Slider', 'textdomain' ),
		'update_item' => __( 'Update Home Slider', 'textdomain' ),
		'view_item' => __( 'View Home Slider', 'textdomain' ),
		'view_items' => __( 'View Home Slider', 'textdomain' ),
		'search_items' => __( 'Search Home Slider', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Home Slider', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Home Slider', 'textdomain' ),
		'items_list' => __( 'Home Slider list', 'textdomain' ),
		'items_list_navigation' => __( 'Home Slider list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Home Slider list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Home Slider', 'textdomain' ),
		'description' => __( '', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-format-gallery',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'homeslider', $args );

}
add_action( 'init', 'create_homeslider_cpt', 0 );


// Shortcode for Home Slider
function homeslider_shortcode() {
    // Query for Home Slider posts
    $query = new WP_Query([
        'post_type' => 'homeslider',
        'posts_per_page' => -1,
    ]);

    // Start output buffering
    ob_start();

    if ($query->have_posts()) {
        echo '<div class="home-slider-wrapper">';

        while ($query->have_posts()) {
            $query->the_post();

            // Get fields
            $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $heading = get_the_title();
            $content = get_the_content();
            $excerpt = get_the_excerpt();

            // Output slider item
            echo '<div class="home-slider-item" style="background-image: url(' . esc_url($featured_image) . ');">';
            echo '<div class="container">';    
			echo '<div class="row">';    
			echo '<div class="col-md-12">';    
			echo '<div class="cont">';
                    echo '<h4>' . wp_kses_post($excerpt) . '</h4>';
					echo '<h2>' . wp_kses($heading, ['span' => []]) . '</h2>';
					echo '<p>' . wp_kses_post($content) . '</p>';
                    echo '<div class="buttons">';
                        echo '<a target="_blank" href="#" class="butn b-red">Order Online</a>';
                        echo '<a target="_blank" href="#" class="butn b-white">Make Reservation</a>';
                    echo '</div>';
                   
                echo '</div>';
			 echo '</div>';
			 echo '</div>';
			 echo '</div>';
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo '<p>No items found.</p>';
    }

    wp_reset_postdata();

    // Return the buffer content
    return ob_get_clean();
}
add_shortcode('homeslider', 'homeslider_shortcode');

?>
