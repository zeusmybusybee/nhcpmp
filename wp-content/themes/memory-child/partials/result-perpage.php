<div class="d-flex align-items-center gap-3 result-item">

    <span>Results per page:</span>

    <form method="get" id="perPageForm">

        <?php
        $per_page = $_GET['posts_per_page'] ?? 10;

        foreach ($_GET as $key => $value) {
            if ($key === 'posts_per_page') continue; // skip para di magduplicate
            if (is_array($value)) continue;

            echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
        }
        ?>

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