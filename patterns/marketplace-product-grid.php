<?php
/**
 * Marketplace Product Grid Pattern
 */
return [
    'slug'        => 'marketplace-product-grid',
    'title'       => __('Product Grid - شبكة المنتجات', 'starter-ai'),
    'description' => __('Product cards grid for marketplace / buy and sell', 'starter-ai'),
    'categories'  => ['zuhal-marketplace'],
    'keywords'    => ['marketplace', 'products', 'buy', 'sell', 'بيع', 'شراء', 'منتجات'],
    'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
<!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"28px","fontWeight":"700"}}} -->
<h2 class="wp-block-heading has-text-align-center" style="font-size:28px;font-weight:700">🛒 أحدث العروض</h2>
<!-- /wp:heading -->
<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|20"}}}} -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"style":{"border":{"radius":"12px","color":"#e2e8f0","width":"1px"},"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|30","left":"0","right":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-color:#e2e8f0;border-width:1px;border-radius:12px;padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--30);padding-left:0">
<!-- wp:cover {"dimRatio":0,"minHeight":200,"isDark":false,"style":{"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} -->
<div class="wp-block-cover is-light" style="border-top-left-radius:12px;border-top-right-radius:12px;min-height:200px">
<span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
<div class="wp-block-cover__inner-container">
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">صورة المنتج</p>
<!-- /wp:paragraph -->
</div>
</div>
<!-- /wp:cover -->
<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|20","right":"var:preset|spacing|20","top":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","fontWeight":"600"},"color":{"text":"#2563eb","background":"#eff6ff"}}} -->
<p class="has-text-color has-background" style="background-color:#eff6ff;color:#2563eb;font-size:12px;font-weight:600">إلكترونيات</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"16px","fontWeight":"700"}}} -->
<h4 class="wp-block-heading" style="font-size:16px;font-weight:700">اسم المنتج الأول</h4>
<!-- /wp:heading -->
<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"20px","fontWeight":"800"},"color":{"text":"#10b981"}}} -->
<p class="has-text-color" style="color:#10b981;font-size:20px;font-weight:800">$299</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"align":"left","style":{"typography":{"fontSize":"12px"},"color":{"text":"#6b7280"}}} -->
<p class="has-text-align-left has-text-color" style="color:#6b7280;font-size:12px">📍 الرياض</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"style":{"border":{"radius":"12px","color":"#e2e8f0","width":"1px"},"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|30","left":"0","right":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-color:#e2e8f0;border-width:1px;border-radius:12px;padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--30);padding-left:0">
<!-- wp:cover {"dimRatio":0,"minHeight":200,"isDark":false,"style":{"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} -->
<div class="wp-block-cover is-light" style="border-top-left-radius:12px;border-top-right-radius:12px;min-height:200px">
<span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
<div class="wp-block-cover__inner-container">
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">صورة المنتج</p>
<!-- /wp:paragraph -->
</div>
</div>
<!-- /wp:cover -->
<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|20","right":"var:preset|spacing|20","top":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","fontWeight":"600"},"color":{"text":"#7c3aed","background":"#f5f3ff"}}} -->
<p class="has-text-color has-background" style="background-color:#f5f3ff;color:#7c3aed;font-size:12px;font-weight:600">سيارات</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"16px","fontWeight":"700"}}} -->
<h4 class="wp-block-heading" style="font-size:16px;font-weight:700">اسم المنتج الثاني</h4>
<!-- /wp:heading -->
<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"20px","fontWeight":"800"},"color":{"text":"#10b981"}}} -->
<p class="has-text-color" style="color:#10b981;font-size:20px;font-weight:800">$15,000</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"align":"left","style":{"typography":{"fontSize":"12px"},"color":{"text":"#6b7280"}}} -->
<p class="has-text-align-left has-text-color" style="color:#6b7280;font-size:12px">📍 جدة</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"style":{"border":{"radius":"12px","color":"#e2e8f0","width":"1px"},"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|30","left":"0","right":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-color:#e2e8f0;border-width:1px;border-radius:12px;padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--30);padding-left:0">
<!-- wp:cover {"dimRatio":0,"minHeight":200,"isDark":false,"style":{"border":{"radius":{"topLeft":"12px","topRight":"12px"}}}} -->
<div class="wp-block-cover is-light" style="border-top-left-radius:12px;border-top-right-radius:12px;min-height:200px">
<span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
<div class="wp-block-cover__inner-container">
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">صورة المنتج</p>
<!-- /wp:paragraph -->
</div>
</div>
<!-- /wp:cover -->
<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|20","right":"var:preset|spacing|20","top":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","fontWeight":"600"},"color":{"text":"#ea580c","background":"#fff7ed"}}} -->
<p class="has-text-color has-background" style="background-color:#fff7ed;color:#ea580c;font-size:12px;font-weight:600">عقارات</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"16px","fontWeight":"700"}}} -->
<h4 class="wp-block-heading" style="font-size:16px;font-weight:700">اسم المنتج الثالث</h4>
<!-- /wp:heading -->
<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"20px","fontWeight":"800"},"color":{"text":"#10b981"}}} -->
<p class="has-text-color" style="color:#10b981;font-size:20px;font-weight:800">$850,000</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"align":"left","style":{"typography":{"fontSize":"12px"},"color":{"text":"#6b7280"}}} -->
<p class="has-text-align-left has-text-color" style="color:#6b7280;font-size:12px">📍 دبي</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
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
