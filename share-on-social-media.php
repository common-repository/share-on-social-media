<?php 
/*
Plugin Name: Posts and Products Share on Social Media
Description: Displays Social Share icons below every post. This plugin is developed by Xeven Solutions Team.
Version: 1.0.2
Author: Xeven Solutions
*/

function social_share_style() {
    wp_register_style("social-share-style-file", plugin_dir_url(__FILE__) . "style.css");
    wp_enqueue_style("social-share-style-file");
}

add_action("wp_enqueue_scripts", "social_share_style");

function admin_panel_css(){
    $src = "/wp-content/plugins/share-on-social-media/admin.css";
    $handle = "customAdminCss";
    wp_register_script($handle, $src);
    wp_enqueue_style($handle, $src, array(), false, false);
}
add_action( 'admin_enqueue_scripts', 'admin_panel_css' );

function social_sharing_menu_item() {
  add_menu_page( "Social Sharing", "Social Sharing", "manage_options", "social-sharing", "social_share_page", "dashicons-share" ); 
}

add_action("admin_menu", "social_sharing_menu_item");

function social_share_page() {
   ?>
      <div class="wrap">
         <h1>Social Sharing Options</h1>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("social_share_config_section");
 
               do_settings_sections("social-share");
                
               submit_button();
               settings_errors(); 
            ?>
         </form>
      </div>
   <?php
}

function social_share_settings() {
    add_settings_section("social_share_config_section", "", null, "social-share");
 
    add_settings_field("social-share-facebook", "Do you want to display Facebook share button?", "social_share_facebook_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-twitter", "Do you want to display Twitter share button?", "social_share_twitter_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-linkedin", "Do you want to display LinkedIn share button?", "social_share_linkedin_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-reddit", "Do you want to display Reddit share button?", "social_share_reddit_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-google", "Do you want to display Gmail share button?", "social_share_google_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-pinterest", "Do you want to display Pinterest share button?", "social_share_pinterest_checkbox", "social-share", "social_share_config_section");
	add_settings_field("social-share-alignment", "Please select the alignment of icons", "social_share_alignment", "social-share", "social_share_config_section");
	add_settings_field("remove-sticky-on-tablet", "Do you want to remove sticky the social icons on Tablet", "remove_sticky_on_tablet", "social-share", "social_share_config_section");
	add_settings_field("remove-sticky-on-mobile", "Do you want to remove sticky the social icons on  Mobile", "remove_sticky_on_mobile", "social-share", "social_share_config_section");
    add_settings_field("hide-on-tablet", "Do you want to hide social icons on  Tablet", "hide_on_tablet", "social-share", "social_share_config_section");
	add_settings_field("hide-on-mobile", "Do you want to hide social icons on  Mobile", "hide_on_mobile", "social-share", "social_share_config_section");
    add_settings_field("icons-shape", "Please Select the Icons Style", "icons_shape", "social-share", "social_share_config_section");
	add_settings_field("shortcode", "Copy Shortcode ", "short_code", "social-share", "social_share_config_section");

    register_setting("social_share_config_section", "social-share-facebook");
    register_setting("social_share_config_section", "social-share-twitter");
    register_setting("social_share_config_section", "social-share-linkedin");
    register_setting("social_share_config_section", "social-share-reddit");
    register_setting("social_share_config_section", "social-share-google");
    register_setting("social_share_config_section", "social-share-pinterest");
	register_setting("social_share_config_section", "social-share-alignment");
    register_setting("social_share_config_section", "remove-sticky-on-tablet");
	register_setting("social_share_config_section", "remove-sticky-on-mobile");
	register_setting("social_share_config_section", "hide-on-tablet");
	register_setting("social_share_config_section", "hide-on-mobile");
    register_setting("social_share_config_section", "icons-shape");
	register_setting("social_share_config_section", "shortcode");
}
 
function social_share_facebook_checkbox() {  
   ?>
        <input type="checkbox" name="social-share-facebook" value="1" <?php checked(1, get_option('social-share-facebook'), true); ?> /> Check for Yes
   <?php
}

function social_share_twitter_checkbox() {  
   ?>
        <input type="checkbox" name="social-share-twitter" value="1" <?php checked(1, get_option('social-share-twitter'), true); ?> /> Check for Yes
   <?php
}

