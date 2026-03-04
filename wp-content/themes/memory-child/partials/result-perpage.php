<div class="d-flex align-items-center gap-3 result-item">

    <span>Results per page:</span>

    <form method="get" id="perPageForm">

        <?php
        $per_page = $_GET['posts_per_page'] ?? 10;
        $post_type = get_post_type() ?: 'post'; // default post
        ?>

        <!-- preserve current search -->
        <input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">
        <input type="hidden" name="s" value="<?php echo esc_attr($_GET['s'] ?? ''); ?>">
        <input type="hidden" name="paged" value="1">

        <select name="posts_per_page"
            class="form-select form-select-sm"
            style="width:auto;"
            onchange="this.form.submit()">

            <option value="10" <?php selected($per_page, 10); ?>>10</option>
            <option value="25" <?php selected($per_page, 25); ?>>25</option>
            <option value="50" <?php selected($per_page, 50); ?>>50</option>

        </select>

    </form>

</div>