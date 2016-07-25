<!--▽ページボタン-->
<?php if ( $wp_query -> max_num_pages > 1 ) : ?>
<div id="pagenav" class="conte_bg">
    <ul>
	    <li><?php previous_posts_link('&laquo; PREV'); ?></li>
        <li><?php next_posts_link('NEXT &raquo;'); ?></li>
    </ul>
</div><!--/pabe_navi-->
<?php endif;?>
