<?php
global $wp_query;


?>
<div class="total-result">
    <div class="d-flex justify-content-between align-items-center  p-4 mb-3">
        <h4 class="mb-0 mt-0" style="color:#704b10">
            Results for All
            <?php
            $post_type = get_post_type();
            $post_type_obj = get_post_type_object($post_type);

            if ($post_type_obj) {
                echo esc_html($post_type_obj->labels->name);
            }
            ?>
        </h4>

    </div>
    <div id="applied-filters-container"></div>
</div>