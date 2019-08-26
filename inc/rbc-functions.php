<?php
/**
 * RBC
 *
 * Functions
 *
 * @author   Fabio Gonzaga
 * @since    1.0
 */
if ( ! defined( 'ABSPATH' ) ) 
{
	exit; // Exit if accessed directly.
}

// Call rbc_plugin_menu function to load plugin menu in dashboard
add_action( 'admin_menu', 'rbc_plugin_menu' );

/**
* Register plugin menu
*/
    if( !function_exists("rbc_plugin_menu") )
    {
        function rbc_plugin_menu()
        {
            $page_title = 'Replace By Country Plugin';
            $menu_title = 'Replace By Country';
            $capability = 'manage_options';
            $menu_slug  = 'rbc-plugin';
            $function   = 'rbc_plugin_page';
            $icon_url   = 'dashicons-admin-site';
            $position   = 100;

            add_menu_page( 
                $page_title,
                $menu_title,
                $capability,
                $menu_slug,
                $function,
                $icon_url,
                $position 
            );

            // Call rbc_update_settings function to update database
            add_action( 'admin_init', 'rbc_update_settings' );
        }
    }

/**
* Create function to register plugin settings in the database
*/
    if( !function_exists("rbc_update_settings") )
    {
        function rbc_update_settings() 
        {
            // register_setting( 'rbc-plugin-settings', 'rbc_field_test_1' );
            // Other fields ... 
            // register_setting( 'rbc-plugin-settings', 'rbc_field_test_2' );
        }
    }

/**
* Create Plugin Page
*/
    if ( ! function_exists('rbc_plugin_page') ) 
    {
        function rbc_plugin_page()
        {
            include RBC_PATH . 'templates/rbc-dashboard.php';
        }
    }

/**
* Shorcode Base
* @param replace_for_country
* @param original_content
* @param new_content
*/
    if ( !function_exists('rbc_shortcode_replace'))
    {
        function rbc_shortcode_replace( $atts, $content = null ) 
        {
            $a = shortcode_atts( array(
                'replace_for_country'   => '',
                'original_content'      => '',
                'new_content'           => '',
            ), $atts );

            if ( $a['replace_for_country'] == rbc_get_user_country() )
            {
                $content = $a['new_content'];
                return $content;
            } 
            
            if ( !empty($a['original_content']) )
            {
                $content = $a['original_content'];
                return $content;
            }
            
            return $content;
        }
        add_shortcode( 'rbc-replace-content', 'rbc_shortcode_replace' );
    }

/**
* Get User Location
*/
    function rbc_get_user_location()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        $result  = array('country'=>'', 'city'=>'');
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }
        // $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));  
        $ip_data = @json_decode(file_get_contents("http://ip-api.com/json/".$ip));  
        if($ip_data && $ip_data->country != null){
            $result['country'] = $ip_data->countryCode;
            $result['city'] = $ip_data->city;
        }
        return $result;
    }

/**
* Get User Country
*/
    function rbc_get_user_country()
    {
        $location = rbc_get_user_location();
        $country = $location['country'];
        return $country;
    }
