<!--▼archive_standard-->
<article class="article archive_standard">
<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
<section class="entry">
    <h1 class="entry_header"><span><?php echo get_the_title(); ?></span></h1>

    <?php if( get_field('entry_mainimg') ): ?>
    <!--▽メイン画像-->
    <div class="entry_img">
        <img src="<?php the_field('entry_mainimg'); ?>">
    </div><!--entry mainimg-->
    <?php endif; ?>
    
    <div class="entry_body" id="post-<?php the_ID(); ?>">
        <?php the_content(); ?>
        
        <?php get_template_part('googlemap'); ?>   

    </div><!--/entry_body-->
</section><!--/entry-->
<?php endwhile;	else : ?>
<section class="entry">
	<h1 class="entry_header">記事はありません</h1>
	<div class="entry_body">
	    <p>お探しの記事は見つかりませんでした。</p>
    </div><!--/entry_body-->
    <div class="botton page_back"><p><a href="javascript:history.back()">前のページに戻る</a></p></div>
</section><!--/entry-->
<?php endif;?>

</article><!--archive standard-->

