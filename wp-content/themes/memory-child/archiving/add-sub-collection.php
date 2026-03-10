<?php
/*** Template Name: Add Sub Collection Management */
acf_form_head();
get_header('archiving');
?>

<style>
ol[role='list'],
li {
  list-style: none;
}
</style>

<section>
    <div class="main-content">

        <?php include get_theme_file_path('partials/sidebar.php');?>
        <?php include get_theme_file_path('partials/navbar.php');?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__breadcrumb">
                        <div class="main-body__breadcrumb--list"></div>
                    </div>
                    <div class="main-body__area">
                        <div class="main-body__area--row">
                            <div class="main-body__area--form addcollection">
                                <div class="main-body__area--title">
                                    <h3> Select Sub - Collection</h3>

                                </div>
                                <div class="item-form-area">
                                    <div class="collection">
                                        <div class="collection__row">
                                            <div class="collection__row--check">
                                                <?php $post_id = $_GET["postid"];?>
                                                <?php $post_title = get_the_title($post_id);?>
                                                <div id="multiselect-collection">
                                                    <div class="check-collect">
                                                        <input type="radio" name="collections"
                                                            value="<?php echo $post_id; ?>" checked>
                                                        <?php echo $post_title; ?>
                                                    </div>
                                                </div>
                                                <div class="check">
                                                    <div id="multiselect-subcollection">
                                                        <!-- Parent Sub Collection -->
                                                        <?php
    ////////////////////// WHILE LOOP //////////////////
    ?>
                                                        <div class="check-area">
                                                            <div class="check-content">
                                                                
                                                               
                                                            </div>
                                                           

                                                        
                                                        <!-- End of Parent Sub Collection -->
                                                    </div>
                                                </div>
                                            </div>
                                         
                                            <div class="collection__row--add">

 
 
 <?php 
 
 $str = get_field('sub_collection_data', $_GET['postid']);
 
 if(isset($_POST['submit'])){
     
    $name = $_POST['sub_collection'];
   

if(get_field('sub_collection_data', $_GET['postid'])){

   
   $arr = json_decode($str, true);
   $arrne['name'] = "$name";
   array_push($arr['sub_collection'][0][1][0], $arrne );
   update_post_meta($_GET['postid'], 'sub_collection_data',  json_encode($arr));
  


}else{
   $str = '{ "sub_collection":[ ]}';

   $arr = json_decode($str, true);
   $arrne['name'] = "$name";
   array_push($arr['sub_collection'], $arrne );
   update_post_meta($_GET['postid'], 'sub_collection_data',  json_encode($arr));
} ?>

 <meta http-equiv='refresh' content="0;url=<?php echo $_SERVER['HTTP_REFERER']; ?>">
<?php } ?>

 
 
 
 
 <form id="acf-form" class="acf-form" method="POST" action="">
     
     
     
     
     
     
     
     
     
         <?php
if(get_field('sub_collection_data', $_GET['postid'])){


 $arr = json_decode($str, true);


 //A recursive function to traverse the GeoJSON array.
 echo "<ol>";
function traverseGeoJSON($iterator) {
    
    //If there is a property left.
    echo "<ol>";
    $i = 0;
    echo "<li><input type='radio' name='sub_collection_row' value='$i'>";


    while ( $iterator -> valid() ) {
      //  echo $i;
   
        if($iterator->hasChildren()) 
            traverseGeoJSON($iterator -> getChildren());

        elseif($iterator->key() === "name")
            echo $iterator->current().PHP_EOL;
            
        //Jump to next property.
        $iterator -> next();     
        echo "</li>"; 
        $i++;
    } 
  
    echo "</ol>";
}
echo "</ol>";




foreach($arr as $location)
{

    //Defines iterator for each location.
    $iterator = new RecursiveArrayIterator($location);
    //Call traversestructure to parse the GeoJSON.
    traverseGeoJSON($iterator);
}

}
     ?>
     
     
     
     
     
					
				<div class="acf-fields acf-form-fields -top">
								<div class="acf-field acf-field-text acf-field--post-title is-required" data-name="_post_title" data-type="text" data-key="_post_title" data-required="1">
<div class="acf-label">
<label for="acf-_post_title">Title <span class="acf-required">*</span></label></div>
<div class="acf-input">
<div class="acf-input-wrap"><input type="text" name='sub_collection' placeholder='Enter Sub Collection Name' required="required"></div></div>
</div>

							</div>
						<div class="acf-form-submit">
				<input type="submit" name='submit'  class="acf-button button button-primary button-large" value="Add Sub Collection"><span class="acf-spinner"></span></div>
				
		</form>
		
		
		
		
		
		
		
		
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>


<script>
$('#multiselect-subcollection div input').change(function() {
    var s = $('#multiselect-subcollection div input:checked').map(function() {
        return this.value;
    }).get().join(',');
    $('#acf-field_63bb62f47660c').val((s.length > 0 ? s : ""));
});
$(document).ready(function() {
    // $('#multiselect-collection div input').change(function(evt) {
    //     var s = $('#multiselect-collection div input:checked').map(function() {
    //         return this.value;
    //     }).get().join(',');
    //     $('#acf-field_63bb759a4aa7b').val((s.length > 0 ? s : ""));
    //     $('#acf-field_63bb62f47660c').val((s.length > 0 ? s : ""));
    // });

    $('.collection__row--check input[type=radio]').each(function(i, el) {
        var s = $('#multiselect-collection div input:checked').map(function() {
            return this.value;
        }).get().join(',');

        if ($(el).is(':checked')) {
            // $(el).closest("tr").find("td").toggleClass("checkedHighlight", this.checked);
            $('#acf-field_63bb759a4aa7b').val((s.length > 0 ? s : ""));
            $('#acf-field_63bb62f47660c').val((s.length > 0 ? s : ""));
            $('.check-content').find("input[type='radio']").prop(
                'disabled',
                false);
        }
    });



});
</script>

<script type='text/javascript'>
// $(document).ready(function() {
//     $(".collection__row--check input[type='checkbox']").change(function() {
//         console.log("Enabel");
//         // $('.check-content').find("input[type='radio']").prop(
//         //     'disabled',
//         //     false);
//         if ($(this).is(":checked")) {
//             $('.check-content').find("input[type='radio']").prop(
//                 'disabled',
//                 false);
//         } else {
//             $('.check-content').find("input[type='radio']").prop('disabled', true);
//             $('.check-content').find("input[type='radio']").prop('checked', false);
//         }

//     });
// });
// $(document).ready(function() {
//     $('.collection__row--check input[type=checkbox]').each(function(i, el) {

//         if ($(el).is(':checked')) {
//             // $(el).closest("tr").find("td").toggleClass("checkedHighlight", this.checked);
//             $('.check-content').find("input[type='radio']").prop(
//                 'disabled',
//                 false);
//         } else {
//             // $('.check-content').find("input[type='radio']").prop('disabled', true);
//             // $('.check-content').find("input[type='radio']").prop('checked', false);
//         }
//     });
// });
</script>









<?php get_footer('archiving');?>