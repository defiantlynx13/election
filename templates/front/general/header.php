<!-- BEGIN: Header-->
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top" style="background-color: rgb(242, 244, 244); box-shadow: none;">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs is-active" href="#"><i class="ficon bx bx-menu"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name">
                                    <?php
                                    echo get_user_meta($user_info->ID,'fl_name',true);
                                    ?>
                                </span><span class="user-status text-muted">
                                     <?php
                                     echo get_user_meta($user_info->ID,'work_position',true);
                                     ?>
                                </span></div><span>
                                <div class="avatar mr-1 avatar-lg bg-primary">
                                  <span class="avatar-content"><i class="avatar-icon bx bx-user"></i></span>
                                </div>
<!--                                <img class="round" src="--><?php //echo $dash_assets_url.'images/portrait/small/avatar-s-11.jpg'?><!--" alt="avatar" height="40" width="40"></span></a>-->
                        <div class="dropdown-menu pb-0">
<!--                            <div class="dropdown-divider mb-0"></div>-->
                            <a class="dropdown-item" href="<?php echo wp_logout_url(home_url('auth'))?>"><i class="bx bx-power-off mr-50"></i> خروج</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!--    set all users vote status to not_voted -->
<!---->
    <?php

//    $users = get_users();
//    $users_array = array();
//    foreach ($users as $user) {
//        delete_user_meta($user->ID,'voting_data');
//        $t = update_user_meta($user->ID, 'vote_status', 'not_voted');
//        $t = get_user_meta($user->ID, 'vote_status', true);
//        $users_array[] = $t;
//    }
    ?>
</nav>

<!-- END: Header-->