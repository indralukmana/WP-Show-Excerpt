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

function wpse_protected_excerpt( $excerpt ) {
    if ( post_password_required() ) {
        $post = get_post();
        $excerpt=$post->post_excerpt;
    }

    $excerpt = change_email($excerpt);

    return $excerpt;
}
add_filter( 'the_excerpt', 'wpse_protected_excerpt' );

function wpse_protected_excerpt_posts( $content ) {
    if ( post_password_required() && is_single() ) {
        $post = get_post();

        return change_email($post->post_excerpt.$content);
    }
    return change_email($content);
}
add_filter( 'the_content', 'wpse_protected_excerpt_posts', 10 );

function change_email($string) {
    $search  = array('/<p>__<\/p>/', '/([a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/');
    $replace = array('<hr />', '<a href="mailto:$1">$1</a>');
    $processed_string = preg_replace($search, $replace, $string);
    return $processed_string;
}