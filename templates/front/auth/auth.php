<?php
use Plugin_Name_Dir\Includes\Functions\Utility;
$cu_id=get_current_user_id();
$request=$_REQUEST;
    if (is_user_logged_in())
    {
        wp_redirect(home_url('panel'));
        exit;
    }
    else
    {

        Utility::load_template( 'auth.head', compact( array('dash_assets_url','dash_assets_url2') ), 'front' );
        Utility::load_template( 'auth.content',compact( array('dash_assets_url','dash_assets_url2') ), 'front' );
        Utility::load_template( 'auth.footer', compact( array('dash_assets_url','dash_assets_url2') ), 'front' );
    }
?>


