<?php get_header(); ?>

<!--▼contents -->
<div id="contents">
<div id="contents_inner" class="w100">

<!--▼main -->
<div id="main" class="w100">
<div id="main_inner">

<!--▼archive_standard-->
<article class="article archive_original">
<!--▽実績-->
<h1 class="title">
	<span class="ttl">results</span>
    <span class="s_ttl">検索結果：<?php the_search_query(); ?></span>
</h1>
<div class="box_type3">
<ul>
<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
    <li>
        <p class="img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array( 'class' => 'pcimg100' )); ?></a></p>
        <div class="c_fix">
            <p class="ttl"><?php echo get_the_title(); ?></p>
            <p class="txt"><?php the_excerpt(); ?></p>
            <p class="btn"><a href="<?php the_permalink(); ?>">詳しく見る</a></p>
        </div><!--/c fix-->
    </li>
<?php endwhile;	else : ?>
	<h1 class="entry_header">記事はありません</h1>
	<div class="entry_body">
	    <p>お探しの記事は見つかりませんでした。</p>
    </div><!--/entry_body-->
<?php endif; ?>

</ul>
</div><!--box_type2-->

<?php get_template_part('pagenavi'); ?>

</article><!--archive original-->

<p>search</p>

</div><!--/main_inner-->
</div><!--/main-->
<!--▲main -->

<?php get_sidebar(); ?>

</div><!--/contents_inner-->
</div><!--/contents-->
<!--▲contents -->

<?php get_footer(); ?>
