<?php
use Plugin_Name_Dir\Includes\Functions\Utility;
$cu_id=get_current_user_id();
$request=$_REQUEST;
    if (is_user_logged_in())
    {
        if (isset($request['ref']) and $request['ref']!='')
        {
            wp_redirect(home_url($request['ref']));
            exit;
        }
        else
        {
            wp_redirect(home_url());
            exit;
        }
    }
    else
    {
          Utility::load_template( 'recover-password.head', compact( 'dash_assets_url' ), 'front' );
          Utility::load_template( 'recover-password.content', compact( 'dash_assets_url' ), 'front' );
          Utility::load_template( 'recover-password.footer', compact( 'dash_assets_url' ), 'front' );
    }
?>


