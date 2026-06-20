<?php
/**
 * Sports Scoreboard Pattern
 */
return [
    'slug'        => 'sports-scoreboard',
    'title'       => __('Sports Scoreboard - لوحة النتائج الرياضية', 'starter-ai'),
    'description' => __('Match scoreboard layout for sports content', 'starter-ai'),
    'categories'  => ['zuhal-sports'],
    'keywords'    => ['sports', 'match', 'score', 'رياضة', 'مباراة', 'نتيجة'],
    'content'     => '<!-- wp:group {"style":{"color":{"background":"#0f172a","text":"#ffffff"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"radius":"16px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-text-color has-background" style="border-radius:16px;color:#ffffff;background-color:#0f172a;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)">
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"12px","fontWeight":"600","textTransform":"uppercase"},"color":{"text":"#94a3b8"}}} -->
<p class="has-text-align-center has-text-color" style="color:#94a3b8;font-size:12px;font-weight:600;text-transform:uppercase">⚽ مباراة اليوم - الجولة 3</p>
<!-- /wp:paragraph -->
<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center","width":"35%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:35%">
<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"24px","fontWeight":"700"},"color":{"text":"#ffffff"}}} -->
<h3 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;font-size:24px;font-weight:700">الفريق الأول</h3>
<!-- /wp:heading -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center","width":"30%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:30%">
<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"48px","fontWeight":"800"},"color":{"text":"#fbbf24"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#fbbf24;font-size:48px;font-weight:800">2 - 1</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"12px"},"color":{"text":"#10b981"}}} -->
<p class="has-text-align-center has-text-color" style="color:#10b981;font-size:12px">🔴 مباشر - الشوط الثاني 75\'</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center","width":"35%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:35%">
<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontSize":"24px","fontWeight":"700"},"color":{"text":"#ffffff"}}} -->
<h3 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;font-size:24px;font-weight:700">الفريق الثاني</h3>
<!-- /wp:heading -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
<!-- wp:separator {"style":{"color":{"background":"#334155"}},"className":"is-style-wide"} -->
<hr class="wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide" style="background-color:#334155;color:#334155"/>
<!-- /wp:separator -->
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"13px"},"color":{"text":"#94a3b8"}}} -->
<p class="has-text-align-center has-text-color" style="color:#94a3b8;font-size:13px">الأهداف: اللاعب الأول (23\') - اللاعب الثاني (67\') | اللاعب الثالث (45\')</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->',
];
