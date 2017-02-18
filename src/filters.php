<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter( 'body_class', function ( array $classes ) {
	// Add page slug if it doesn't exist
	if ( is_single() || is_page() && ! is_front_page() ) {
		if ( ! in_array( basename( get_permalink() ), $classes ) ) {
			$classes[] = basename( get_permalink() );
		}
	}

	// Add class if sidebar is active
	if ( display_sidebar() ) {
		$classes[] = 'sidebar-primary';
	}

	return $classes;
} );

/**
 * Add "" to the excerpt
 */
add_filter( 'excerpt_more', function () {
	return '';
} );

/**
 * Template Hierarchy should search for .blade.php files
 */
array_map( function ( $type ) {
	add_filter( "{$type}_template_hierarchy", function ( $templates ) {
		return call_user_func_array( 'array_merge', array_map( function ( $template ) {
			$transforms         = [
				'%^/?(templates)?/?%'   => config( 'sage.disable_option_hack' ) ? 'templates/' : '',
				'%(\.blade)?(\.php)?$%' => ''
			];
			$normalizedTemplate = preg_replace( array_keys( $transforms ), array_values( $transforms ), $template );

			return [ "{$normalizedTemplate}.blade.php", "{$normalizedTemplate}.php" ];
		}, $templates ) );
	} );
}, [
	'index',
	'404',
	'archive',
	'author',
	'category',
	'tag',
	'taxonomy',
	'date',
	'home',
	'frontpage',
	'page',
	'paged',
	'search',
	'single',
	'singular',
	'attachment'
] );

/**
 * Render page using Blade
 */
add_filter( 'template_include', function ( $template ) {
	$data = array_reduce( get_body_class(), function ( $data, $class ) use ( $template ) {
		return apply_filters( "sage/template/{$class}/data", $data, $template );
	}, [] );
	echo template( $template, $data );

	// Return a blank file to make WordPress happy
	return get_theme_file_path( 'index.php' );
}, PHP_INT_MAX );

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter( 'comments_template', 'App\\template_path' );

/**
 * @param $length
 *
 * @return int
 */
function ir_excerpt_length( $length ) {
	return 10;
}

add_filter( 'excerpt_length', 'App\\ir_excerpt_length', 999 );

/**
 * Save total of reaction
 *
 * @param $return_value
 * @param $object_id
 * @param $meta_key
 * @param $meta_value
 * @param $unique
 *
 * @return null
 */
function ir_add_post_meta( $return_value, $object_id, $meta_key, $meta_value, $unique ) {
	if ( 'dw_reaction_haha' === $meta_key ) {
		$total_haha = get_post_meta( $object_id, 'dw_reaction_haha_total', true );
		if ( ! $total_haha ) {
			$total_haha = 0;
		}
		$return_update = update_post_meta( $object_id, 'dw_reaction_haha_total', ++ $total_haha );
	} elseif ( 'dw_reaction_love' === $meta_key ) {
		$total_love = get_post_meta( $object_id, 'dw_reaction_love_total', true );
		if ( ! $total_love ) {
			$total_love = 0;
		}
		$return_update = update_post_meta( $object_id, 'dw_reaction_love_total', ++ $total_love );
	} elseif ( 'dw_reaction_wow' === $meta_key ) {
		$total_wow = get_post_meta( $object_id, 'dw_reaction_wow_total', true );
		if ( ! $total_wow ) {
			$total_wow = 0;
		}
		$return_update = update_post_meta( $object_id, 'dw_reaction_wow_total', ++ $total_wow );
	} elseif ( 'dw_reaction_sad' === $meta_key ) {
		$total_sad = get_post_meta( $object_id, 'dw_reaction_sad_total', true );
		if ( ! $total_sad ) {
			$total_sad = 0;
		}
		$return_update = update_post_meta( $object_id, 'dw_reaction_sad_total', ++ $total_sad );
	} elseif ( 'dw_reaction_angry' === $meta_key ) {
		$total_angry = get_post_meta( $object_id, 'dw_reaction_angry_total', true );
		if ( ! $total_angry ) {
			$total_angry = 0;
		}
		$return_update = update_post_meta( $object_id, 'dw_reaction_angry_total', ++ $total_angry );
	}

	return $return_value;
}

add_action( 'add_post_metadata', 'App\\ir_add_post_meta', 10, 5 );

/**
 * Don't flood the database with individual reactions
 *
 * @param $mid
 * @param $object_id
 * @param $meta_key
 * @param $_meta_value
 */
function ir_remove_reactions( $mid, $object_id, $meta_key, $_meta_value ) {
	if ( strpos( $meta_key, '_total' ) <= 0 ) {
		delete_post_meta( $object_id, $meta_key );
	}
}
// This will delete all meta, even if has nothing to do with reactions
//add_action( 'added_post_meta', 'App\\ir_remove_reactions', 10, 4 );
