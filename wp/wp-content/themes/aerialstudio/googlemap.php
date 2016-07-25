<?php 
	$location = get_field('gmap');
	if( !empty($location) ):?>
	<!--Googleマップ-->
	<h3>マップ</h3>
	<div class="acf-map">
		<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
	</div>
<?php endif; ?>
