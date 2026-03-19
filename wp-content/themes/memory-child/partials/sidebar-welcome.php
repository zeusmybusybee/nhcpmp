<style>
    .nm-sidebar-content p br {
        display: none;
    }
</style>
<?php
if (is_post_type_archive('articles')) {
    $field = 'welcome_greetings';
} elseif (is_post_type_archive('book') || is_page('library')) {
    $field = 'welcome_greetings_books';
} elseif (is_post_type_archive('artifacts')) {
    $field = 'welcome_greetings_artifacts';
} elseif (is_post_type_archive('ph-heraldry-registry')) {
    $field = 'welcome_greetings_heraldry';
} elseif (is_post_type_archive('historical-sites')) {
    $field = 'welcome_greetings_historic';
} elseif (is_post_type_archive('a-v-material')) {
    $field = 'audio_greetings';
} elseif (is_post_type_archive('foundation-of-towns')) {
    $field = 'foundation_greetings';
}

if (!empty($field)) {
    $value = get_field($field, 'option');
    if ($value) {
        echo $value;
    }
}
?>