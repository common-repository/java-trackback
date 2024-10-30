<?php
/*
Plugin Name: java-trackback
Description: Use this little plugin to make pop-up trackback urls!
Author: Simon Prosser
Version: 0.2
Plugin URI: http://www.pross.org.uk/wordpress-plugins/
Author URI: http://www.pross.org.uk
*/
//add_filter('trackback_url','java-track_url');

wp_enqueue_script('jquery');
add_action('wp_head', 'javatrack_head', 15);
        wp_register_script( 'zeroclipboard', WP_PLUGIN_URL . '/java-trackback/ZeroClipboard.js' );
        wp_enqueue_script( 'zeroclipboard' );

function javatrack_head() {
echo '
<script type="text/javascript">
jQuery(document).ready(function(){

	jQuery("a[href$=/trackback/]").attr({ id: "trackback" })
});
</script>
';

echo '<script type="text/javaScript">
ZeroClipboard.setMoviePath( \''. WP_PLUGIN_URL . '/java-trackback/ZeroClipboard.swf\' );
jQuery(document).ready(function() {
    jQuery(\'#trackback\').mouseover(function() {
        var txt = "' . get_trackback_url() . '";
        clip = new ZeroClipboard.Client();
	clip.setHandCursor(true);
        clip.setText(txt);
        clip.glue(this);
        clip.addEventListener(\'complete\', function(client, text) {
	alert( "Trackback copied to clipboard!" );
        });
    });
});
</script>';
}
?>