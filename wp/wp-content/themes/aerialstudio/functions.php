<?php
//基本設定
// WordPressのバージョンを消す
remove_action('wp_head','wp_generator');
// head内の絵文字スクリプトを消す //
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles');
//その他
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_print_styles',8);

remove_filter('the_excerpt', 'wpautop'); // pタグ自動挿入解除

//　パスワード保護ページの「保護中」の文字を消す
add_filter('protected_title_format', 'remove_protected');
function remove_protected($title) {
       return '%s';
}

// アイキャッチ（サムネイル）関連 //
add_theme_support( 'post-thumbnails' );

// カスタマイザーの利用設定
add_theme_support( 'custom-background' );

// カスタムヘッダー（ロゴ）の設置 //
$custom_header_params = array(
        'default-image'          => get_bloginfo('url').'/img/logo.jpg',
        'width'                  => 240,
        'height'                 => 60,
        'header-text'            => false,
);
add_theme_support( 'custom-header', $custom_header_params );

// カスタムメニュー
add_theme_support( 'menus' );

// 固定ページにカテゴリーを設定
function add_categorie_to_pages(){
 register_taxonomy_for_object_type('category', 'page');
}
add_action('init','add_categorie_to_pages');
 
// カテゴリーアーカイブに固定ページを含める
function add_page_to_category_archive( $query ) {
if ( $query->is_category== true && $query->is_main_query() ) {
$query->set('post_type', array( 'post', 'page' ));
}
}
add_action( 'pre_get_posts', 'add_page_to_category_archive' );

