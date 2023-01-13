<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Greenshift Full Width
 *
 * @package greenshift
 * @since v.1.0
 *
 */
get_header();
while ( have_posts() ) : the_post();
	the_content();
endwhile; // End of the loop.

get_footer();