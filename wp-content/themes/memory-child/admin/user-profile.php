<?php

/*** Template Name: User Profile */
get_header('archiving');
?>



<section>
    <div class="main-content">
        <?php include get_theme_file_path('partials/sidebar.php'); ?>
        <?php include get_theme_file_path('partials/navbar.php'); ?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__breadcrumb">
                        <div class="main-body__breadcrumb--list"></div>
                    </div>
                    <div class="main-body__area">
                        <div class="user-profile">
                            <div class="user-profile__container">
                                <?php

                                if (isset($_GET['user_id'])) {
                                    $user_id = intval($_GET['user_id']);
                                    $user = get_userdata($user_id);

                                    if ($user) { ?>
                                        <div class="user-profile__row">
                                            <div class="user-profile__img">
                                                <?php echo get_avatar($user_id, 128); ?>
                                            </div>
                                            <div class="user-profile__content">
                                                <div class="user-profile__content--info">
                                                    <div class="label">First Name</div>
                                                    <div class="desc"><?php echo $user->first_name; ?></div>
                                                </div>
                                                <div class="user-profile__content--info">
                                                    <div class="label">Last Name</div>
                                                    <div class="desc"><?php echo $user->last_name; ?> </div>
                                                </div>
                                                <div class="user-profile__content--info">
                                                    <div class="label">Display Name</div>
                                                    <div class="desc"><?php echo $user->display_name; ?></div>
                                                </div>
                                                <div class="user-profile__content--info">
                                                    <div class="label">Username</div>
                                                    <div class="desc"><?php echo $user->user_login; ?></div>
                                                </div>
                                                <div class="user-profile__content--info">
                                                    <div class="label">Email</div>
                                                    <div class="desc"><?php echo $user->user_email; ?></div>
                                                </div>
                                                <div class="user-profile__content--info">
                                                    <div class="label">Role</div>
                                                    <div class="desc">
                                                        <?php echo implode(', ', $user->roles); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                    <?php } else {
                                        echo '<p>User not found</p>';
                                    }
                                } else {
                                    echo '<p>Invalid user ID</p>';
                                }
                    ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>





<?php get_footer('archiving'); ?>