function social_share_linkedin_checkbox() {  
   ?>
        <input type="checkbox" name="social-share-linkedin" value="1" <?php checked(1, get_option('social-share-linkedin'), true); ?> /> Check for Yes
   <?php
}

function social_share_reddit_checkbox() {  
   ?>
        <input type="checkbox" name="social-share-reddit" value="1" <?php checked(1, get_option('social-share-reddit'), true); ?> /> Check for Yes
   <?php
}

function social_share_google_checkbox() {  
   ?>
        <input type="checkbox" name="social-share-google" value="1" <?php checked(1, get_option('social-share-google'), true); ?> /> Check for Yes
   <?php
}

function social_share_pinterest_checkbox() {  
   ?>
        <input type="checkbox" name="social-share-pinterest" value="1" <?php checked(1, get_option('social-share-pinterest'), true); ?> /> Check for Yes
   <?php
}

function social_share_alignment() { 
	?>
	<select name="social-share-alignment" id="alignment">
	  <option value="left" <?php selected('left', get_option('social-share-alignment'), true); ?>>Left</option>
	  <option value="center" <?php selected('center', get_option('social-share-alignment'), true); ?>>Center</option>
	  <option value="right" <?php selected('right', get_option('social-share-alignment'), true); ?>>Right</option>
      <option value="sticky-left" <?php selected('sticky-left', get_option('social-share-alignment'), true); ?>>Sticky Left</option>
	  <option value="sticky-right" <?php selected('sticky-right', get_option('social-share-alignment'), true); ?>>Sticky Right</option>
	</select>
	
	<?php
}

function remove_sticky_on_tablet() { 
	?>
		<input type="checkbox" class="remove-sticky" name="remove-sticky-on-tablet" value="remove-sticky-on-tablet" <?php checked('remove-sticky-on-tablet', get_option('remove-sticky-on-tablet'), true); ?> /> Check for Yes
	<?php
}

function remove_sticky_on_mobile() { 
	?>
		<input type="checkbox" class="remove-sticky" name="remove-sticky-on-mobile" value="remove-sticky-on-mobile" <?php checked('remove-sticky-on-mobile', get_option('remove-sticky-on-mobile'), true); ?> /> Check for Yes
	<?php
}

function hide_on_tablet() { 
	?>
		<input type="checkbox" name="hide-on-tablet" value="hide-on-tablet" <?php checked('hide-on-tablet', get_option('hide-on-tablet'), true); ?> /> Check for Yes
	<?php
}

function hide_on_mobile() { 
	?>
		<input type="checkbox" name="hide-on-mobile" value="hide-on-mobile" <?php checked('hide-on-mobile', get_option('hide-on-mobile'), true); ?> /> Check for Yes
	<?php
}

function icons_shape() { 
	?>
        <span class="radio-btns"><input type="radio" name="icons-shape" value="background" <?php checked('background', get_option('icons-shape'), true); ?> /> Icons with Background</span>
		<span class="radio-btns"><input type="radio" name="icons-shape" value="only-icons" <?php  checked('only-icons', get_option('icons-shape'), true); ?> /> Only Icons</span>
        <span class="radio-btns"><input type="radio" name="icons-shape" value="text-icons" <?php  checked('text-icons', get_option('icons-shape'), true); ?> /> Icons with Text</span>
        <span class="radio-btns"><input type="radio" name="icons-shape" value="only-text" <?php  checked('only-text', get_option('icons-shape'), true); ?> /> Only Text</span>
        
	<?php
}

function short_code() { 
	?>
	<div id="code" class='short-code'>
		<p id="short-code">[social_share]</p>
		<span id="copy-btn" onclick="copyToClipboard('#short-code')">Copy</span>
		<span class="tooltip">Copy to clipboard</span>
	</div>
        
	<?php
}
 
add_action("admin_init", "social_share_settings");

