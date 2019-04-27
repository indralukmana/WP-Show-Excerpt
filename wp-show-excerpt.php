<?php
/*
Plugin Name: WP Show Excerpt
Plugin URI:  https://github.com/indralukmana/WP-Show-Excerpt
Description: This plugin will show the excerpt of password protected content
Version:     1.0
Author:      Indra Lukmana
Author URI:  http://indralukmana.com
License:     GPL2 etc
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
*/

function wpb_protected_excerpt( $excerpt ) {
    if ( post_password_required() ) {
    $post = get_post();
    $excerpt=$post->post_excerpt;
    }
    return $excerpt;
}
add_filter( 'the_excerpt', 'wpb_protected_excerpt' );

function wpb_protected_excerpt_posts( $content ) {
    if ( post_password_required() && is_single() ) {
    $post = get_post();

    return $post->post_excerpt.$content;
    }
    return $content;
}
add_filter( 'the_content', 'wpb_protected_excerpt_posts', 10 );