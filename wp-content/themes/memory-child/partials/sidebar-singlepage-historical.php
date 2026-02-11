<?php
// Get current filter values
$heraldric_items_selected = $_GET['heraldric_items'] ?? [];
$seals_selected          = $_GET['seals_logos'] ?? [];
$sort_by                 = $_GET['sort_by'] ?? '';
$search_term             = $_GET['s'] ?? '';
?>

<form method="get"
    action="<?php echo esc_url(get_post_type_archive_link('historical-sites')); ?>"
    class="p-4">

    <!-- SEARCH -->
    <div class="row g-4 border rounded mb-5">
        <div class="input-group">
            <input type="search" name="s" class="form-control border-0" placeholder="Search historical sites..."
                value="<?php echo esc_attr($search_term); ?>">
            <button class="button" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>

    <!-- FILTERS -->
    <div class="row g-4 border rounded p-4 bg-body-tertiary">

        <!-- FILTER BY -->
        <div class="col-12 mb-3">
            <h6 class="mb-3 fw-bold">Filter by Status</h6>

            <select name="status" class="form-select mb-2">
                <option value="">-Select-</option>
                <option value="level_1" <?php selected($_GET['status'] ?? '', 'level_1'); ?>>Level I</option>
                <option value="level_2" <?php selected($_GET['status'] ?? '', 'level_2'); ?>>Level II</option>
                <option value="delisted" <?php selected($_GET['status'] ?? '', 'delisted'); ?>>Delisted</option>
                <option value="removed" <?php selected($_GET['status'] ?? '', 'removed'); ?>>Removed</option>
            </select>

            <select name="marker_category" class="form-select">
                <option value="">-Select-</option>
                <option value="structures" <?php selected($_GET['marker_category'] ?? '', 'structures'); ?>>Structures</option>
                <option value="buildings" <?php selected($_GET['marker_category'] ?? '', 'buildings'); ?>>Buildings</option>
            </select>
        </div>

        <div class="col-12 mb-3">
            <h6 class="mb-3 fw-bold">Filter by Place</h6>

            <select id="region" name="region" class="form-select mb-2">
                <option value="">-Select Region-</option>
            </select>

            <select id="province" name="province" class="form-select mb-2">
                <option value="">-Select Province-</option>
            </select>

            <select id="city" name="city" class="form-select mb-2">
                <option value="">-Select City / Municipality-</option>
            </select>
        </div>


        <!-- FILTER BY TIME -->
        <div class="col-12">
            <h6 class="mb-3 fw-bold">Filter by Time</h6>

            <select name="year_filter" class="form-select mb-2">
                <option value="">Year</option>
            </select>

            <select name="orderby" class="form-select">
                <option value="date-desc" <?php selected($_GET['orderby'] ?? '', 'date-desc'); ?>>
                    Newest to Oldest
                </option>
                <option value="date-asc" <?php selected($_GET['orderby'] ?? '', 'date-asc'); ?>>
                    Oldest to Newest
                </option>
            </select>
        </div>

        <!-- BUTTON -->
        <div class="col-12">
            <button type="submit"
                class="btn w-100 mt-4 fw-bold"
                style="background-color:#6b4a1f;color:white;">
                Apply Filters
            </button>
        </div>

    </div>

</form>