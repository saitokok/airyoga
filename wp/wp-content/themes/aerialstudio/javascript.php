<?php wp_deregister_script('jquery'); ?> 

<!--▽jQuery基本-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src="<?php echo home_url( '/' ); ?>js/base.js"></script>
<script src="<?php echo home_url( '/' ); ?>js/respond.min.js"></script>

<!--▽ナビロールオーバー-->
<script src="<?php echo home_url( '/' ); ?>js/rollover.js" charset="utf-8"></script>

<!--▽CSS3をie8以下で-->
<!--[if (gte IE 6)&(lte IE 8)]>
<script type="text/javascript" src="<?php echo home_url( '/' ); ?>js/selectivizr.js"></script>
<![endif]-->

<!--▽html5をie8以下で-->
<!--[if lt IE 9]>
<script src="<?php echo home_url( '/' ); ?>js/html5shiv-printshiv.js"></script>
<![endif]-->

<!--▽レスポドロップダウンメニュー-->
<script src="<?php echo home_url( '/' ); ?>js/jquery.flexnav.min.js"></script>
<link href="<?php echo home_url( '/' ); ?>css/flexnav.css" rel="stylesheet">
<script>
$(function(){
$(".flexnav").flexNav();
});
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
