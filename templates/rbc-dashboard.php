<?php
/**
 * RBC
 *
 * Dashboard Template
 *
 * @author   Fabio Gonzaga
 * @package wp-base-starter
 * @since    1.0
 */
if ( ! defined( 'ABSPATH' ) ) 
{
	exit; // Exit if accessed directly.
}


/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>
<div class="wrap about-wrap">
	<h1><?php _e( 'Replace By Country Plugin' ); ?></h1>

	<!-- <div class="about-text"></div> -->

	<div class="changelog">
		<h3><?php _e( 'How to use' ); ?></h3>
        <div class="feature-section images-stagger-right">
            <strong>Shortcode examples:</strong><br><br>
            Into a dynamic content: <br>
            <blockquote>[rbc-replace-content replace_for_country="JP" new_content="Content to replace for selected country"]YOUR DYNAMIC CONTENT HERE[/rbc-replace-content]</blockquote>
            <br>
            Using do_shortcode: <br>
            <blockquote>do_shortcode('[rbc-replace-content replace_for_country="JP" original_content="Original content here" new_content="Content to replace for selected country"]')</blockquote>
        </div><!-- /.feature-section -->

        <h3><?php _e('Credits'); ?></h3>
        <div class="feature-section">
            <a href="https://github.com/flgonzaga" target="_blank">Fabio Gonzaga</a>
        </div>
	</div><!-- /.changelog -->

        

</div><!-- /.wrap -->
<?php include( ABSPATH . 'wp-admin/admin-footer.php' );