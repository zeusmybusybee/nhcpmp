<?php

/*** Template Name: Add Item Management */
acf_form_head();
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
                    <?php if (isset($_GET['updated']) && $_GET['updated']) { ?>
                        <div class="table__header" style="margin-top: 25px; padding-bottom: 0;">
                            <div class="viewall-area">
                                <a href="<?php echo get_permalink($_GET['updated']); ?>">View Newly Added</a>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="main-body__area">
                        <div class="main-body__area--row">
                            <div class="main-body__area--form">
                                <div class="main-body__area--title">
                                    <div class="title">
                                        <h3>Add Item</h3>
                                        <p>
                                            Add Item Information
                                        </p>
                                    </div>
                                </div>
                                <div class="item-form-area">
                                    <!-- <form id="post" class="acf-form" action="" method="post"> -->
                                    <?php
                                    $date = date('M-d-Y');
                                    $random = time() . rand(10 * 45, 100 * 98);
                                    acf_form(array(
                                        'post_id' => 'new_post',
                                        'post_title' => true,
                                        'field_groups' => array(
                                            'group_63b5362b4abed',
                                        ),
                                        'new_post' => array(
                                            'post_type' => 'item',
                                            'post_status' => 'publish',
                                        ),
                                        'submit_value' => 'Add Item',
                                        'form' => true,
                                        'return' =>  '?updated=%post_id%'
                                    ));
                                    ?>
                                    <!-- <div class="variants">
                                            <div class="acf-field acf-field-post-object old-select-variant">
                                                <div class="acf-label">
                                                    <label>Sub Collections</label>
                                                </div>
                                                <div class="acf-input">
                                                    <select id="variants" class="placeholderVariants">
                                                        <option disabled selected>Select</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="acf-form-submit">
                                            <input type="submit" class="acf-button button button-primary button-large"
                                                value="Submit">
                                            <span class="acf-spinner"></span>
                                        </div> -->

                                    <!-- </form> -->

                                    <div class="table__header" style="margin-top: -48px; justify-content: end; padding-bottom: 0;">
                                        <div class="viewall-area">
                                            <a href="<?php echo home_url(add_query_arg(array(), $wp->request)); ?>">Reset</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="main-body__area--collection">

                            </div>
                        </div>
                    </div>
                </div>
                <?php include get_theme_file_path('partials/footer.php'); ?>
            </div>
        </div>
    </div>
</section>

<!-- <script>
jQuery(function($) {
    $('#acf-field_63bd13eaa6ebc').on('change', function() {
        var po_select = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            dataType: "html", // add data type
            data: {
                action: 'get_ajax_posts',
                data: po_select
            },
            success: function(response) {
                $('.variants').html(response);
                var value = $("#variants").val();
                $('#acf-field_63ca00f3c194a').val(value);

                // $( '.variants' ).addClass('front');
                $(".old-select-variant").remove();
            }
        });
    });
    $(document).on('change', '#variants', function() {
        var value = $("#variants").val();
        $('#acf-field_63ca00f3c194a').val(value);
    });
});
</script> -->
<style>
    /* #variants {
    margin-left: 10px;
}

.frontendhidden {
    display: none;
} */

    #variants {
        margin-left: 10px;
    }

    .frontendhidden {
        display: none;
    }

    .add-new-collection {
        background-color: #6262c4;
        width: 200px;
        text-align: center;
        padding: 10px;
        color: #fff;
        border-radius: 6px;
        cursor: pointer;
        margin-top: -61px;
    }

    .remove-collection {
        background-color: #e68080;
        width: 200px;
        text-align: center;
        padding: 10px;
        color: #fff;
        border-radius: 6px;
        cursor: pointer;
    }

    .main-body__area--form .item-form-area .acf-input input[type=checkbox] {
        border: 1px solid #d9d9d9;
        width: auto !important;
        height: auto !important;
        padding-left: 0px !important;
        padding-right: 0px !important;
        font-size: 18px;
        color: #464e5f;
        border-radius: 5px;
    }
</style>


<?php get_footer('archiving'); ?>