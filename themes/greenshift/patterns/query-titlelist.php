<?php
/**
 * Title: Title lists
 * Slug: greenshift/query-titlelist
 * Categories: greenshift-query
 * Block Types: core/query
 */
?>
<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"20%"} -->
<div class="wp-block-column" style="flex-basis:20%"></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:query {"queryId":22,"query":{"perPage":"5","pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"list","columns":2},"align":"wide","className":"is-style-default"} -->
<div class="wp-block-query alignwide is-style-default"><!-- wp:post-template -->
<!-- wp:group {"style":{"spacing":{"blockGap":"10px","padding":{"top":"0","right":"0px","bottom":"var:preset|spacing|60","left":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|basecolor"}}},"border":{"bottom":{"color":"var:preset|color|lightborder","width":"1px"}}},"textColor":"lightgrey","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group has-lightgrey-color has-text-color has-link-color" style="border-bottom-color:var(--wp--preset--color--lightborder);border-bottom-width:1px;padding-top:0;padding-right:0px;padding-bottom:var(--wp--preset--spacing--60);padding-left:0"><!-- wp:post-terms {"term":"category","textAlign":"center","separator":"  ","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600"}},"className":"is-style-greenshift-tags-nounder","fontSize":"xsmall"} /-->

<!-- wp:post-title {"textAlign":"center","isLink":true,"style":{"typography":{"lineHeight":"1.4"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"className":"is-style-text-clamp-two","fontSize":"x-large"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","allowOrientation":false}} -->
<div class="wp-block-group"><!-- wp:post-author {"avatarSize":24,"fontSize":"xsmall"} /-->

<!-- wp:paragraph {"fontSize":"xsmall"} -->
<p class="has-xsmall-font-size">/</p>
<!-- /wp:paragraph -->

<!-- wp:post-date {"fontSize":"xsmall"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:spacer {"height":"35px"} -->
<div style="height:35px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"20%"} -->
<div class="wp-block-column" style="flex-basis:20%"></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->