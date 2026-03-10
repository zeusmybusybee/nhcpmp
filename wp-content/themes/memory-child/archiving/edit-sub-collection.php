<?php
/*** Template Name: Edit Sub - Collection Management */
acf_form_head();
get_header('archiving');
?>

<section>
    <div class="main-content">

        <?php include get_theme_file_path('partials/sidebar.php');?>
        <?php include get_theme_file_path('partials/navbar.php');?>
        <?php $post_id = $_GET["post"];?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__breadcrumb">
                        <div class="main-body__breadcrumb--list"></div>
                    </div>
                    <div class="main-body__area">
                        <div class="main-body__area--row">
                            <div class="main-body__area--form addcollection">
                                <div class="main-body__area--title">
                                    <div class="title">
                                        <h3>Edit Sub Collection</h3>
                                        <p>
                                            Edit Sub Collection Information
                                        </p>
                                    </div>

                                </div>
                                <div class="item-form-area">
                                    <div class="collection">
                                        <div class="collection__row">
                                            <div class="collection__row--check">
                                                <?php $post_id_url = $_GET["postid"];?>
                                                <?php $post_title = get_the_title($post_id);?>
                                                <div id="multiselect-subcollection">
                                                    <!-- Parent Sub Collection -->
                                                    <?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$OnecollectionArgs = array(
    'post_type' => 'sub-collection',
    'post_status' => 'publish',
    'order' => 'ASC',
    'paged' => $paged,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'sub_collection',
            'value' => $post_id_url,
            'compare' => 'IN',
        ),
    ),
);
$onesubcollection_query = new WP_Query($OnecollectionArgs);
?>
                                                    <?php if ($onesubcollection_query->have_posts()) {?>
                                                    <?php while ($onesubcollection_query->have_posts()) {
    $onesubcollection_query->the_post();
    ?>
                                                    <?php
$get_child_title = get_the_title();
    $post_id = get_the_ID();

    ?>
                                                    <div class="check-area">
                                                        <div class="check-content">
                                                            <div class="arrow-img">
                                                                <img src=""
                                                                    alt="Arrow Icon">
                                                            </div>
                                                            <div class="content-title">
                                                                <?php echo $get_child_title; ?>
                                                            </div>
                                                            <div class="content-btn">
                                                                <div class="edit">Edit</div>
                                                                <a class="delete"
                                                                    href="<?php echo get_delete_post_link(); ?>"
                                                                    onclick="return confirm('Are you sure you wanna delete this?')">Delete
                                                                </a>
                                                            </div>
                                                            <div class="float-box popup">
                                                                <div class="float-box__container">
                                                                    <div class="close">
                                                                        <svg class="Icon Icon--close"
                                                                            role="presentation" viewBox="0 0 16 14">
                                                                            <path d="M15 0L1 14m14 0L1 0"
                                                                                stroke="#464e5f" fill="#464e5f"
                                                                                fill-rule="evenodd"></path>
                                                                        </svg>
                                                                    </div>
                                                                    <?php acf_form(array(
        'post_id' => $post_id, //Variable that you'll get from the URL
        'post_title' => true,
        'post_content' => false,
        'submit_value' => 'Update Sub Collection',
        'return' => add_query_arg('updated', 'true', site_url('edit-sub-collection') . '?postid=' . $post_id_url),
    ));?>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- Children Query -->
                                                        <?php
$twosubcollection_args = array(
        'post_type' => 'sub-collection',
        'post_status' => 'publish',
        'order' => 'ASC',
        'fields' => 'ids',
        'meta_query' => array(
            'relation' => 'AND',

            array(
                'key' => 'sub_collection',
                'value' => $post_id,
                'compare' => '=',
            ),

        ),
    );
    $twosubcollection_query = new WP_Query($twosubcollection_args);
    ?>
                                                        <?php if ($twosubcollection_query->have_posts()) {?>
                                                        <?php while ($twosubcollection_query->have_posts()) {
        $twosubcollection_query->the_post();?>
                                                        <?php
$get_children_title = get_the_title();
        $post_id = get_the_ID();
        ?>
                                                        <div class="check-area">
                                                            <div class="check-content">
                                                                <div class="arrow-img">
                                                                    <img src=""
                                                                        alt="Arrow Icon">
                                                                </div>
                                                                <div class="content-title">
                                                                    <?php echo $get_children_title; ?>
                                                                </div>
                                                                <div class="content-btn">
                                                                    <div class="edit">Edit</div>
                                                                    <a class="delete"
                                                                        href="<?php echo get_delete_post_link(); ?>"
                                                                        onclick="return confirm('Are you sure you wanna delete this?')">Delete
                                                                    </a>
                                                                </div>
                                                                <div class="float-box popup">
                                                                    <div class="float-box__container">
                                                                        <div class="close">
                                                                            <svg class="Icon Icon--close"
                                                                                role="presentation" viewBox="0 0 16 14">
                                                                                <path d="M15 0L1 14m14 0L1 0"
                                                                                    stroke="#464e5f" fill="#464e5f"
                                                                                    fill-rule="evenodd"></path>
                                                                            </svg>
                                                                        </div>
                                                                        <?php acf_form(array(
            'post_id' => $post_id, //Variable that you'll get from the URL
            'post_title' => true,
            'post_content' => false,
            'submit_value' => 'Update Collection',
            'return' => add_query_arg('updated', 'true', site_url('edit-sub-collection') . '?postid=' . $post_id_url),
        ));?>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- Children Query -->
                                                            <?php
$threesubcollection_args = array(
            'post_type' => 'sub-collection',
            'post_status' => 'publish',
            'order' => 'ASC',
            'fields' => 'ids',
            'meta_query' => array(
                'relation' => 'AND',

                array(
                    'key' => 'sub_collection',
                    'value' => $post_id,
                    'compare' => '=',
                ),

            ),
        );
        $threesubcollection_query = new WP_Query($threesubcollection_args);
        ?>
                                                            <?php if ($threesubcollection_query->have_posts()) {?>
                                                            <?php while ($threesubcollection_query->have_posts()) {
            $threesubcollection_query->the_post();?>
                                                            <?php
$post_id = get_the_ID();
            $get_threechildren_title = get_the_title();?>
                                                            <div class="check-area">
                                                                <div class="check-content">
                                                                    <div class="arrow-img">
                                                                        <img src=""
                                                                            alt="Arrow Icon">
                                                                    </div>
                                                                    <div class="content-title">
                                                                        <?php echo $get_threechildren_title; ?>
                                                                    </div>

                                                                    <div class="content-btn">
                                                                        <div class="edit">Edit</div>
                                                                        <a class="delete"
                                                                            href="<?php echo get_delete_post_link(); ?>"
                                                                            onclick="return confirm('Are you sure you wanna delete this?')">Delete
                                                                        </a>
                                                                    </div>
                                                                    <div class="float-box popup">
                                                                        <div class="float-box__container">
                                                                            <div class="close">
                                                                                <svg class="Icon Icon--close"
                                                                                    role="presentation"
                                                                                    viewBox="0 0 16 14">
                                                                                    <path d="M15 0L1 14m14 0L1 0"
                                                                                        stroke="#464e5f" fill="#464e5f"
                                                                                        fill-rule="evenodd"></path>
                                                                                </svg>
                                                                            </div>
                                                                            <?php acf_form(array(
                'post_id' => $post_id, //Variable that you'll get from the URL
                'post_title' => true,
                'post_content' => false,
                'submit_value' => 'Update Sub Collection',
                'return' => add_query_arg('updated', 'true', site_url('edit-sub-collection') . '?postid=' . $post_id_url),
            ));?>
                                                                        </div>

                                                                    </div>



                                                                </div>

                                                                <!-- Children Query -->
                                                                <?php
$foursubcollection_args = array(
                'post_type' => 'sub-collection',
                'post_status' => 'publish',
                'order' => 'ASC',
                'fields' => 'ids',
                'meta_query' => array(
                    'relation' => 'AND',

                    array(
                        'key' => 'sub_collection',
                        'value' => $post_id,
                        'compare' => '=',
                    ),

                ),
            );
            $foursubcollection_query = new WP_Query($foursubcollection_args);
            ?>
                                                                <?php if ($foursubcollection_query->have_posts()) {?>
                                                                <?php while ($foursubcollection_query->have_posts()) {
                $foursubcollection_query->the_post();?>
                                                                <?php
$post_id = get_the_ID();
                $get_fourchildren_title = get_the_title();?>
                                                                <div class="check-area">
                                                                    <div class="check-content">
                                                                        <div class="arrow-img">
                                                                            <img src=""
                                                                                alt="Arrow Icon">
                                                                        </div>
                                                                        <div class="content-title">
                                                                            <?php echo $get_fourchildren_title; ?>
                                                                        </div>
                                                                        <div class="content-btn">
                                                                            <div class="edit">Edit</div>
                                                                            <a class="delete"
                                                                                href="<?php echo get_delete_post_link(); ?>"
                                                                                onclick="return confirm('Are you sure you wanna delete this?')">Delete
                                                                            </a>
                                                                        </div>
                                                                        <div class="float-box popup">
                                                                            <div class="float-box__container">
                                                                                <div class="close">
                                                                                    <svg class="Icon Icon--close"
                                                                                        role="presentation"
                                                                                        viewBox="0 0 16 14">
                                                                                        <path d="M15 0L1 14m14 0L1 0"
                                                                                            stroke="#464e5f"
                                                                                            fill="#464e5f"
                                                                                            fill-rule="evenodd"></path>
                                                                                    </svg>
                                                                                </div>
                                                                                <?php acf_form(array(
                    'post_id' => $post_id, //Variable that you'll get from the URL
                    'post_title' => true,
                    'post_content' => false,
                    'submit_value' => 'Update Sub Collection',
                    'return' => add_query_arg('updated', 'true', site_url('edit-sub-collection') . '?postid=' . $post_id_url),
                ));?>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <!-- Children Query -->
                                                                    <?php
$fifthsubcollection_args = array(
                    'post_type' => 'sub-collection',
                    'post_status' => 'publish',
                    'order' => 'ASC',
                    'fields' => 'ids',
                    'meta_query' => array(
                        'relation' => 'AND',

                        array(
                            'key' => 'sub_collection',
                            'value' => $post_id,
                            'compare' => '=',
                        ),

                    ),
                );
                $fifisubcollection_query = new WP_Query($fifthsubcollection_args);
                ?>
                                                                    <?php if ($fifisubcollection_query->have_posts()) {?>
                                                                    <?php while ($fifisubcollection_query->have_posts()) {
                    $fifisubcollection_query->the_post();?>
                                                                    <?php
$post_id = get_the_ID();
                    $get_fifchildren_title = get_the_title();?>
                                                                    <div class="check-area">
                                                                        <div class="check-content">
                                                                            <div class="arrow-img">
                                                                                <img src=""
                                                                                    alt="Arrow Icon">
                                                                            </div>
                                                                            <div class="content-title">
                                                                                <?php echo $get_fifchildren_title; ?>
                                                                            </div>
                                                                            <div class="content-btn">
                                                                                <div class="edit">Edit</div>
                                                                                <a class="delete"
                                                                                    href="<?php echo get_delete_post_link(); ?>"
                                                                                    onclick="return confirm('Are you sure you wanna delete this?')">Delete
                                                                                </a>
                                                                            </div>
                                                                            <div class="float-box popup">
                                                                                <div class="float-box__container">
                                                                                    <div class="close">
                                                                                        <svg class="Icon Icon--close"
                                                                                            role="presentation"
                                                                                            viewBox="0 0 16 14">
                                                                                            <path
                                                                                                d="M15 0L1 14m14 0L1 0"
                                                                                                stroke="#464e5f"
                                                                                                fill="#464e5f"
                                                                                                fill-rule="evenodd">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </div>
                                                                                    <?php acf_form(array(
                        'post_id' => $post_id, //Variable that you'll get from the URL
                        'post_title' => true,
                        'post_content' => false,
                        'submit_value' => 'Update Sub Collection',
                        'return' => add_query_arg('updated', 'true', site_url('edit-sub-collection') . '?postid=' . $post_id_url),
                    ));?>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <!-- Children Query -->
                                                                        <?php
$sixsubcollection_args = array(
                        'post_type' => 'sub-collection',
                        'post_status' => 'publish',
                        'order' => 'ASC',
                        'fields' => 'ids',
                        'meta_query' => array(
                            'relation' => 'AND',

                            array(
                                'key' => 'sub_collection',
                                'value' => $post_id,
                                'compare' => '=',
                            ),

                        ),
                    );
                    $sixsubcollection_query = new WP_Query($sixsubcollection_args);
                    ?>
                                                                        <?php if ($sixsubcollection_query->have_posts()) {?>
                                                                        <?php while ($sixsubcollection_query->have_posts()) {
                        $sixsubcollection_query->the_post();?>
                                                                        <?php
$post_id = get_the_ID();
                        $get_sixchildren_title = get_the_title();?>
                                                                        <div class="check-area">
                                                                            <div class="check-content">
                                                                                <div class="arrow-img">
                                                                                    <img src=""
                                                                                        alt="Arrow Icon">
                                                                                </div>
                                                                                <div class="content-title">
                                                                                    <?php echo $get_sixchildren_title; ?>
                                                                                </div>
                                                                                <div class="content-btn">
                                                                                    <div class="edit">Edit</div>
                                                                                    <a class="delete"
                                                                                        href="<?php echo get_delete_post_link(); ?>"
                                                                                        onclick="return confirm('Are you sure you wanna delete this?')">Delete
                                                                                    </a>
                                                                                </div>
                                                                                <div class="float-box popup">
                                                                                    <div class="float-box__container">
                                                                                        <div class="close">
                                                                                            <svg class="Icon Icon--close"
                                                                                                role="presentation"
                                                                                                viewBox="0 0 16 14">
                                                                                                <path
                                                                                                    d="M15 0L1 14m14 0L1 0"
                                                                                                    stroke="#464e5f"
                                                                                                    fill="#464e5f"
                                                                                                    fill-rule="evenodd">
                                                                                                </path>
                                                                                            </svg>
                                                                                        </div>
                                                                                        <?php acf_form(array(
                            'post_id' => $post_id, //Variable that you'll get from the URL
                            'post_title' => true,
                            'post_content' => false,
                            'submit_value' => 'Update Sub Collection',
                            'return' => add_query_arg('updated', 'true', site_url('edit-sub-collection') . '?postid=' . $post_id_url),
                        ));?>
                                                                                    </div>

                                                                                </div>
                                                                            </div>

                                                                            <!-- Children Query -->
                                                                            <?php
$sevenssubcollection_args = array(
                            'post_type' => 'sub-collection',
                            'post_status' => 'publish',
                            'order' => 'ASC',
                            'fields' => 'ids',
                            'meta_query' => array(
                                'relation' => 'AND',

                                array(
                                    'key' => 'sub_collection',
                                    'value' => $post_id,
                                    'compare' => '=',
                                ),

                            ),
                        );
                        $sevenssubcollection_query = new WP_Query($sevenssubcollection_args);
                        ?>
                                                                            <?php if ($sevenssubcollection_query->have_posts()) {?>
                                                                            <?php while ($sevenssubcollection_query->have_posts()) {
                            $sevenssubcollection_query->the_post();?>
                                                                            <?php
$post_id = get_the_ID();
                            $get_sevenchildren_title = get_the_title();?>
                                                                            <div class="check-area">
                                                                                <div class="check-content">
                                                                                    <div class="arrow-img">
                                                                                        <img src=""
                                                                                            alt="Arrow Icon">
                                                                                    </div>
                                                                                    <div class="content-title">
                                                                                        <?php echo $get_sevenchildren_title; ?>
                                                                                    </div>
                                                                                    <div class="content-btn">
                                                                                        <div class="edit">Edit</div>
                                                                                        <a class="delete"
                                                                                            href="<?php echo get_delete_post_link(); ?>"
                                                                                            onclick="return confirm('Are you sure you wanna delete this?')">Delete
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="float-box popup">
                                                                                        <div
                                                                                            class="float-box__container">
                                                                                            <div class="close">
                                                                                                <svg class="Icon Icon--close"
                                                                                                    role="presentation"
                                                                                                    viewBox="0 0 16 14">
                                                                                                    <path
                                                                                                        d="M15 0L1 14m14 0L1 0"
                                                                                                        stroke="#464e5f"
                                                                                                        fill="#464e5f"
                                                                                                        fill-rule="evenodd">
                                                                                                    </path>
                                                                                                </svg>
                                                                                            </div>
                                                                                            <?php acf_form(array(
                                'post_id' => $post_id, //Variable that you'll get from the URL
                                'post_title' => true,
                                'post_content' => false,
                                'submit_value' => 'Update Sub Collection',
                                'return' => add_query_arg('updated', 'true', site_url('edit-sub-collection') . '?postid=' . $post_id_url),
                            ));?>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <!-- Children Query -->
                                                                                <?php
$eightsubcollection_args = array(
                                'post_type' => 'sub-collection',
                                'post_status' => 'publish',
                                'order' => 'ASC',
                                'fields' => 'ids',
                                'meta_query' => array(
                                    'relation' => 'AND',

                                    array(
                                        'key' => 'sub_collection',
                                        'value' => $post_id,
                                        'compare' => '=',
                                    ),

                                ),
                            );
                            $eightssubcollection_query = new WP_Query($eightsubcollection_args);
                            ?>
                                                                                <?php if ($eightssubcollection_query->have_posts()) {?>
                                                                                <?php while ($eightssubcollection_query->have_posts()) {
                                $eightssubcollection_query->the_post();?>
                                                                                <?php
$post_id = get_the_ID();
                                $get_eightchildren_title = get_the_title();?>
                                                                                <div class="check-area">
                                                                                    <div class="check-content">
                                                                                        <div class="arrow-img">
                                                                                            <img src=""
                                                                                                alt="Arrow Icon">
                                                                                        </div>
                                                                                        <div class="content-title">
                                                                                            <?php echo $get_eightchildren_title; ?>
                                                                                        </div>
                                                                                        <div class="content-btn">
                                                                                            <div class="edit">Edit</div>
                                                                                            <a class="delete"
                                                                                                href="<?php echo get_delete_post_link(); ?>"
                                                                                                onclick="return confirm('Are you sure you wanna delete this?')">Delete
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="float-box popup">
                                                                                            <div
                                                                                                class="float-box__container">
                                                                                                <div class="close">
                                                                                                    <svg class="Icon Icon--close"
                                                                                                        role="presentation"
                                                                                                        viewBox="0 0 16 14">
                                                                                                        <path
                                                                                                            d="M15 0L1 14m14 0L1 0"
                                                                                                            stroke="#464e5f"
                                                                                                            fill="#464e5f"
                                                                                                            fill-rule="evenodd">
                                                                                                        </path>
                                                                                                    </svg>
                                                                                                </div>
                                                                                                <?php acf_form(array(
                                    'post_id' => $post_id, //Variable that you'll get from the URL
                                    'post_title' => true,
                                    'post_content' => false,
                                    'submit_value' => 'Update Sub Collection',
                                    'return' => add_query_arg('updated', 'true', site_url('edit-sub-collection') . '?postid=' . $post_id_url),
                                ));?>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>


                                                                                    <!-- Children Query -->
                                                                                    <?php
$ninesubcollection_args = array(
                                    'post_type' => 'sub-collection',
                                    'post_status' => 'publish',
                                    'order' => 'ASC',
                                    'fields' => 'ids',
                                    'meta_query' => array(
                                        'relation' => 'AND',

                                        array(
                                            'key' => 'sub_collection',
                                            'value' => $post_id,
                                            'compare' => '=',
                                        ),

                                    ),
                                );
                                $ninesubcollection_query = new WP_Query($ninesubcollection_args);
                                ?>
                                                                                    <?php if ($ninesubcollection_query->have_posts()) {?>
                                                                                    <?php while ($ninesubcollection_query->have_posts()) {
                                    $ninesubcollection_query->the_post();?>
                                                                                    <?php
$post_id = get_the_ID();
                                    $get_ninechildren_title = get_the_title();?>
                                                                                    <div class="check-area">
                                                                                        <div class="check-content">
                                                                                            <div class="arrow-img">
                                                                                                <img src=""
                                                                                                    alt="Arrow Icon">
                                                                                            </div>
                                                                                            <div class="content-title">
                                                                                                <?php echo $get_ninechildren_title; ?>
                                                                                            </div>
                                                                                            <div class="content-btn">
                                                                                                <div class="edit">Edit
                                                                                                </div>
                                                                                                <a class="delete"
                                                                                                    href="<?php echo get_delete_post_link(); ?>"
                                                                                                    onclick="return confirm('Are you sure you wanna delete this?')">Delete
                                                                                                </a>
                                                                                            </div>
                                                                                            <div
                                                                                                class="float-box popup">
                                                                                                <div
                                                                                                    class="float-box__container">
                                                                                                    <div class="close">
                                                                                                        <svg class="Icon Icon--close"
                                                                                                            role="presentation"
                                                                                                            viewBox="0 0 16 14">
                                                                                                            <path
                                                                                                                d="M15 0L1 14m14 0L1 0"
                                                                                                                stroke="#464e5f"
                                                                                                                fill="#464e5f"
                                                                                                                fill-rule="evenodd">
                                                                                                            </path>
                                                                                                        </svg>
                                                                                                    </div>
                                                                                                    <?php acf_form(array(
                                        'post_id' => $post_id, //Variable that you'll get from the URL
                                        'post_title' => true,
                                        'post_content' => false,
                                        'submit_value' => 'Update Sub Collection',
                                        'return' => add_query_arg('updated', 'true', site_url('edit-sub-collection') . '?postid=' . $post_id_url),
                                    ));?>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>

                                                                                        <!-- Children Query -->
                                                                                        <?php
$tensubcollection_args = array(
                                        'post_type' => 'sub-collection',
                                        'post_status' => 'publish',
                                        'order' => 'ASC',
                                        'fields' => 'ids',
                                        'meta_query' => array(
                                            'relation' => 'AND',

                                            array(
                                                'key' => 'sub_collection',
                                                'value' => $post_id,
                                                'compare' => '=',
                                            ),

                                        ),
                                    );
                                    $tensubcollection_query = new WP_Query($tensubcollection_args);
                                    ?>
                                                                                        <?php if ($tensubcollection_query->have_posts()) {?>
                                                                                        <?php while ($tensubcollection_query->have_posts()) {
                                        $tensubcollection_query->the_post();?>
                                                                                        <?php
$post_id = get_the_ID();
                                        $get_tenchildren_title = get_the_title();?>
                                                                                        <div class="check-area">
                                                                                            <div class="check-content">
                                                                                                <div class="arrow-img">
                                                                                                    <img src=""
                                                                                                        alt="Arrow Icon">
                                                                                                </div>
                                                                                                <div
                                                                                                    class="content-title">
                                                                                                    <?php echo $get_tenchildren_title; ?>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="content-btn">
                                                                                                    <div class="edit">
                                                                                                        Edit</div>
                                                                                                    <a class="delete"
                                                                                                        href="<?php echo get_delete_post_link(); ?>"
                                                                                                        onclick="return confirm('Are you sure you wanna delete this?')">Delete
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="float-box popup">
                                                                                                    <div
                                                                                                        class="float-box__container">
                                                                                                        <div
                                                                                                            class="close">
                                                                                                            <svg class="Icon Icon--close"
                                                                                                                role="presentation"
                                                                                                                viewBox="0 0 16 14">
                                                                                                                <path
                                                                                                                    d="M15 0L1 14m14 0L1 0"
                                                                                                                    stroke="#464e5f"
                                                                                                                    fill="#464e5f"
                                                                                                                    fill-rule="evenodd">
                                                                                                                </path>
                                                                                                            </svg>
                                                                                                        </div>
                                                                                                        <?php acf_form(array(
                                            'post_id' => $post_id, //Variable that you'll get from the URL
                                            'post_title' => true,
                                            'post_content' => false,
                                            'submit_value' => 'Update Sub Collection',
                                            'return' => add_query_arg('updated', 'true', site_url('edit-sub-collection') . '?postid=' . $post_id_url),
                                        ));?>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>


                                                                                        </div>
                                                                                        <?php
}

                                    }
                                    ?>
                                                                                        <!-- Children Query -->


                                                                                    </div>
                                                                                    <?php
}

                                }
                                ?>
                                                                                    <!-- Children Query -->


                                                                                </div>
                                                                                <?php
}

                            }
                            ?>
                                                                                <!-- Children Query -->


                                                                            </div>
                                                                            <?php
}

                        }
                        ?>
                                                                            <!-- Children Query -->
                                                                        </div>
                                                                        <?php
}

                    }
                    ?>
                                                                        <!-- Children Query -->
                                                                    </div>
                                                                    <?php
}

                }
                ?>
                                                                    <!-- Children Query -->

                                                                </div>
                                                                <?php
}

            }
            ?>
                                                                <!-- Children Query -->


                                                            </div>

                                                            <?php
}

        }
        ?>
                                                            <!-- Children Query -->


                                                        </div>

                                                        <?php
}

    }
    ?>
                                                        <!-- Children Query -->

                                                    </div>

                                                    <?php
}
}
?>
                                                    <!-- End of Parent Sub Collection -->
                                                </div>
                                            </div>


                                        </div>
                                    </div>




                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php include get_theme_file_path('partials/footer.php');?>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.edit').click(function() {
        console.log("Tap Open");
        $(this).parent().next('.popup').addClass('open');
    });
    $('.close').click(function(e) {
        e.preventDefault();
        console.log("Tap Close");
        $(".popup").removeClass("open");
    });
});
</script>

<?php get_footer('archiving');?>