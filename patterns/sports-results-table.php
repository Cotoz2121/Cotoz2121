<?php
/**
 * Sports Results Table Pattern
 */
return [
    'slug'        => 'sports-results-table',
    'title'       => __('Match Results Table - جدول نتائج المباريات', 'starter-ai'),
    'description' => __('A table for displaying match results and standings', 'starter-ai'),
    'categories'  => ['zuhal-sports'],
    'keywords'    => ['sports', 'table', 'results', 'standings', 'ترتيب', 'نتائج'],
    'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"radius":"12px","color":"#e2e8f0","width":"1px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-color:#e2e8f0;border-width:1px;border-radius:12px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"20px","fontWeight":"700"}}} -->
<h3 class="wp-block-heading" style="font-size:20px;font-weight:700">🏆 ترتيب الدوري</h3>
<!-- /wp:heading -->
<!-- wp:table {"hasFixedLayout":true,"style":{"border":{"color":"#e2e8f0","width":"1px"}}} -->
<figure class="wp-block-table"><table class="has-fixed-layout" style="border-color:#e2e8f0;border-width:1px"><thead><tr><th>#</th><th>الفريق</th><th>لعب</th><th>فاز</th><th>تعادل</th><th>خسر</th><th>النقاط</th></tr></thead><tbody><tr><td>1</td><td>الفريق الأول</td><td>10</td><td>8</td><td>1</td><td>1</td><td><strong>25</strong></td></tr><tr><td>2</td><td>الفريق الثاني</td><td>10</td><td>7</td><td>2</td><td>1</td><td><strong>23</strong></td></tr><tr><td>3</td><td>الفريق الثالث</td><td>10</td><td>6</td><td>2</td><td>2</td><td><strong>20</strong></td></tr><tr><td>4</td><td>الفريق الرابع</td><td>10</td><td>5</td><td>3</td><td>2</td><td><strong>18</strong></td></tr></tbody></table></figure>
<!-- /wp:table -->
</div>
<!-- /wp:group -->',
];