// 固定ページにタグを設定
function add_tag_to_page() {
 register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_tag_to_page');
 
// タグアーカイブに固定ページを含める
function add_page_to_tag_archive( $obj ) {
 if ( is_tag() ) {
 $obj->query_vars['post_type'] = array( 'post', 'page' );
 }
}
add_action( 'pre_get_posts', 'add_page_to_tag_archive' );

// 個別投稿表示以外のURLの末尾にスラッシュ追加
add_filter( 'user_trailingslashit', 'hook_user_trailingslashit', 10, 2 );
if ( ! function_exists( 'hook_user_trailingslashit' ) ) :
    function hook_user_trailingslashit( $string, $type_of_url ) {
        // 個別投稿のURLには.htmlが付くので、個別投稿以外にスラッシュを付与
        if ( $type_of_url != 'single' ) {
            $string = trailingslashit( $string );
        }
        return $string;
    }
endif;

// head関連
// 共通
function head_common() {
  echo '<link rel="stylesheet" href="'.get_bloginfo('url').'/css/base.css">' . "\n";
  echo '<link rel="stylesheet" href="'.get_bloginfo('url').'/css/style.css">' . "\n";
  echo '<link rel="shortcut icon" href="'.get_bloginfo('url').'/img/favicon.png">' . "\n";
  echo '<link rel="apple-touch-icon" href="'.get_bloginfo('url').'/img/apple-touch-icon.png">' . "\n";
}
add_action('wp_head','head_common');

// title
function get_title() {
  global $post;
  $title = "";
  if ( is_home() ) {
    // ホームでは、ブログ名を取得
    $title = get_bloginfo( 'name' );
  }
  elseif ( is_category() ) {
    // カテゴリーページでは、カテゴリー名を取得
    $title = single_cat_title('', false) . '&nbsp;&#124;&nbsp;' . get_bloginfo( 'name' );
  }
  elseif ( is_single() || is_page() ) {
    // ページでは、ページタイトルを取得
    $title = get_the_title() . '&nbsp;&#124;&nbsp;' . get_bloginfo( 'name' );
  }
  elseif ( is_search() ) {
    // 検索結果
    $title = '検索結果' . '&nbsp;&#124;&nbsp;' . get_bloginfo( 'name' );
  } 
  else {
	  ;
  }
 
  return $title;
}
 
// echo title tag
function echo_title_tag() {
  if ( is_home() || is_category() || is_single() || is_page() || is_search() ) {
    echo '<title>' . get_title() . '</title>' . "\n";
  }
}
add_action('wp_head', 'echo_title_tag');

// meta description
function get_meta_description() {
  global $post;
  $description = "";
  if ( is_home() ) {
    // ホームでは、ブログの説明文を取得
    $description = get_bloginfo( 'description' );
  }
  elseif ( is_category() ) {
    // カテゴリーページでは、カテゴリーの説明文を取得
    $description = category_description();
  }
  elseif ( is_single() || is_page() || is_tax() || is_archive() ) {
    if ($post->post_excerpt) {
      // 記事ページでは、記事本文から抜粋を取得
      $description = $post->post_excerpt;
    } else {
      // post_excerpt で取れない時は、自力で記事の冒頭100文字を抜粋して取得
      $description = strip_tags($post->post_content);
      $description = str_replace("\n", "", $description);
      $description = str_replace("\r", "", $description);
      $description = mb_substr($description, 0, 100) . "...";
    }
  } else {
    ;
  }
 
  return $description;
}
 
// echo meta description tag
function echo_meta_description_tag() {
  if ( is_home() || is_category() || is_single() || is_page() || is_tax() || is_archive() ) {
    echo '<meta name="description" content="' . get_meta_description() . '">' . "\n";
  }
}
add_action('wp_head', 'echo_meta_description_tag');

// meta keywords
function get_meta_keywords() {
  global $post;
  $keywords = "";
  if ( is_home() ) {
    // ホームでは meta keywords にブログ名を設定
    $keywords = get_bloginfo( 'name' );
  }
  elseif ( is_category() ) {
    // カテゴリーページではカテゴリー名を設定
    $keywords = single_cat_title('', false);
  }
  elseif ( is_single() || is_page() || is_tax() || is_archive() ) {
    $custom_fields = get_post_custom();
    if ( isset($custom_fields['keywords']) ) {
      // 記事ページでは keywords カスタムフィールドの値を取得して設定
      $keywords = get_post_meta($post->ID, 'keywords', true);
    } else {
      // keywords カスタムフィールドが空ならカテゴリー名を設定
      foreach( get_the_category() as $index => $category ) {
        if ($index >= 1) {
          $keywords .= ',';
        }
        $keywords .= $category->cat_name;
      }
    }
  } else {
    ;
  }
 
  return $keywords;
}
 
// meta keywords のタグを出力する関数
function echo_meta_keywords_tag() {
  if ( is_home() || is_category() || is_single() || is_page() || is_tax() || is_archive()  ) {
    echo '<meta name="keywords" content="' . get_meta_keywords() . '" />' . "\n";
  }
}
add_action('wp_head', 'echo_meta_keywords_tag');

// OGP
function head_ogp() {
echo '<!-- OGP -->' . "\n";
echo '<meta property="og:type" content="blog">'."\n";

if (is_single()){//単一記事ページの場合

	if(have_posts()): while(have_posts()): the_post();
		echo '<meta property="og:description" content="'.get_post_meta($post->ID, _aioseop_description, true).'">'."\n";//抜粋を表示
	endwhile; endif;
		echo '<meta property="og:title" content="'.get_the_title().'">'."\n"; //単一記事タイトルを表示
		echo '<meta property="og:url" content="'.get_permalink().'">'."\n"; //単一記事URLを表示
		
} else if( is_page() || is_singular('case') || is_tax() || is_archive() ){ //ページ、カスタム投稿の場合
		echo '<meta property="og:description" content="'.get_meta_description().'">'."\n";//抜粋を表示
		echo '<meta property="og:title" content="'.get_the_title().'">'."\n"; //タイトルを表示
		echo '<meta property="og:url" content="'.get_permalink().'">'."\n"; //URLを表示
		
} else{//単一記事ページページ以外の場合（アーカイブページやホームなど）
		echo '<meta property="og:description" content="'.get_bloginfo('description').'">'."\n"; //ブログの説明文を表示
		echo '<meta property="og:title" content="'.get_bloginfo('name').'">'."\n"; //ブログのタイトルを表示
		echo '<meta property="og:url" content="'.get_bloginfo('url').'">'. "\n"; //ブログのURLを表示
	}
$str = $post->post_content;
$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';//投稿にイメージがあるか調べる
if (is_single() || is_page() || is_archive() || is_tax || is_singular('case') ){
	if( get_field('entry_mainimg') ){ //カスタムフィールドのメイン画像がある場合の処理
		echo '<meta property="og:image" content="'.get_field('entry_mainimg').'">'."\n";
		
		} else { if (has_post_thumbnail()){//投稿にサムネイルがある場合の処理
			$image_id = get_post_thumbnail_id();
			$image = wp_get_attachment_image_src( $image_id, 'full');
			echo '<meta property="og:image" content="'.$image[0].'">'."\n";
		} else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {//投稿にサムネイルは無いが画像がある場合の処理
			echo '<meta property="og:image" content="'.$imgurl[2].'">'."\n";
		} else {//投稿にサムネイルも画像も無い場合の処理
			echo '<meta property="og:image" content="'.get_bloginfo('url').'/img/ogp_banner.jpg">'."\n";
		}
	}
} 
else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
	echo '<meta property="og:image" content="'.get_bloginfo('url').'/img/ogp_banner.jpg">'."\n";
}

echo '<meta property="og:site_name" content="'.get_bloginfo('name').'">'."\n";
echo '<!-- /OGP -->' . "\n";
}
add_action('wp_head','head_ogp');

