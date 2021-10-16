<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo  home_url('panel')?>">
                    <h2 class="brand-text mb-0">نظام کاردانی خراسان جنوبی</h2></a></li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="">
            <li class="navigation-header"><span>منوی اصلی</span>
            </li>
            <li class="nav-item">
                    <a href="<?php echo home_url('panel?panel_nonce='.wp_create_nonce('panel_nonce'))?>">
                        <i class="bx bx-select-multiple bx-tada-hover"></i>
                        <span class="menu-item">ثبت رای</span>
                    </a>
            </li>
            <?php
            if (is_user_logged_in() && current_user_can( 'manage_options' ))
            {
                ?>
                <li class="nav-item">
                    <a href="<?php echo home_url('results?result_nonce='.wp_create_nonce('result_nonce'))?>">
                        <i class='bx bx-line-chart bx-tada-hover'></i>
                        <span class="menu-title" >نتایج</span>
                    </a>
                </li>
                <?php
            }

            if (is_user_logged_in() && current_user_can( 'manage_options' ))
            {
                ?>
                <li class="nav-item">
                    <a href="<?php echo home_url('settings?setting_nonce='.wp_create_nonce('setting_nonce'))?>">
                        <i class='bx bx-cog bx-tada-hover'></i>
                        <span class="menu-title" >تنظیمات</span>
                    </a>
                </li>
                <?php
            }
            ?>
            <li class="nav-item">
                <a href="<?php echo wp_logout_url(home_url('auth'))?>">
                    <i class='bx bx-power-off bx-tada-hover'></i>
                    <span class="menu-title" >خروج</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
