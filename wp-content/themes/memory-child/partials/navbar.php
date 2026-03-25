<style>
    .nav__menu--profile {
        position: relative;
    }

    .nav__menu--profile .dropdown-content {
        display: none;
        position: absolute;
        top: 47px;
        left: 0;
        min-width: 150px;
        background: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .nav__menu--profile:hover .dropdown-content {
        display: block;
    }
</style>
<div class="nav">
    <div class="nav__hamburger">
        <div id="menu-icon" class="nav-menu-sp">
            <div class="icon-set">
                <a class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
        </div>
    </div>
    <div class="nav__search">
        <!-- <?php get_search_form(); ?> -->
    </div>

    <a href="<?php echo site_url('/dashboard'); ?>" class="nav__logo">
        <img src="<?php echo site_url(); ?>/wp-content/uploads/2023/04/about.png" alt="NHCP Logo">
        <p> National Memory Project</p>
    </a>
    <ul class="nav__menu">
        <li class="nav__menu--profile" onclick="myFunction()">
            <div class="prof-image">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ic_profile.png" alt="Profile Icon">
            </div>
            <div class="prof-position">
                <?php
                if (is_user_logged_in()) {
                    $current_user = wp_get_current_user(); ?>
                    <p class="name"><?php echo $current_user->display_name; ?></p>
                    <p class="pos"><?php echo implode(', ', $current_user->roles); ?></p>
                <?php
                } else {
                    echo 'Hello Visitor!';
                }
                ?>
            </div>

            <div id="myDropdown" class="dropdown-content">
                <a href="<?php echo site_url('/profile'); ?>">Profile</a>
                <a href="<?php echo wp_logout_url(get_permalink()); ?>">Logout</a>
            </div>
        </li>
    </ul>
</div>