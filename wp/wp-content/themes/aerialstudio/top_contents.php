<!--▽トッピックス-->
<h1 class="title">
	<span class="ttl">topics&nbsp;&amp;&nbsp;news</span>
    <span class="s_ttl">新着情報</span>
</h1>
<div class="topics_list">
<ul>
<?php
$args = array(
     'category' => 2, // カテゴリを指定
	 'posts_per_page' => 5, //表示される最大数
); ?>
<?php query_posts( $args ); ?>
<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
    <li id="post-<?php the_ID(); ?>">
        <a href="<?php the_permalink(); ?>">
        <span class="day"><?php the_time('Y/m/d'); ?></span>
        <span class="txt"><?php echo get_the_title(); ?></span>
        <?php //カテゴリの情報取得
		$cat = get_the_category();
		$cat = $cat[0];
		?>
        <span class="ico ico_t"><?php echo $cat->category_nicename; ?></span>
        </a>
    </li>
<?php endwhile; endif; ?>
<?php wp_reset_query(); ?>
</ul>
</div><!--/topics_list-->

<!--▽実績-->
<h1 class="title">
	<span class="ttl">results</span>
    <span class="s_ttl">実績</span>
</h1>
<div class="box_type1">
<ul>
<?php
$args = array(
     'post_type' => 'case', // 投稿タイプを指定
     'paged' => $paged,
	 'posts_per_page' => 4, //表示される最大数
); ?>
<?php query_posts( $args ); ?>
<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>

    <li id="post-<?php the_ID(); ?>">
    	<a href="<?php the_permalink(); ?>">
        <p class="img"><?php the_post_thumbnail('thumbnail', array( 'class' => 'pcimg100' )); ?></p>
        <p class="ttl"><?php echo get_the_title(); ?></p>
        <p class="txt"><?php the_excerpt(); ?></p>
        </a>
    </li>
<?php endwhile; endif; ?>

</ul>
</div><!--box_type1-->