function add_social_share_icons(){
        
		$position = (get_option("social-share-alignment"));
		$remove_sticky_on_tablet = (get_option("remove-sticky-on-tablet"));
		$remove_sticky_on_mobile = (get_option("remove-sticky-on-mobile"));
		$hide_on_tablet = (get_option("hide-on-tablet"));
		$hide_on_mobile = (get_option("hide-on-mobile"));
        $icons_shape = (get_option("icons-shape"));
		$html = "<div class='social-share-wrapper " . $position ." ". $hide_on_tablet . " ". $hide_on_mobile ." ". $remove_sticky_on_tablet . " ". $remove_sticky_on_mobile . " ". $icons_shape ."'>";
		global $post;

        $url = get_permalink($post->ID);
        $title = get_the_title($post->ID);
        $feature_img = get_the_post_thumbnail_url($post->ID);
		
        if(get_option("social-share-facebook") == 1) {
            $html = $html . "<div class='icon facebook'><a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "'><i class='background fab fa-facebook-square'></i><i class='only-icons fa fa-facebook'></i><span class='only-text'>Facebook</span><span class='text-icons'><i class='fa fa-facebook'></i> Facebook</span> </a></div>";
        }

        if(get_option("social-share-twitter") == 1) {
            $html = $html . "<div class='icon twitter'><a target='_blank' href='https://twitter.com/share?url=" . $url . "&title=" . $title . "'><i class='background fab fa-twitter-square'></i><i class='only-icons fa fa-twitter'></i><span class='only-text'>Twitter</span><span class='text-icons'><i class='fa fa-twitter'></i> Twitter</span></a></div>";
        }

        if(get_option("social-share-linkedin") == 1) {
            $html = $html . "<div class='icon linkedin'><a target='_blank' href='http://www.linkedin.com/shareArticle?url=" . $url . "&title=" . $title . "'><i class='background fab fa-linkedin-square'></i><i class='only-icons fa fa-linkedin'></i><span class='only-text'>Linkedin</span><span class='text-icons'><i class='fa fa-linkedin'></i> Linkedin</span></a></div>";
        }

        if(get_option("social-share-reddit") == 1) {
            $html = $html . "<div class='icon reddit'><a target='_blank' href='http://reddit.com/submit?url=" . $url . "&title=" . $title . "'><i class='background fab fa-reddit-square'></i><i class='only-icons fa fa-reddit'></i><span class='only-text'>Reddit</span><span class='text-icons'><i class='fa fa-reddit'></i> Reddit</span></a></div>";
        }
        
        if(get_option("social-share-google") == 1) {
            $html = $html . "<div class='icon google'><a target='_blank' href='https://mail.google.com/mail/u/0/?ui=2&fs=1&tf=cm&su=" . $title . "&body=Link= " . $url . "'><i class='background fa fa-envelope-square'></i><i class='only-icons fa fa-envelope'></i><span class='only-text'>Gmail</span><span class='text-icons'><i class='fa fa-envelope'></i> Gmail</span></a></div>";
        }
        
        if(get_option("social-share-pinterest") == 1) {
            $html = $html . "<div class='icon pinterest'><a target='_blank' href='https://pinterest.com/pin/create/button/?url=" . $url . "&title=" . $title . "&media=" . $feature_img . "'><i class='background fab fa-pinterest-square'></i><i class='only-icons fa fa-pinterest'></i><span class='only-text'>Pinterest</span><span class='text-icons'><i class='fa fa-pinterest'></i> Pinterest</span></a></div>";
        }

        $html = $html .  "<div class='clear'></div></div>";

        return $html;
}

// add_filter("the_content", "add_social_share_icons");
add_shortcode("social_share","add_social_share_icons");

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
	$(document).ready(function(){
		$('#alignment').change(function(){
			var checkSticky = $("option:selected", this).val();
			if(checkSticky == 'sticky-left' || checkSticky == 'sticky-right'){
				$('input.remove-sticky').parents().parents('tr').show();
			}else{
				$('input.remove-sticky').parents().parents('tr').hide();
			}
		});
        
        var checkSticky = $("option:selected", this).val();
        if(checkSticky == 'sticky-left' || checkSticky == 'sticky-right'){
            $('input.remove-sticky').parents().parents('tr').show();
        }else{
            $('input.remove-sticky').parents().parents('tr').hide();
        }
		
		$('#copy-btn').click(function(){
			$('.tooltip').text('Copied shortcode');
		});
		
		$('.radio-btns input:first-child').attr('checked');
		
	});
	
	function copyToClipboard(element) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();
	}
</script>