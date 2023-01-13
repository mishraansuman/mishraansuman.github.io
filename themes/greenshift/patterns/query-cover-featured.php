<?php
/**
 * Title: Featured section with cover images
 * Slug: greenshift/query-cover-featured
 * Categories: greenshift-query
 * Block Types: core/query
 */
?>
<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide">
<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:query {"queryId":22,"query":{"perPage":"1","pages":"1","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"list","columns":2},"align":"wide","className":"is-style-gs-creativeoverlay"} -->
<div class="wp-block-query alignwide is-style-gs-creativeoverlay"><!-- wp:post-template -->
<!-- wp:cover {"useFeaturedImage":true,"minHeight":403,"minHeightUnit":"px","contentPosition":"bottom left","isDark":false,"style":{"color":{"duotone":["#000097","#ff4747"]}}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-left" style="min-height:403px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"10px","padding":{"top":"8px","right":"8px","bottom":"8px","left":"8px"}}}} -->
<div class="wp-block-group" style="padding-top:8px;padding-right:8px;padding-bottom:8px;padding-left:8px"><!-- wp:post-terms {"term":"category","separator":"  ","style":{"elements":{"link":{"color":{"text":"#f7f5ff"}}},"typography":{"textTransform":"uppercase"}},"className":"is-style-greenshift-tags-nounder","fontSize":"xsmall"} /-->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"lineHeight":"1.4"},"elements":{"link":{"color":{"text":"var:preset|color|textonprimary"}}}},"fontSize":"large"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","allowOrientation":false}} -->
<div class="wp-block-group"><!-- wp:post-author {"showAvatar":false,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"},"color":{"text":"#fcfcfc"}},"fontSize":"xsmall"} /-->

<!-- wp:paragraph {"fontSize":"xsmall"} -->
<p class="has-xsmall-font-size">/</p>
<!-- /wp:paragraph -->

<!-- wp:post-date {"style":{"color":{"text":"#c1cfdf"}},"fontSize":"xsmall"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:query {"queryId":22,"query":{"perPage":"4","pages":"1","offset":"1","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":2},"align":"wide","className":"is-style-gs-creativeoverlay"} -->
<div class="wp-block-query alignwide is-style-gs-creativeoverlay"><!-- wp:post-template -->
<!-- wp:cover {"useFeaturedImage":true,"dimRatio":50,"minHeight":190,"minHeightUnit":"px","contentPosition":"bottom left","isDark":false,"style":{"color":{}}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-left" style="min-height:190px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"10px","padding":{"top":"8px","right":"8px","bottom":"8px","left":"8px"}}}} -->
<div class="wp-block-group" style="padding-top:8px;padding-right:8px;padding-bottom:8px;padding-left:8px"><!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"lineHeight":"1.4"},"elements":{"link":{"color":{"text":"var:preset|color|textonprimary"}}}},"className":"is-style-text-clamp-two","fontSize":"subheading"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","allowOrientation":false}} -->
<div class="wp-block-group"><!-- wp:post-date {"format":null,"style":{"color":{"text":"#c1cfdf"}},"fontSize":"xsmall"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->