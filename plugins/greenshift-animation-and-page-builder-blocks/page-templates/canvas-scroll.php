<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Greenshift Template Canvas
 *
 * @package greenshift
 * @since v.1.0
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <?php if (!current_theme_supports('title-tag')) : ?>
        <title><?php echo wp_get_document_title(); ?></title>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php 
        $the_content = apply_filters( 'the_content', get_the_content() );
        if(strpos($the_content, 'gsmooth-chars') !== false){
            wp_enqueue_script('gsapsplittext');
        }
    ?>
    <?php wp_enqueue_script('gsapsmoothscroll-init'); ?>
    <div id="smooth-wrapper">
        <div id="smooth-content" data-fixclass="gspb_dotnav_list">
            <?php wp_body_open(); ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="entry-content wp-block-post-content">
                    <?php echo ''.$the_content.''; ?>
                </div>
            <?php endwhile; ?>
            <?php wp_footer(); ?>
        </div>
    </div>
</body>

</html>