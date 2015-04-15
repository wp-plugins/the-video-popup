<?php
/*
Plugin Name: The Video Pupup
Plugin URI: http://codefiddle.wordpress.com
Description: Simplest way to add a minimizable video popup to footer. 
Version: 1.0
Author: singhshivam
Author URI: http://codefiddle.wordpress.com
*/

if (is_admin())
	  require_once dirname( __FILE__ ) . '/admin.php';

function youtubeEmbedFromUrl($youtube_url, $width, $height){
	$vid_id = extractUTubeVidId($youtube_url);
	return generateYoutubeEmbedCode($vid_id, $width, $height);
}

function extractUTubeVidId($url){
	/*
	 * 	* type1: http://www.youtube.com/watch?v=H1ImndT0fC8
	 * 		* type2: http://www.youtube.com/watch?v=4nrxbHyJp9k&feature=related
	 * 			* type3: http://youtu.be/H1ImndT0fC8
	 * 				*/
	$vid_id = "";
	$flag = false;
	if(isset($url) && !empty($url)){
		/*case1 and 2*/
		$parts = explode("?", $url);
		if(isset($parts) && !empty($parts) && is_array($parts) && count($parts)>1){
			$params = explode("&", $parts[1]);
			if(isset($params) && !empty($params) && is_array($params)){
				foreach($params as $param){
					$kv = explode("=", $param);
					if(isset($kv) && !empty($kv) && is_array($kv) && count($kv)>1){
						if($kv[0]=='v'){
							$vid_id = $kv[1];
							$flag = true;
							break;
						}
					}
				}
			}
		}

		/*case 3*/
		if(!$flag){
			$needle = "youtu.be/";
			$pos = null;
			$pos = strpos($url, $needle);
			if ($pos !== false) {
				$start = $pos + strlen($needle);
				$vid_id = substr($url, $start, 11);
				$flag = true;
			}
		}
	}
	return $vid_id;
}

function generateYoutubeEmbedCode($vid_id, $width, $height){
	$w = $width;
	$h = $height;
	$html = '<iframe width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'.$vid_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	return $html;
}


function my_theme_send_email() {
	if ( isset( $_POST['tvpp_video_url'] ) && (strlen($_POST['tvpp_video_url']) > 10 )) {
		update_option( 'tvpp_video_url', $_POST['tvpp_video_url']);
	}
	if ( isset( $_POST['tvpp_height'] ) && (strlen($_POST['tvpp_height']) > 1) ) {
		update_option( 'tvpp_height', $_POST['tvpp_height'].'px' );
	}
	if ( isset( $_POST['tvpp_width'] ) && (strlen($_POST['tvpp_width']) > 1)) {
		update_option( 'tvpp_width', $_POST['tvpp_width'].'px' );
	}
} 
add_action( 'init', 'my_theme_send_email' );
function fwpopup_register_sidebar() {
register_sidebar(
array(
'name' => __('Add Popup Form', 'fwpopup'),
'id' => 'fancy_widget_sidebar',
'description' => __('Drop Any Widget here for showing it in Fancy Widget Popup. For Options Check Settings -> Fancy Widget Popup', 'fwpopup'),
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h3 class="widget-title section-title">',
'after_title' => '</h3>'
)
);
}
//add_action( 'wp_loaded', 'fwpopup_register_sidebar' );
add_action('wp_footer','show_fwpopup_popup');
function show_fwpopup_popup()
{
?>
<div class="tvpp_popup">
<div class="tvpp_popup_close">X</div>
<div class="tvpp_popup_max">+</div>
<?php 
	$pop_width = (get_option('tvpp_width'))? get_option('tvpp_width'):'420px';
	$pop_height = (get_option('tvpp_height'))? get_option('tvpp_height'):'345px';
	$embed_code = youtubeEmbedFromUrl(get_option( 'tvpp_video_url' ), $pop_width, $pop_height);
	echo $embed_code ;
?>
<div class="tvpp_popup_heading"><?php dynamic_sidebar('fancy_widget_sidebar')?></div>
</div>
<?php
}
add_action('wp_enqueue_scripts', 'tvpp_load_scripts'); 

function tvpp_load_scripts()
{
wp_enqueue_script('fwpopup_script',plugins_url('/tvpp/pop_up_right.js', __FILE__),array('jquery'),'2.0'); // for javascript
wp_register_style( 'fwpopup_style',plugins_url('/tvpp/pop-up-css.php', __FILE__));
wp_enqueue_style( 'fwpopup_style' );
}