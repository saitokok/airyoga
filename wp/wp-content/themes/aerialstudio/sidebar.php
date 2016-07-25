<!--▼side -->
<div id="side" class="w100">
<div id="side_inner">

<!--▽サイド検索-->
<div class="side_menu">
    <h1 class="side_ttl">SERACH<span>サイト内検索</span></h1>
    <div class="side_searchform">
        <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="text" class="field" name="s" id="s" onblur="if (value == '')  {value = 'Search...';}" onfocus="if (value == 'Search...') value = '';" />
        <input type="submit" class="btn btn-detail" name="submit" value="検索" />
        </form>
    </div><!--/side_searchform-->
</div><!--/side_menu-->

<?php if( is_category( array(2,17,18)) ) : //カテゴリー2 17 18 のときのみ表示 ?>
<!--▽サイドメニュー-->
<div class="side_menu">
	<h1 class="side_ttl">INFO MENU<span>お知らせメニュー</span></h1>
    <ul>
    	<?php wp_list_categories('orderby=id&use_desc_for_title=0&title_li=&child_of=2'); ?>
    </ul>
</div><!--/side_menu-->
<?php endif; ?>

<!--▽サイドメニュー-->
<div class="side_menu">
	<h1 class="side_ttl">CASE MENU<span>実 績</span></h1>
    <ul>
    	<?php wp_list_categories('title_li=&taxonomy=case_cat'); ?>
    </ul>
</div><!--/side_menu-->

<!--▽新着記事-->
<div class="side_menu">
	<h1 class="side_ttl">NEW<span>新着記事</span></h1>
<ul>
<?php
$args = array(
     'post_type' => 'post', // 投稿タイプを指定
	 'category'  => '2',
     'paged' => $paged,
	 'posts_per_page' => 10, //表示される最大数
); ?>
<?php query_posts( $args ); ?>
<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
<?php endwhile;	else : ?>
	    <li>お探しの記事は見つかりませんでした。</li>
<?php endif; ?>

</ul>
</div><!--/新着記事-->

<!--▽サイド会社情報-->
<div class="side_conpany">
    <p class="f1">COBAN</p>
    <p class="f2">powereight.inc.</p>
    <p class="f3"><span class="tel-link">054-270-8239</span></p>
    <p class="f4">14-5 Tegoshihara Suruga-ku Shizuoka-City Japan Zip 4210131</p>
    <p class="f5"><a href="<?php echo home_url( '/' ); ?>mailform/">CONTACT US</a></p>
</div><!--/side_conpany-->

<div class="side_menu insta">
[instagram-feed id="9763407"]
</div><!--/instagram feed-->

</div><!--/side_inner-->
</div><!--/side-->
<!--▲side -->
