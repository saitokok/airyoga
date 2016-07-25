<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="google-site-verification" content="GuRoDPMgaTdRjaddPetuoRj3fcCyv-N0bA2d59JSY9M">

<?php wp_head(); ?>
<?php get_template_part('javascript'); ?>

</head>
<?php if(is_home()) : ?>
<body class="top">
<?php elseif(is_page_template('page-onecolumn.php')): //テンプレート別 ワンカラム ?> 
<body class="conte col_one">
<?php elseif(is_search()): //検索結果 ?> 
<body class="conte search">
<?php elseif(is_category()): ?>
	<?php //カテゴリの情報取得
    $cat_info = get_category( $cat );
    ?>
<body class="conte <?php echo $cat_info->category_nicename; //カテゴリベース名 ?>">
<?php else : ?>
	<?php //カテゴリの情報取得
        $cat = get_the_category();
        $cat = $cat[0];
    ?>
<body class="conte <?php echo $cat->category_nicename; //カテゴリベース名 ?>">
<?php endif ?>


<div id="wrapper">
<div id="wrapper_inner">

<?php get_template_part('head_navi'); ?>
<?php get_template_part('mainimg'); ?>
