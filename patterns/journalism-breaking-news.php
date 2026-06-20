<?php
/**
 * Breaking News Banner Pattern
 */
return [
    'slug'        => 'journalism-breaking-news',
    'title'       => __('Breaking News Banner - شريط الأخبار العاجلة', 'starter-ai'),
    'description' => __('A prominent breaking news banner with red accent', 'starter-ai'),
    'categories'  => ['zuhal-journalism'],
    'keywords'    => ['news', 'breaking', 'urgent', 'أخبار', 'عاجل'],
    'content'     => '<!-- wp:group {"style":{"color":{"background":"#dc2626"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#dc2626;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--30)">
<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center","width":"120px"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:120px">
<!-- wp:paragraph {"style":{"typography":{"fontWeight":"800","fontSize":"14px"},"color":{"text":"#ffffff"},"elements":{"link":{"color":{"text":"#ffffff"}}}},"backgroundColor":"transparent"} -->
<p class="has-text-color" style="color:#ffffff;font-size:14px;font-weight:800">⚡ عاجل</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"16px","fontWeight":"600"}}} -->
<p class="has-text-color" style="color:#ffffff;font-size:16px;font-weight:600">اكتب هنا نص الخبر العاجل - Breaking news text goes here</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->',
];
