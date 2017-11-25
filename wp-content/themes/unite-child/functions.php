<?php

/*
* This file has custom functions for Unite Child theme
*/





/*
* It will create Genre, Country, Year and Actors taxonomies in "Films" post type in single function
*/
function create_custom_taxonomies() {

	$taxonomies = array( 
							"Genre"	=>	"Genres", 
							"Country"	=>	"Countries", 
							"Year"	=>	"Years", 
							"Actor"	=>	"Actors" 
						);

	foreach($taxonomies as $single => $plural){

		$labels = array(
			'name'                           => $single,
			'singular_name'                  => $single,
			'search_items'                   => 'Search ' . $plural,
			'all_items'                      => 'All ' . $plural,
			'edit_item'                      => 'Edit ' . $single,
			'update_item'                    => 'Update ' . $single,
			'add_new_item'                   => 'Add New ' . $single,
			'new_item_name'                  => 'New ' . $single . ' Name',
			'menu_name'                      => $single,
			'view_item'                      => 'View ' . $single,
			'popular_items'                  => 'Popular ' . $single,
			'separate_items_with_commas'     => 'Separate ' . $plural . ' with commas',
			'add_or_remove_items'            => 'Add or remove ' . $plural,
			'choose_from_most_used'          => 'Choose from the most used ' . $plural,
			'not_found'                      => 'No ' . $single . ' found'
		);

		register_taxonomy(
			$single,
			'films',
			array(
				'label' => __( $single ),
				'hierarchical' => true,
				'labels' => $labels,
				'public' => true,
				'show_in_nav_menus' => false,
				'show_tagcloud' => false,
				'show_admin_column' => true,
				'rewrite' => array(
					'slug' => strtolower($single)
				)
			)
		);
	}
}

add_action( 'init', 'create_custom_taxonomies' );








/*
* This function will return single or multple values separated by commas
*/
function get_taxonomy_value($post_id, $taxonomy){

	$value = array();
	$terms = wp_get_object_terms($post_id, $taxonomy);
	if(!empty($terms)){
	  foreach($terms as $term){
	    $value[] = $term->name;
	  }
	}

	return implode(", ", $value);
}





/*
* Add "Country", "Genre", "Ticket Price", "Release Date" at list of films
*/
function add_data_in_film_list($content){

	if(in_the_loop() && !is_single()){

		$content .= '
		<div class="entry-meta-values">
			<div class="d-block">
			  <span class="d-inline-block"><b>Country:</b></span>
			  <span class="d-inline-block">' . get_taxonomy_value(get_the_ID(), "Country") . '</span>
			</div>

			<div class="d-block">
			  <span class="d-inline-block"><b>Genre:</b></span>
			  <span class="d-inline-block">' . get_taxonomy_value(get_the_ID(), "Genre") . '</span>
			</div>

			<div class="d-block">
			  <span class="d-inline-block"><b>Ticket Price:</b></span>
			  <span class="d-inline-block">$' . get_field('ticket_price', get_the_ID()) . '</span>
			</div>

			<div class="d-block">
			  <span class="d-inline-block"><b>Release Date:</b></span>
			  <span class="d-inline-block">' . get_field('release_date', get_the_ID()) . '</span>
			</div>
		</div>';
	}

    return $content;
}
add_filter( "the_content", "add_data_in_film_list" );





function latest_film_shortcode($atts, $content){
	$atts = array(
				'posts_per_page'	=>	'5',
				'post_type'			=>	'films'
			);

	global $post;

	$posts = new WP_Query($atts);
	$output = '';

	if ($posts->have_posts()){

	    $output = '<ul>';

	    while ($posts->have_posts()){

	        $posts->the_post();
	        $output .= '<li><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() .'</a></li>';
		
		}

		$output .= '</ul>';


	}else{
		return; // no posts found
	}

	wp_reset_query();
	return html_entity_decode($output);
}
add_shortcode('latest_films', 'latest_film_shortcode');









/*
* Enqueue parent styles of Unite theme
*/
function unite_theme_enqueue_styles() {

	wp_dequeue_style('unite-style');

    $parent_style = 'unite-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'unite-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'unite-bootstrap' ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'unite_theme_enqueue_styles' );









/*
* Creating a function to create custom post type "Films"
*/
function create_films_posttype() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Films', 'Post Type General Name', 'unite' ),
        'singular_name'       => _x( 'Film', 'Post Type Singular Name', 'unite' ),
        'menu_name'           => __( 'Films', 'unite' ),
        'parent_item_colon'   => __( 'Parent Film', 'unite' ),
        'all_items'           => __( 'All Films', 'unite' ),
        'view_item'           => __( 'View Film', 'unite' ),
        'add_new_item'        => __( 'Add New Film', 'unite' ),
        'add_new'             => __( 'Add New', 'unite' ),
        'edit_item'           => __( 'Edit Film', 'unite' ),
        'update_item'         => __( 'Update Film', 'unite' ),
        'search_items'        => __( 'Search Film', 'unite' ),
        'not_found'           => __( 'Not Found', 'unite' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'unite' ),
    );
     
     
    $args = array(
        'label'               => __( 'Films', 'unite' ),
        'description'         => __( 'Film news and reviews', 'unite' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'genres' ),

        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'Films', $args );
 
}
add_action( 'init', 'create_films_posttype', 0 );












?>