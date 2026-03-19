<div class="tab__content">
    <div class="tab__content--header">
        <div class="tab__content--browse">
            <div class="browse">
                <span>More than 1000+ Browse E-Resources</span>
            </div>
            <div class="button">
                <a href="<?php echo site_url('/add-e-resources'); ?>">Add</a>
            </div>
        </div>
    </div>
    <div class="tab__content--table">

        <?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$arg_audiovisuals = array(
    'post_type' => 'e-resources',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'paged' => $paged
);
$arg_audiovisual_query = new WP_Query($arg_audiovisuals);
?>

        <table id="table_eresources" class="display">
            <thead>
                <tr>
                    <!--<th>Counter</th>-->
                    <th>Title</th>
                    <th> Action</th>
                </tr>
            </thead>
            <?php if ($arg_audiovisual_query->have_posts()) {$i = 1;?>

            <tbody>
                <?php while ($arg_audiovisual_query->have_posts()) {
    $arg_audiovisual_query->the_post();?>
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
                                <!--    <img src="<?php //echo THEME_DIR; ?>/assets/img/icon/ic_media.png" alt="">-->
                                <!--</div>-->
                            </div>
                            <div class="catalog__info">
                                <h3 class="catalog__info--title">
                                    <?php echo the_title() ?>
                                </h3>
                                <p class="catalog__info--desc">
                                    <?php echo get_field("er_creators") ?> :
                                    <?php echo get_field("er_publisher") ?> ,
                                    <?php echo get_field("er_date") ?>

                                </p>
                                <p class="catalog__info--id">
                                    <?php echo get_field("er_identifier") ?>
                                </p>
                            </div>

                        </div>

                    </td>
                    <td class="actions">
                        <div class="table__content--body action">
                            <a href="<?php the_permalink();?>" class="preview" target="_new">Preview</a>
                            <a href="<?php echo get_delete_post_link(); ?>" class=" delete" onclick="return confirm('Are you sure you wanna delete this?')">Delete</a>
                            <a href="<?php echo site_url('/edit-e-resources'); ?>?post=<?php the_ID();?>" class="edit" target="_new">Edit</a>
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

            </tbody>
        </table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {

        $('#table_eresources').DataTable({

            language: {
                searchPlaceholder: "Search E-Resources",
                search: "",
                paginate: {
                    previous: "<",
                    next: ">"
                }
            }

        });

    });
</script>