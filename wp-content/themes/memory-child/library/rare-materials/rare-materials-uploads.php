<div class="tab__content">
    <div class="catalog">
        <div class="catalog__add">

            <div class="catalog__add--title">
                <h3>
                    Upload Electronic Files
                </h3>
            </div>
            <div class="catalog__add--content">
                <?php
$random = time() . rand(10 * 45, 100 * 98);
acf_form(array(
    'post_id' => 'new_post',
    'post_title' => false,
    'post_content' => false,
    'field_groups' => array(
        'group_63cf729b65b5b',
    ),
    'updated_message' => __("New File is successfully submitted.", 'acf'),
    'new_post' => array(
        'post_type' => 'uploads',
        'post_status' => 'publish',
        'post_title' => 'File Upload No. ' . $random . ' ',
    ),
    'submit_value' => 'Submit',
));
?>

            </div>
        </div>
    </div>
</div>