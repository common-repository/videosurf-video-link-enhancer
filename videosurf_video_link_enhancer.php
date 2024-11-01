<?php
/*
Plugin Name: VideoSurf Video Link Enhancer
Plugin URI: http://videosurf.com/tools/video-link-enhancer
Description: This plugin will automatically enhance all links to videos in your posts and comments with the ability to play the video inline on hover without the reader leaving your page.  
Original Author: Udi Falkson
Version: 1.1

************************************************************/

add_action('wp_footer', 'videosurf_video_link_enhancer_addjs');
add_filter('plugin_action_links', 'videosurf_video_link_enhancer_plugin_action', 10, 2);
add_option("videosurf_video_link_enhancer_addfooterlink", "true");
add_option("videosurf_video_link_enhancer_link_selector_prefix", "");
add_option("videosurf_video_link_enhancer_link_selector_suffix", "");
add_option("videosurf_video_link_enhancer_overlay_bg_color", "");
add_option("videosurf_video_link_enhancer_overlay_text_color", "");
add_option("videosurf_video_link_enhancer_add_link_icon", "true");

if($_POST['videosurf_video_link_enhancer_form_identifier']) {
	update_option('videosurf_video_link_enhancer_link_selector_prefix', $_POST['videosurf_video_link_enhancer_link_selector_prefix']);
	update_option('videosurf_video_link_enhancer_link_selector_suffix', $_POST['videosurf_video_link_enhancer_link_selector_suffix']);
	update_option('videosurf_video_link_enhancer_overlay_bg_color', $_POST['videosurf_video_link_enhancer_overlay_bg_color']);
	update_option('videosurf_video_link_enhancer_overlay_text_color', $_POST['videosurf_video_link_enhancer_overlay_text_color']);
	update_option('videosurf_video_link_enhancer_add_link_icon', $_POST['videosurf_video_link_enhancer_add_link_icon'] == "true" ? "true" : "false");
	update_option('videosurf_video_link_enhancer_addfooterlink', $_POST['videosurf_video_link_enhancer_append_link'] == "true" ? "true" : "false");
}

if (!function_exists("vvle_ap")) {
	function vvle_ap() {
		global $thmTwk ;
		if (function_exists('add_submenu_page')) {
			//add_submenu_page('index.php', __('Sayfa Sayac - Post Read Counter', 'sayfasayacprc'), $menutitle, 9, __FILE__, 'fb_sayfa_sayac_statistic');
			add_submenu_page('index.php', 'VideoSurf Video Link Enhancer Options', 'VideoSurf Video Link Enhancer', 9,
			basename(__FILE__), 'videosurf_video_link_enhancer_printoptions');
		}
	}
}
add_action('admin_menu', 'vvle_ap');

function videosurf_video_link_enhancer_printoptions() {
	?>
	<style>
	.vsform ul li { margin: 10px 0px 20px 0px; }
	.vsform ul li em { font-size: 80%; }
	.vsform ul li strong { display: block; }
	</style>
	<div class="wrap" style="width:800px">
		<h2>VideoSurf Video Link Enhancer Options</h2>
		<form action="<?php echo str_replace("index.php", "plugins.php", $_SERVER['SCRIPT_NAME']); ?>" method="POST" class="vsform">
			<input type="hidden" name="videosurf_video_link_enhancer_form_identifier" value="y">
			<ul>
			<li>
			<strong>Link Selector Prefix:</strong> <input type="text" name="videosurf_video_link_enhancer_link_selector_prefix" value="<?php echo get_option("videosurf_video_link_enhancer_link_selector_prefix"); ?>"> <em>By default, the plugin acts on all links on the page. To limit it to only certain areas of your page, you can add a css selector here. This may also have performance benefits. e.g. "#content" will limit it to only links inside the container on your page with id of "content", or "p" will limit it to only links inside p tags. We're using JQuery's selector syntax here and will be appending " a" to whatever you provide.</em>
			</li>
			<li>
			<strong>Link Selector Suffix:</strong> <input type="text" name="videosurf_video_link_enhancer_link_selector_suffix" value="<?php echo get_option("videosurf_video_link_enhancer_link_selector_suffix"); ?>"> <em>In addition to the prefix, you can optionally add a suffix to the link selector. This may be useful if you want to limit the script to act on only links with a certain class or that contain certain text.  Again, this uses JQuery's selector syntax.  </em>
			</li>
			<li>
			<strong>Overlay Bg Color:</strong> <input type="text" name="videosurf_video_link_enhancer_overlay_bg_color" value="<?php echo get_option("videosurf_video_link_enhancer_overlay_bg_color"); ?>"> <em>6 character hex code of what you want the background color to be behind the embed.  Leave empty to use the default.</em>
			</li>
			<li>
			<strong>Overlay Text Color:</strong> <input type="text" name="videosurf_video_link_enhancer_overlay_text_color" value="<?php echo get_option("videosurf_video_link_enhancer_overlay_text_color"); ?>"> <em>Text color inside the overlay, useful if you change the bg color.  Leave empty to use the default.</em>
			</li>
			<li>
			 <input type="checkbox" value="true" name="videosurf_video_link_enhancer_add_link_icon" style="vertical-align: text-bottom;" <?php if(get_option('videosurf_video_link_enhancer_add_link_icon', 'true') == "true") { echo "checked"; } ?>>&nbsp;Prepend small v icon before all enhanced links to help identify them.
			</li>
			<li>
			<input type="checkbox" value="true" name="videosurf_video_link_enhancer_append_link" style="vertical-align: text-bottom;" <?php if(get_option('videosurf_video_link_enhancer_addfooterlink', 'true') == "true") { echo "checked"; } ?>>&nbsp;Provide attribution via a small link at the bottom of the page.
			</li>
			<li>
			<input type="submit" value="Save Changes">
			</li>
			</ul>
		</form>
	</div>
	<?php
}

function videosurf_video_link_enhancer_addjs() {
		$optionStr = "";
		$optionArr = array("link_selector_prefix", "link_selector_suffix", "overlay_bg_color", "overlay_text_color", "add_link_icon");
		foreach($optionArr as $o) {
			$val = get_option("videosurf_video_link_enhancer_".$o, '');
			if($val) {
				$optionStr .= "&$o=".urlencode($val);
			}
		}
		echo '<script src="http://www.videosurf.com/js/video_link_enhancer?vit=wp_plugin_vle'.$optionStr.'"></script>';
		if(get_option('videosurf_video_link_enhancer_addfooterlink', 'true') == "true") {
			echo '<div align="center"><font size="-3"><a href="http://www.videosurf.com/tools/video-link-enhancer" ' .
			'target="_blank">Video Links Enhanced</a> by <a href="http://www.videosurf.com/" target="_blank">' .
			'VideoSurf</a></font></div>';
		}

}

function videosurf_video_link_enhancer_plugin_action($links, $file) {
	static $this_plugin;

	if( !$this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if( $file == $this_plugin ){
		$settings_link = '<a href="index.php?page=videosurf_video_link_enhancer.php">' . __('Settings') . '</a>';
		$links = array_merge( array($settings_link), $links); // before other links
	}
	return $links;
}

?>
