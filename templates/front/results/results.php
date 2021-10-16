<?php
use Plugin_Name_Dir\Includes\Functions\Utility;
if (is_user_logged_in() and wp_verify_nonce($_GET['result_nonce'],'result_nonce'))
{
    $cu_id=get_current_user_id();
    $user_info = get_userdata($cu_id);
    if (current_user_can('administrator') )
    {
        $dash_assets_url=trailingslashit( PLUGIN_NAME_URL ) . 'assets/dashboard/';
        Utility::load_template( 'results.head', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
        Utility::load_template( 'results.content',compact( array('dash_assets_url','cu_id','user_info')), 'front' );
        Utility::load_template( 'general.copyright', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
        Utility::load_template( 'results.footer', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
    }
    else
    {
        wp_redirect(home_url('access_denied'),303);
    }
}
else
{
    wp_redirect(home_url('auth'),303);
}
?>
