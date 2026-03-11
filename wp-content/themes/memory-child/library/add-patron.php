<?php
/*** Template Name: Add Patron */
acf_form_head();
get_header('archiving');
?>
<style>
.acf-field-63cf64c28e077{
    display:none !important;
}
</style>


<section>
    <div class="main-content">

        <?php include get_theme_file_path('partials/sidebar-library.php');?>
        <?php include get_theme_file_path('partials/navbar-library.php');?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__breadcrumb">
                        <div class="main-body__breadcrumb--list"><?php //get_breadcrumb();?></div>
                    </div>
                    <?php if(isset($_GET['updated'])){ ?>
                        <div class="table__header" style="margin-top: 25px; padding-bottom: 0;">
                            <div class="viewall-area">
                                <a href="<?php echo get_permalink($_GET['updated']); ?>">View Newly Added</a>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="main-body__area">
                        <div class="catalog">
                            <div class="catalog__add">
                                <div class="catalog__add--title">
                                    <h3>
                                        Patron Data Entry
                                    </h3>
                                </div>
                                <div class="catalog__add--content">
                                    <?php
acf_form(array(
    'post_id' => 'new_post',
    'post_title' => true,
    'post_content' => false,
    'field_groups' => array(
        'group_63cf55cf2d176',
    ),
    'updated_message' => __("New Patron is successfully submitted.", 'acf'),
    'new_post' => array(
        'post_type' => 'patrons',
        'post_status' => 'publish',
    ),
    'submit_value' => 'Submit',
    'return' =>  '?updated=%post_id%'
));
?>
                                    
                                    <div class="table__header" style="margin-top: -48px; justify-content: end; padding-bottom: 0;">
                                        <div class="viewall-area">
                                            <a href="<?php echo home_url(add_query_arg(array(), $wp->request)); ?>">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php include get_theme_file_path('partials/footer.php');?>
            </div>
        </div>
    </div>
</section>

<script>

var x = document.getElementsByClassName("acf-field-text acf-field-63cf55cf87c14")[0];
        x.id="added_id"

var studentDiv = document.querySelector('#added_id');

studentDiv.insertAdjacentHTML('afterend','<div>   <div class="acf-field acf-field-text acf-field-63cf55cf87c14" data-name="p_id_number" data-type="text" data-key="field_63cf55cf87c14"><div class="acf-label"><label for="acf-field_63cf55cf87c14">Choose a Group:</label></div><div class="acf-input"><div class="acf-input-wrap">  <select onchange="getMultipleSelected(this.id)"  name="test[]" id="test" required><option value="">Select a Group</option><?php $arg_groups = array('post_type' => 'settings-group','post_status' => 'publish','posts_per_page' => -1,'paged' => $paged,);$arg_query = new WP_Query($arg_groups);  if ($arg_query->have_posts()) { while ($arg_query->have_posts()) { $arg_query->the_post();?> <option value="<?php echo get_the_ID(); ?>"><?php echo get_field('group_name'); ?></option> <?php } } ?></select>  </div></div></div>            ');

</script>

<script>
function getMultipleSelected(fieldID){

  var elements = document.getElementById(fieldID).childNodes; 
  var selectedKeyValue = {};
  var arrayOfSelecedIDs=[];

  for(i=0;i<elements.length;i++){

    if(elements[i].selected){

     selectedKeyValue[elements[i].value]=elements[i].textContent;

     arrayOfSelecedIDs.push(elements[i].value)

    }
    
  }
  
  // output or do seomething else with these values :)


  document.getElementById('acf-field_63cf64c28e077').value = arrayOfSelecedIDs;

}
</script>

<?php get_footer('archiving');?>