// 固定ページで概要（抜粋）
add_post_type_support( 'page', 'excerpt' );

// 概要（抜粋）で「もっと読む」を表示
function new_excerpt_more($more) {
     return ;
}
add_filter('excerpt_more', 'new_excerpt_more');

// 概要（抜粋）の文字数を指定
function new_excerpt_length($length) {
return 100; /* 文字数 */
}
add_filter('excerpt_length', 'new_excerpt_length');

//管理画面
// ログイン画面のロゴと背景の変更
function custom_login() { ?>
<style>
.login {
background: url(<?php echo get_template_directory_uri(); ?>/images/login-bg.png) no-repeat center center;
background-size: cover;
}
.login #login h1 a {
width: 300px;
height: 70px;
background: url(<?php echo get_template_directory_uri(); ?>/images/login-logo.png) no-repeat 0 0;
}
.login #nav,
.login #backtoblog {
display: none;
}
</style>

<?php }
add_action( login_enqueue_scripts’, ‘custom_login’);

// 管理画面用favicon 
function admin_favicon() {
  echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_bloginfo('url').'/img/favicon.ico">';
}
add_action('admin_head', 'admin_favicon');

// 管理画面用フォント 
function change_editor_font(){
echo "<style type='text/css'>
#editorcontainer textarea#content {
  font-family: \"ヒラギノ角ゴ Pro W3\",
	\"Hiragino Kaku Gothic Pro\",
    Osaka,
    \"ＭＳ Ｐゴシック\",
    sans-serif;
	font-size:14px;
	color:#333;
}
</style>";
}
add_action("admin_print_styles", "change_editor_font");


// Contact Form 7 カスタマイズ用
add_filter( 'wpcf7_validate_email', 'wpcf7_text_validation_filter_extend', 11, 2 );
add_filter( 'wpcf7_validate_email*', 'wpcf7_text_validation_filter_extend', 11, 2 );
function wpcf7_text_validation_filter_extend( $result, $tag ) {
    $type = $tag['type'];
    $name = $tag['name'];
    $_POST[$name] = trim( strtr( (string) $_POST[$name], "\n", " " ) );
    if ( 'email' == $type || 'email*' == $type ) {
        if (preg_match('/(.*)_confirm$/', $name, $matches)){
            $target_name = $matches[1];
            if ($_POST[$name] != $_POST[$target_name]) {
                if (method_exists($result, 'invalidate')) {
                    $result->invalidate( $tag,"確認用のメールアドレスが一致していません");
                } else {
                    $result['valid'] = false;
                    $result['reason'][$name] = '確認用のメールアドレスが一致していません';
                }
            }
        }
    }
    return $result;
} // Contact Form 7 の編集画面で [email* your-email_confirm] を追加してください。

// 予約カレンダー

// オプション注文タイトルの書き換え
function mts_option_title($str, $mail='') {
    if ($mail == 'mail') {
        return '[ティシューについて]';
    }
    return 'ティシューについて';
}
add_filter('booking_form_option_title', 'mts_option_title', 10, 2);

// オプションメッセージの書き換え
function mts_option_message($str) {
    return '親子で共有使用するか、お子様専用ティシューを使用するか選択してください。';
}

add_filter('booking_form_option_message', 'mts_option_message');

function my_booking_form_count_label($label) {
 
    switch ($label) {
		case "大人":
            $temp = "大人";
            break;
		case "小人":
            $temp = "小人（小学生・中学生・高校生）";
            break;
        case "車":
            $temp = "車";
            break;
    }
    return $temp;
}
add_filter('booking_form_count_label', 'my_booking_form_count_label');

?>