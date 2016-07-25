/* -------------------------------------------------------------------------
	base.js
	サイト内で共通のスクリプトを定義
	※jQuery必須
------------------------------------------------------------------------- */
/*--UserAgent--*/
var
ieUA = /*@cc_on!@*/false,
spUA = ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || (navigator.userAgent.indexOf('Android') > 0 && navigator.userAgent.indexOf('Mobile') > 0)) ? true : false,
tabletUA = (navigator.userAgent.indexOf('iPad') >0 || (navigator.userAgent.indexOf('Android') > 0 && navigator.userAgent.indexOf('Mobile') == -1)) ? true : false;
/*--META Viewport--*/
//if(spUA || tabletUA){ document.write('<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">');}
if(spUA){ document.write('<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">');}


/*--▽イメージマウスオーバーアクション--*/
$(function(){
   $('a img').hover(
      function(){
         $(this).fadeTo(0, 0.6).fadeTo('normal', 1.0);
      },
      function(){
         $(this).fadeTo('fast', 1.0);
      }
   );
});


/*--▽スマホTELリンク--*/
$(function(){
    var ua = navigator.userAgent;
    if(ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0){
        $('.tel-link').each(function(){
            var str = $(this).text();
            $(this).html($('<a>').attr('href', 'tel:' + str.replace(/-/g, '')).append(str + '</a>'));
        });
    }
});

/*--▽するするスクロール--*/
$(function(){
	$('a[href^=#].surusuru').click(function(){ 
		var speed = 500;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("html, body").animate({scrollTop:position}, speed, "swing");
		return false;
	});
});

/*--▽外部ページでもスルスルスクロール--*/
/*--<a href="●●●.html?id=●●●">LINK</a>--*/
$(function(){
    var url = $(location).attr('href');
    if (url.indexOf("?id=") == -1) {
    }else{
        var url_sp = url.split("?id=");
        var hash   = '#' + url_sp[url_sp.length - 1];
        var tgt    = $(hash);
        var pos    = tgt.offset().top;
        $("html, body").animate({scrollTop:pos}, 2000, "swing");
    }
});

/*--▽ナビゲーションをハイライト表示--*/
$(function(){
   $('.flexnav li a').each(function(){
      var url = $(this).attr('href');
      if(location.href.match(url)) {
         $(this).addClass('current');
      } else {
         $(this).removeClass('current');
      }
   });
});

/*--▽youtube自動レスポンシブ--*/
$(function(){
	$('iframe[src*="youtube"]').wrap('<div class="youtube"></div>');
});

/*--▽カレンダー-*/
$(function(){
	$('.calendar-mark').each(function(){
		var txt = $(this).html();
		$(this).html(
			txt.replace(/満員御礼/g,"<span class='full'>満員御礼</span>")
		);
	});
})

/*--▽wordpress カスタムフィールド Googleマップ表示 --*/
$(function() {

/*
*  render_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function render_map( $el ) {

	// var
	var $markers = $el.find('.marker');

	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};

	// create map	        	
	var map = new google.maps.Map( $el[0], args);

	// add a markers reference
	map.markers = [];

	// add markers
	$markers.each(function(){

    	add_marker( $(this), map );

	});

	// center map
	center_map( map );

}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/

$(document).ready(function(){

	$('.acf-map').each(function(){

		render_map( $(this) );

	});

});

})(jQuery);
