<?php

use Plugin_Name_Dir\Includes\Functions\Utility;
use Plugin_Name_Dir\Includes\Functions\Date;
$dash_assets_url=trailingslashit( PLUGIN_NAME_URL ) . 'assets/dashboard/';


if ( explode('/',$_SERVER['HTTP_REFERER'])[3] =='auth')
{
    if (is_user_logged_in())
    {
        $cu_id=get_current_user_id();
        $user_info = get_userdata($cu_id);
        if (current_user_can('administrator') and !$user_info->user_login == '9154961051')
        {
            wp_redirect(admin_url(),303);
        }
        else
        {
            $dash_assets_url=trailingslashit( PLUGIN_NAME_URL ) . 'assets/dashboard/';
            $election_settings=get_option('ELEC_settings');
            $t=explode("-",Date::jdate('d-H',time(),'','Asia/Tehran','en'));

            Utility::load_template( 'panel.head', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
            Utility::load_template( 'general.header', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
            Utility::load_template( 'general.preloader', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
            Utility::load_template( 'general.main-menu', compact( array('dash_assets_url','cu_id','user_info')), 'front' );

            if ($election_settings['voting_status'] == 'enable')
            {
                if ($t[0] == $election_settings['voting_day'] and ( $t[1] >= $election_settings['voting_start_time'] and $t[1] < $election_settings['voting_finish_time']))
                {
                    if ($user_info->vote_status == 'not_voted')
                    {
                        Utility::load_template( 'panel.content',compact( array('dash_assets_url','cu_id','user_info','election_settings')), 'front' );
                    }
                    else
                    {
                        Utility::load_template( 'panel.content-voted',compact( array('dash_assets_url','cu_id','user_info','election_settings')), 'front' );
                    }
                }
                else
                {
                    Utility::load_template( 'panel.content-voting-expire',compact( array('dash_assets_url','cu_id','user_info','election_settings')), 'front' );
                }
            }
            else
            {
                Utility::load_template( 'panel.content-voting-disable',compact( array('dash_assets_url','cu_id','user_info','election_settings')), 'front' );
            }

            Utility::load_template( 'general.copyright', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
            Utility::load_template( 'panel.footer', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
        }
    }
    else
    {
        wp_logout();
        wp_redirect(home_url('auth'),303);
    }
}
else
{
    if (is_user_logged_in() and wp_verify_nonce($_GET['panel_nonce'],'panel_nonce'))
    {
        $cu_id=get_current_user_id();
        $user_info = get_userdata($cu_id);
        if (current_user_can('administrator') and !$user_info->user_login == '9154961051')
        {
            wp_redirect(admin_url(),303);
        }
        else
        {
            $dash_assets_url=trailingslashit( PLUGIN_NAME_URL ) . 'assets/dashboard/';
            $election_settings=get_option('ELEC_settings');
            $t=explode("-",Date::jdate('d-H',time(),'','Asia/Tehran','en'));

            Utility::load_template( 'panel.head', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
            Utility::load_template( 'general.header', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
            Utility::load_template( 'general.preloader', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
            Utility::load_template( 'general.main-menu', compact( array('dash_assets_url','cu_id','user_info')), 'front' );

            if ($election_settings['voting_status'] == 'enable')
            {
                if ($t[0] == $election_settings['voting_day'] and ( $t[1] >= $election_settings['voting_start_time'] and $t[1] < $election_settings['voting_finish_time']))
                {
                    if ($user_info->vote_status == 'not_voted')
                    {
                        Utility::load_template( 'panel.content',compact( array('dash_assets_url','cu_id','user_info','election_settings')), 'front' );
                    }
                    else
                    {
                        Utility::load_template( 'panel.content-voted',compact( array('dash_assets_url','cu_id','user_info','election_settings')), 'front' );
                    }
                }
                else
                {
                    Utility::load_template( 'panel.content-voting-expire',compact( array('dash_assets_url','cu_id','user_info','election_settings')), 'front' );
                }
            }
            else
            {
                Utility::load_template( 'panel.content-voting-disable',compact( array('dash_assets_url','cu_id','user_info','election_settings')), 'front' );
            }

            Utility::load_template( 'general.copyright', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
            Utility::load_template( 'panel.footer', compact( array('dash_assets_url','cu_id','user_info')), 'front' );
        }
    }
    else
    {
        wp_logout();
        wp_redirect(home_url('auth'),303);
    }
}


?>
