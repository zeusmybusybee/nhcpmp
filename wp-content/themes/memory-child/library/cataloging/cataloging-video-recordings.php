<div class="tab__content">
    <div class="tab__content--header">
        <div class="tab__content--browse">
            <div class="browse">
                <span>More than 1000+ Browse Video Recordings</span>
            </div>
            <div class="button">
                <a href="<?php echo site_url('/add-video-recordings'); ?>">Add</a>
            </div>
        </div>
    </div>
    <div class="tab__content--table">
        <?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$arg_audiorecordings = array(
    'post_type' => 'video-recording',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'paged' => $paged
);
$arg_audiorecordings_query = new WP_Query($arg_audiorecordings);
?>
        <table id="table_video" class="display">
            <thead>
                <tr>
                    <!--<th>Counter</th>-->
                    <th>Title</th>
                    <th> Action</th>
                </tr>
            </thead>
            <?php if ($arg_audiorecordings_query->have_posts()) {$i = 1;?>

            <tbody>
                <?php while ($arg_audiorecordings_query->have_posts()) {
    $arg_audiorecordings_query->the_post();?>
                <tr>
                    <!--<td class="counter">1</td>-->
                    <td>
                        <div class="catalog">
                            <div class="catalog__img">
                                <?php
                                $image = get_field('cover_image');
                                if (!empty($image)): ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                <?php else: ?>
                                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2023/04/nhcp_logoo.png" style="object-fit: contain; background: rgb(35, 77, 141); padding: 8px;" />
                                <?php endif;?>
                                <!--<div class="catalog__img--icon">-->
                                <!--    <img src="<?php echo THEME_DIR; ?>/assets/img/icon/ic_media.png" alt="">-->
                                <!--</div>-->
                            </div>
                            <div class="catalog__info">
                                <h3 class="catalog__info--title">
                                    <?php echo the_title() ?>
                                </h3>
                                <p class="catalog__info--desc">
                                    <?php echo get_field("vr_place_of_publication") ?> :
                                    <?php echo get_field("vr_publishers_name") ?> ,
                                    <?php echo get_field("vr_date_of_publication") ?>
                                </p>
                                <p class="catalog__info--id">
                                    <?php echo get_field("vr_call_number") ?>
                                </p>
                            </div>

                        </div>

                    </td>
                    <td class="actions">
                        <div class="table__content--body action">
                            <a href="<?php the_permalink();?>" class="preview" target="_new">Preview</a>
                            <a href="<?php echo get_delete_post_link(); ?>" class=" delete" onclick="return confirm('Are you sure you wanna delete this?')">Delete</a>
                            <a href="<?php echo site_url('/edit-video-recordings'); ?>?post=<?php the_ID();?>" class="edit" target="_new">Edit</a>
                        </div>
                    </td>
                </tr>
                <?php
$i++;
}
    ?>
            </tbody>
            <?php

}
?>

        </table>
    </div>
</div>