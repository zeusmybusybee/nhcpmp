<?php

$map = [
    'articles' => [
        'title' => 'title',
        'location' => 'location_details',
        'contact' => 'contact_details',
        'email' => 'email_details',
    ],
    'book' => [
        'title' => 'title_books',
        'location' => 'location_details_books',
        'contact' => 'contact_details_books',
        'email' => 'email_details_books',
    ],
    'artifacts' => [
        'title' => 'title_artifacts',
        'location' => 'location_details_artifacts',
        'contact' => 'contact_details_artifacts',
        'email' => 'email_details_artifacts',
    ],
    'ph-heraldry-registry' => [
        'title' => 'title_heraldry',
        'location' => 'location_details_heraldry',
        'contact' => 'contact_details_heraldry',
        'email' => 'email_details_heraldry',
    ],
    'historical-sites' => [
        'title' => 'title_historic',
        'location' => 'location_details_historic',
        'contact' => 'contact_details_historic',
        'email' => 'email_details_historic',
    ],
    'a-v-material' => [
        'title' => 'title_audio',
        'location' => 'location_details_audio',
        'contact' => 'contact_details_audio',
        'email' => 'email_details_audio',
    ],
    'foundation-of-towns' => [
        'title' => 'title_foundation',
        'location' => 'location_details_foundation',
        'contact' => 'contact_details_foundation',
        'email' => 'email_details_foundation',
    ],
];

// Map specific pages to post types
$page_map = [
    'library' => 'book',
];

$current = null;

// 1. Check post type archives
foreach ($map as $post_type => $fields) {
    if (is_post_type_archive($post_type)) {
        $current = $fields;
        break;
    }
}

// 2. Check page mappings (if no match yet)
if (!$current) {
    foreach ($page_map as $page => $mapped_post_type) {
        if (is_page($page) && isset($map[$mapped_post_type])) {
            $current = $map[$mapped_post_type];
            break;
        }
    }
}

if ($current) :

    $title = get_field($current['title'], 'option');
    $location = get_field($current['location'], 'option');
    $contact = get_field($current['contact'], 'option');
    $email = get_field($current['email'], 'option');
?>

    <div class="nm-sidebar-card nm-nhcp-visit bg-body-tertiary">

        <?php if ($title) : ?>
            <h2 class="nm-sidebar-title"><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if ($location) : ?>
            <div class="row">
                <div class="col-md-2">
                    <span class="nm-sidebar-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>
                </div>
                <div class="col-md-10">
                    <p><?php echo $location; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($contact) : ?>
            <div class="row">
                <div class="col-md-2">
                    <span class="nm-sidebar-icon">
                        <i class="fa-solid fa-phone"></i>
                    </span>
                </div>
                <div class="col-md-10">
                    <p><?php echo $contact; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($email) : ?>
            <div class="row">
                <div class="col-md-2">
                    <span class="nm-sidebar-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                </div>
                <div class="col-md-10">
                    <p><?php echo $email; ?></p>
                </div>
            </div>
        <?php endif; ?>

    </div>

<?php endif; ?>