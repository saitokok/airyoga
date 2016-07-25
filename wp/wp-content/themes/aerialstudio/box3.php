<!--▼archive_standard-->
<article class="article archive_original">
<!--▽実績-->
<h1 class="title">
	<span class="ttl">results</span>
    <span class="s_ttl">実績</span>
</h1>
<div class="box_type2">
<ul>
<?php
$args = array(
     'post_type' => 'case', // 投稿タイプを指定
     'paged' => $paged,
	 'posts_per_page' => 9, //表示される最大数
); ?>
<?php query_posts( $args ); ?>
<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
    <li>
    	<a href="<?php the_permalink(); ?>">
        <p class="img"><?php the_post_thumbnail('thumbnail', array( 'class' => 'pcimg100' )); ?></p>
        <p class="ttl"><?php echo get_the_title(); ?></p>
        <p class="txt"><?php the_excerpt(); ?></p>
        </a>
    </li>
<?php endwhile;	else : ?>
	<h1 class="entry_header">記事はありません</h1>
	<div class="entry_body">
	    <p>お探しの記事は見つかりませんでした。</p>
    </div><!--/entry_body-->
<?php endif; ?>

</ul>
</div><!--box_type2-->

<!--▽ページボタン-->
<?php if ( $wp_query -> max_num_pages > 1 ) : ?>
<div id="pagenav" class="conte_bg">
    <ul>
        <li><?php next_posts_link('&laquo; PREV'); ?></li>
	    <li><?php previous_posts_link('NEXT &raquo;'); ?></li>
    </ul>
</div><!--/pabe_navi-->
<?php endif;?>

</article><!--archive original-->

