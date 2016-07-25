 <?php
    // クエリをリセットしておく
    wp_reset_query();

    // リンク作成用の無名関数を定義しておく
    $get_link_html = function ($url, $title) {
        return '<a href="'.$url.'">'.$title.'</a>';
    };

    // トップページへのリンクと、区切り文字を作成しておく
    $del_str = " &rsaquo; ";

    // パンくずリスト用変数
    $out = $get_link_html(home_url(), 'ホーム') . $del_str;

    if (is_home()) {
        // そのまま出力
    } elseif ( is_singular('post') ) {
        // 記事に紐づいたカテゴリIDを親カテゴリ->子カテゴリに並べ替える
        $cat_tree = get_categories_tree();
        foreach ($cat_tree as $cat_id) {
            $out .= $get_link_html(get_category_link($cat_id), get_cat_name($cat_id)) . $del_str;
        }
        $out .= $get_link_html(get_permalink(), get_the_title())
              . $del_str;
    } elseif ( is_singular('websites') ) {
        $posttype = 'websites';
        $out .= $get_link_html(get_post_type_archive_link($posttype), get_post_type_object($posttype)->label)
              . $del_str
              . $get_link_html(get_permalink(), get_the_title())
              . $del_str;
    } elseif ( is_singular() ) {
        $out .= $get_link_html(get_permalink(), get_the_title());
    } elseif ( is_category() ) {
        $cat_obj = get_queried_object();
        $out .= get_category_parents($cat_obj->term_id, false, $del_str);
    } elseif ( is_tag() ) {
        $tag_obj = get_queried_object();
        $out .= $get_link_html(get_tag_link($tag_obj->term_id), $tag_obj->name).$del_str;
    } elseif ( is_tax() ) {
        $tax_obj = get_queried_object();
        $out .= $get_link_html(get_term_link($tax_obj), $tax_obj->name).$del_str;
    } elseif ( is_post_type_archive() ) {
        $posttype = get_post_type();
        $out .= $get_link_html(get_post_type_archive_link($posttype), post_type_archive_title('None', false))
              . $del_str;
    } elseif ( is_archive() ) {
        $out .= 'アーカイブ';
    } elseif ( is_search() ) {
        $out .= '検索結果';
    } elseif ( is_404() ) {
        $out .= 'ページが見つかりません';
    } else {
        // そのまま出力
    }
    echo $out;

    // クエリをリセットしておく
    wp_reset_query();
?>