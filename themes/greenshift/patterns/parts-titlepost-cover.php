<?php
/**
 * Title: Post title area with Cover image
 * Slug: greenshift/parts-titlepost-cover
 * Categories: greenshift-parts
 * Block Types: core/template-part/titlepost
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"20px","margin":{"top":"0","bottom":"0"},"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"backgroundColor":"black","textColor":"white","layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-color has-black-background-color has-text-color has-background" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"useFeaturedImage":true,"dimRatio":50,"overlayColor":"primary","minHeight":220,"minHeightUnit":"px","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","right":"var:preset|spacing|20","left":"var:preset|spacing|20"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--20);min-height:220px"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"category","textAlign":"center","style":{"elements":{"link":{"color":{"text":"#ffe200"}}}},"className":"is-style-greenshift-tags-nounder","fontSize":"small"} /-->

<!-- wp:post-title {"textAlign":"center","level":1,"fontSize":"max-huge"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","allowOrientation":false,"justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:post-author {"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"small"} /-->

<!-- wp:paragraph {"textColor":"lightgrey","fontSize":"small"} -->
<p class="has-lightgrey-color has-text-color has-small-font-size">/</p>
<!-- /wp:paragraph -->

<!-- wp:post-date {"style":{"color":{"text":"#e9e9e9"}},"fontSize":"small"} /--></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->