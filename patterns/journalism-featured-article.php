<?php
/**
 * Featured Article Layout Pattern
 */
return [
    'slug'        => 'journalism-featured-article',
    'title'       => __('Featured Article Layout - تخطيط المقال المميز', 'starter-ai'),
    'description' => __('A large featured article with image and overlay text', 'starter-ai'),
    'categories'  => ['zuhal-journalism'],
    'keywords'    => ['article', 'featured', 'news', 'مقال', 'أخبار'],
    'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns">
<!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%">
<!-- wp:cover {"dimRatio":40,"minHeight":400,"isDark":true,"style":{"border":{"radius":"12px"}}} -->
<div class="wp-block-cover is-dark" style="border-radius:12px;min-height:400px">
<span aria-hidden="true" class="wp-block-cover__background has-background-dim-40 has-background-dim"></span>
<div class="wp-block-cover__inner-container">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","fontWeight":"700"},"color":{"text":"#fbbf24","background":"#1e3a5f"}},"className":"inline-badge"} -->
<p class="inline-badge has-text-color has-background" style="background-color:#1e3a5f;color:#fbbf24;font-size:12px;font-weight:700">سياسة</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"28px","fontWeight":"700"},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-color" style="color:#ffffff;font-size:28px;font-weight:700">عنوان المقال الرئيسي المميز هنا</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"style":{"color":{"text":"#e2e8f0"},"typography":{"fontSize":"14px"}}} -->
<p class="has-text-color" style="color:#e2e8f0;font-size:14px">نبذة مختصرة عن المقال - وصف موجز يجذب القارئ لمتابعة القراءة</p>
<!-- /wp:paragraph -->
</div>
</div>
<!-- /wp:cover -->
</div>
<!-- /wp:column -->
<!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%">
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group">
<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}},"border":{"bottom":{"color":"#e2e8f0","width":"1px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="border-bottom-color:#e2e8f0;border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--20)">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p style="font-size:14px;font-weight:600">📰 عنوان خبر جانبي أول</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}},"border":{"bottom":{"color":"#e2e8f0","width":"1px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="border-bottom-color:#e2e8f0;border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--20)">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p style="font-size:14px;font-weight:600">📰 عنوان خبر جانبي ثاني</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}},"border":{"bottom":{"color":"#e2e8f0","width":"1px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="border-bottom-color:#e2e8f0;border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--20)">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p style="font-size:14px;font-weight:600">📰 عنوان خبر جانبي ثالث</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--20)">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p style="font-size:14px;font-weight:600">📰 عنوان خبر جانبي رابع</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->',
];
