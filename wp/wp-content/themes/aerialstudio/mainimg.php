<!--▼mainimg-->   
<div class="mainimg">
    <div class="mainimg_inner w100">
<?php if(is_home()) : ?>
        <p class="pc_only"><img src="<?php echo home_url( '/' ); ?>img/mainimg.png" alt="PCのイメージ"></p>
        <p class="mobi_only"><img src="<?php echo home_url( '/' ); ?>img/mainimg_mobi.png" alt="スマホのイメージ" class="img100"></p>
<?php elseif(is_singular('case') || is_post_type_archive('case') || is_tax('case_cat')): //カスタム投稿 ?> 
    <div class="ttl">
        <span class="en">CASE</span>
        <span class="jp">-&nbsp;実 績&nbsp;-</span>
    </div><!--/ttl-->
    <p class="txt">グラフィックデザイン、ウェブデザインなど過去の実績を紹介します。</p>
<?php elseif(is_search()): ?>
    <div class="ttl">
        <span class="en">SEARCH</span>
        <span class="jp">-&nbsp;検 索&nbsp;-</span>
    </div><!--/ttl-->
    <p class="txt">招財小判COBAN サイト内検索結果</p>
<?php elseif(is_category()): ?>
	<?php //カテゴリの情報取得
    $cat_info = get_category( $cat );
    ?>
    <div class="ttl">
        <span class="en"><?php echo $cat_info->category_nicename; ?></span>
        <span class="jp">-&nbsp;<?php echo $cat_info->cat_name; ?>&nbsp;-</span>
    </div><!--/ttl-->
    <p class="txt"><?php echo nl2br($cat_info->category_description); ?></p>
<?php else : ?>
	<?php //カテゴリの情報取得
		$cat = get_the_category();
		$cat = $cat[0];
	?>    
    <div class="ttl">
        <span class="en"><?php echo $cat->category_nicename; ?></span>
        <span class="jp">-&nbsp;<?php echo $cat->cat_name; ?>&nbsp;-</span>
    </div><!--/ttl-->
    <p class="txt"><?php echo nl2br($cat->category_description); ?></p>
<?php endif ?>
    </div><!--/mainimg_inner-->
</div><!--/mainimg-->
<!--▲mainimg-->
