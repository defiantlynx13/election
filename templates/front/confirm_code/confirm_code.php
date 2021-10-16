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
    if (isset($_POST) and !empty($_POST['mobile']))
    {
        Utility::load_template( 'confirm_code.head', compact( 'dash_assets_url' ), 'front' );
        Utility::load_template( 'confirm_code.content', compact( 'dash_assets_url' ), 'front' );
        Utility::load_template( 'confirm_code.footer', compact( 'dash_assets_url' ), 'front' );
    }
    else
    {
        wp_redirect(home_url('access_denied'));
        exit;
    }
}
?>


