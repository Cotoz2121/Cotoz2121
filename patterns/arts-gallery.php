<?php
/**
 * Arts Gallery Pattern
 */
return [
    'slug'        => 'arts-gallery',
    'title'       => __('Arts Gallery Grid - معرض الفنون', 'starter-ai'),
    'description' => __('A visual gallery grid for arts and culture content', 'starter-ai'),
    'categories'  => ['zuhal-arts'],
    'keywords'    => ['art', 'gallery', 'culture', 'فن', 'ثقافة', 'معرض'],
    'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}},"color":{"background":"#faf5ff"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#faf5ff;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
<!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"32px","fontWeight":"700"}}} -->
<h2 class="wp-block-heading has-text-align-center" style="font-size:32px;font-weight:700">🎨 معرض الفنون والثقافة</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#6b7280"},"typography":{"fontSize":"16px"}}} -->
<p class="has-text-align-center has-text-color" style="color:#6b7280;font-size:16px">استكشف أحدث الأعمال الفنية والثقافية</p>
<!-- /wp:paragraph -->
<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|20"}}}} -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:cover {"dimRatio":30,"minHeight":300,"isDark":true,"style":{"border":{"radius":"16px"}}} -->
<div class="wp-block-cover is-dark" style="border-radius:16px;min-height:300px">
<span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span>
<div class="wp-block-cover__inner-container">
<!-- wp:heading {"level":3,"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"20px"}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#ffffff;font-size:20px">عنوان العمل الفني</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"style":{"color":{"text":"#e2e8f0"},"typography":{"fontSize":"13px"}}} -->
<p class="has-text-color" style="color:#e2e8f0;font-size:13px">الفنان: اسم الفنان</p>
<!-- /wp:paragraph -->
</div>
</div>
<!-- /wp:cover -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:cover {"dimRatio":30,"minHeight":300,"isDark":true,"style":{"border":{"radius":"16px"}}} -->
<div class="wp-block-cover is-dark" style="border-radius:16px;min-height:300px">
<span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span>
<div class="wp-block-cover__inner-container">
<!-- wp:heading {"level":3,"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"20px"}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#ffffff;font-size:20px">عنوان العمل الفني</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"style":{"color":{"text":"#e2e8f0"},"typography":{"fontSize":"13px"}}} -->
<p class="has-text-color" style="color:#e2e8f0;font-size:13px">الفنان: اسم الفنان</p>
<!-- /wp:paragraph -->
</div>
</div>
<!-- /wp:cover -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:cover {"dimRatio":30,"minHeight":300,"isDark":true,"style":{"border":{"radius":"16px"}}} -->
<div class="wp-block-cover is-dark" style="border-radius:16px;min-height:300px">
<span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span>
<div class="wp-block-cover__inner-container">
<!-- wp:heading {"level":3,"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"20px"}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#ffffff;font-size:20px">عنوان العمل الفني</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"style":{"color":{"text":"#e2e8f0"},"typography":{"fontSize":"13px"}}} -->
<p class="has-text-color" style="color:#e2e8f0;font-size:13px">الفنان: اسم الفنان</p>
<!-- /wp:paragraph -->
</div>
</div>
<!-- /wp:cover -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->',
];
