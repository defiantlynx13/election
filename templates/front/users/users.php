<?php

use Plugin_Name_Dir\Includes\Functions\Utility;
$dash_assets_url=trailingslashit( PLUGIN_NAME_URL ) . 'assets/dashboard/';


if (is_user_logged_in())
{

    $cu_id=get_current_user_id();
    $user_info = get_userdata($cu_id);

    if (current_user_can('administrator'))
    {
        wp_redirect(admin_url(),303);
    }
    else
    {
        $user_type_and_permissions=Utility::commrce_get_user_office($cu_id);
        $dash_assets_url=trailingslashit( PLUGIN_NAME_URL ) . 'assets/dashboard/';
        Utility::load_template( 'users.head', compact( array('user_type_and_permissions','dash_assets_url','cu_id','user_info')), 'front' );
        Utility::load_template( 'users.content',compact( array('user_type_and_permissions','dash_assets_url','cu_id','user_info')), 'front' );
        Utility::load_template( 'general.copyright', compact( array('user_type_and_permissions','dash_assets_url','cu_id','user_info')), 'front' );
        Utility::load_template( 'users.footer', compact( array('user_type_and_permissions','dash_assets_url','cu_id','user_info')), 'front' );
    }


}
else
{
    wp_redirect(home_url('auth'),303);
}

?>
