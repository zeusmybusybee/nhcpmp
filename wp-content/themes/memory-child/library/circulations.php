<?php
/*** Template Name: Circulation */
acf_form_head();
get_header();
?>

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    
    

<style>

.grid-100, .grid-80, .grid-75, .grid-50, .grid-25{ display: inline-block; }

 .grid-100{
        width: 98%;
    }
    
    .grid-80{
        width: 79%;
    }
    .grid-75{
        width: 74%;
    }
    .grid-50{
        width: 49%;
        
    }
    .grid-25{
        width: 24%;
  
    }
    
    
    
    .circulation_text{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.flex{
    display:flex;
}

thead{
    background:#234d8d;
    
}





.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

.btn-search{
    background: #2361ce !important;
    border-radius: 10px !important;
    border-bottom: #2361ce !important;
}

.btn-co, .btn-ci, .btn-renew{
   
    border-radius: 5px !important;
    border-bottom: #2361ce !important;
    padding:5px;
    color:#fff !important;
    cursor:pointer;
}
.btn-co{
     background: #2361ce !important;
}
.btn-ci{
    background: #2fbd8f !important;
}

.btn-renew{
    background: #f19547 !important;
}




table.dataTable thead > tr > th.sorting{
 
    color: #fff;
}


.nav__search .search-field{
    margin-left: 350px;
}

.inline_input_text {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  padding: 10px;
  background-color: #fff;
  border: 1px solid #ddd;
  width: 100%;
}

.btn-search{
    background: #0095ff;
    border-bottom: aliceblue;
    border-radius: 5px;
}

.btn-close{
     background: #dd5f5f;
    border-bottom: aliceblue;
    border-radius: 5px;
}


a.disabled {
  pointer-events: none;
  cursor: default;
  opacity: 0.7;
}

</style>





<section>
    <div class="main-content">
        <?php include get_theme_file_path('partials/sidebar.php');?>
        <?php include get_theme_file_path('partials/navbar.php');?>
        <div class="main-body">
            <div class="main-body__content">
                <div class="main-body__container">
                    <div class="main-body__content--header">
                        <h3>Circulation </h3>
                        <div class="watermark library">
                            <img src="<?php echo THEME_DIR; ?>/assets/img/circulation.png" alt="Circulation Icon">
                        </div>
                    </div>

                    <div class="main-body__main">
                        <div class="main-body__main--title">
                            <h3>Resource Circulation Transaction</h3>
                 <div class="main-body__area">
                     
                     
               
                     
                     
                     
                     
                     
                     <?php 
  error_reporting(0);
if(isset($_GET['searched_keyword']) || isset($_GET['searched_keyword2'])){
    
  
    
   $searched_text = $_GET['searched_keyword'];
   $searched_text2 = $_GET['searched_keyword2'];
    //echo $searched_text;

   
global $wpdb;

    $result = $wpdb->get_col( "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id WHERE wp_posts.post_type =  'patrons' && ((wp_postmeta.meta_key = 'p_name' && wp_postmeta.meta_value = '$searched_text') || (wp_postmeta.meta_key = 'p_id_number' && wp_postmeta.meta_value = '$searched_text' ) )"  );
    $searched_ID = $result[0];
    
    if($searched_ID < 1){ ?>
        
   <div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>RECORD NOT FOUND!</strong> Please Check Correct Keyword
</div>
   
   <?php }
}

if(isset($_GET['check_out']) ){
    
    $book_id = $_GET['book_id'];
    $id_number = $_GET['id_number'];
    

  $my_post = array(
  'post_type'     => 'checkout_books',
  'post_title'    => $book_id,
  'post_author'   => $id_number,
  'post_status'   => 'publish',
  'meta_input'   => array(
        'book_id' => $book_id,
        'id_number' => $id_number,
         'accession_number' => get_field('accession_number', $book_id),
         'book_title' => get_field('bm_variant_title', $book_id),
         'date_out' => date("Y-m-d"),
         'date_due' => $_GET['check_out_due_date'],
         'status' => 1,
        ),
);



wp_insert_post($my_post, true, false);

   $latest_url = $_SERVER['HTTP_REFERER'];
     echo "<meta http-equiv='refresh'content='0;url=$latest_url'>";
} ?>





<?php
if(isset($_GET['check_in']) ){
    
    $check_out_book_id = $_GET['check_out_book_id'];
    $check_in_date = date('Y-m-d');
    $fine_amount_check_in = $_GET['fine_amount'];
    
    update_post_meta($check_out_book_id, 'date_in', $check_in_date);
    update_post_meta($check_out_book_id, 'fine_amount', $fine_amount_check_in);
    update_post_meta($check_out_book_id, 'status', 2);
    
    
   $latest_url = $_SERVER['HTTP_REFERER'];
     echo "<meta http-equiv='refresh'content='0;url=$latest_url'>";
}
    
    
    
    if(isset($_GET['renew']) ){
    
    $check_out_book_id = $_GET['check_out_book_id'];
    $renew_date = $_GET['renew_date'];
    
    update_post_meta($check_out_book_id, 'date_due', $renew_date);

   $latest_url = $_SERVER['HTTP_REFERER'];
     echo "<meta http-equiv='refresh'content='0;url=$latest_url'>";
}
    
?>
       
         

<hr>

<div class="grid-50" ><h3>Patron Information </h3></div>
<div class="grid-25" ></div><div class="grid-25" > 
<form method="GET" action="">
<input type="text" class='circulation_text' name="searched_keyword" value="<?php echo $searched_text; ?>" placeholder="Name, ID Number"><input class="btn-search" type='submit' name='submit' value="Search" >


</div>

<div class='flex'>
    
<div class="grid-25" style='border: 2px solid #000; margin-right:15px; '> 
    <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg" style='width:100%;  background-size: 100% 100%; '>
</div>


<div class="grid-75"> 
<label for="fname">Name :</label><input type="text" class='circulation_text' disabled value="<?php the_field('p_name',$searched_ID); ?>">
<label for="fname">Address :</label><input type="text" class='circulation_text' disabled value="<?php the_field('p_address',$searched_ID); ?>">
<label for="fname">ID Number: </label><input type="text" class='circulation_text'  disabled value="<?php the_field('p_id_number',$searched_ID); ?>">
<label for="fname">Moderator:</label><input type="text" class='circulation_text' disabled >
<label for="fname">Description:</label><input type="text" class='circulation_text' disabled >
<label for="fname">Email:</label><input type="text" class='circulation_text' disabled  value="<?php the_field('p_email',$searched_ID); ?>">
<label for="fname">Onloan:</label><input type="text" class='circulation_text'  disabled >
</div>
</div>



<?php if($searched_ID > 0){ ?>
<div class="grid-25" ></div><div class="grid-25" > 
<input type="text" class='circulation_text' name="searched_keyword2" placeholder="Acession Number"><input class="btn-search" type='submit' name='submit' value="Search">
<?php } ?>

</form>
</div>





  <?php
  
  if($searched_text2){
  
$arg_booksmanuscript = array(
    'post_type' => array('audio-visual', 'books-manuscript', 'academic-courseworks', 'audio-recordings', 'e-resources', 'serial', 'video-recording', 'website', 'analytic-literature',
                        'periodical-article', 'vertical-file', 'cases', 'archive', 'museums', 'patrons'),
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'paged' => $paged,
    'meta_query' => array(
    'relation' => 'AND',
    array(
		'key' => 'accession_number',
		'value' => $searched_text2,
		'compare' => 'LIKE'
		)
    )
);
$arg_manuscript_query = new WP_Query($arg_booksmanuscript);
?>
 <?php if ($arg_manuscript_query->have_posts()) { $i = 1;?>
  <div class="grid-100"> 
    <table id="table_booksandmanuscripts" class="display">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Publisher</th>
                    <th>Date of Publication</th>
                    <th>Identifier/ISBN</th>
                    <th>Call Number</th>
                    <th>Accession Number</th>
                    <th> Action</th>
                </tr>
            </thead>
            
  <?php while ($arg_manuscript_query->have_posts()) {
    $arg_manuscript_query->the_post();?>
    <tr>
        <td><?php echo get_field('bm_variant_title'); ?></td>
        <td><?php echo get_field('bm_publisher'); ?></td>
        <td><?php echo get_field('bm_date_of_publication'); ?></td>
        <td><?php echo get_field('bm_identifier_isbn'); ?></td>
        <td><?php echo get_field('call_number'); ?></td>
        <td><?php echo get_field('accession_number'); ?></td>
         <td>
             
                                    <!-- Button trigger modal -->
<a  class="btn-co" data-toggle="modal" data-target="#checkOutModal-<?php echo get_the_ID(); ?>">
  Check out
</a>

<!-- Modal -->
<div class="modal fade" id="checkOutModal-<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>
      
        <form method="GET" action="">
      <div class="modal-body">
     
        
          
          <b> Due Date:</b> <input type="date" id="check_out_due_date" class='inline_input_text' name="check_out_due_date">
            <input type="hidden" name="id_number" value="<?php echo $searched_ID; ?>">
            <input type="hidden" name="book_id" value="<?php echo get_the_ID(); ?>">
     

      </div>
      <div class="modal-footer">
        <input type='submit' class="btn-search" value='Submit' name='check_out'> 
       <!-- <button type="button" class="btn-close" data-dismiss="modal">Close</button> -->
     
      </div>
       </form>
      
    </div>
  </div>
</div>
        
        
         </td>
    </tr>
    <?php } ?>
    </tbody></table>
    </div>
    <?php }
    
  }
    
    ?>

    





 </div>
 </div>
 </div>
                    
                    
                    
           
           
           
           
<!---------------------------------------------- LIST OF BORROWED MATERIALS TABLE ---------------------------------------------------------------------------------------->           
           
                    
<?php if($searched_ID > 0){ ?>   
           <div class="main-body__main">
                        <div class="main-body__main--title">
                            <h3>List of Borrowed Materials</h3>
                 <div class="main-body__area">
         
   <div class="tab__content--table">
        
            <?php

$arg_analytics = array(
    'post_type' => 'checkout_books',
    'post_status' => 'publish',
    'posts_per_page' => -1,
     'meta_query' => array(
    'relation' => 'AND',
    array(
		'key' => 'id_number',
		'value' => $searched_ID,
		'compare' => '='
		),
    )
  
);
$arg_query = new WP_Query($arg_analytics);
?>
<table id="table_analytics" class="display">
<thead >
                <tr>
                    <th>ID Number </th>
                    <th>Accession</th>
                    <th>Title</th>
                    <th>Date out</th>
                    <th>Date due</th>
                    <th>Date in/report</th>
                    <th>Fine</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
            <?php if ($arg_query->have_posts()) {$i = 1;?>


                <?php while ($arg_query->have_posts()) {
    $arg_query->the_post();?>
                <tr>
                   <td><?php echo get_field('id_number'); ?></td>
                   <td><?php echo get_field('accession_number'); ?></td>
                   <td><?php echo get_field('book_title'); ?></td>
                   <td><?php echo get_field('date_out'); ?></td>
                   <td><?php echo get_field('date_due'); ?></td>
                   <td><?php echo get_field('date_in'); ?></td>
                   <td><?php
                   
                   if(get_field('fine_amount')){
                        echo "₱"; echo get_field('fine_amount'); echo ".00";
                   }else{

if(get_field('date_due') AND get_field('date_due') < date('Y-m-d')){

$date_due = get_field('date_due');
$date_now = date('Y-m-d');

$start = new DateTime("$date_due");
$end = new DateTime("$date_now");
// otherwise the  end date is excluded (bug?)
$end->modify('+1 day');

$interval = $end->diff($start);

// total days
$days = $interval->days;

// create an iterateable period of date (P1D equates to 1 day)
$period = new DatePeriod($start, new DateInterval('P1D'), $end);

// best stored as array, so you can add more than one
//$holidays = array('2023-02-09');

foreach($period as $dt) {
    $curr = $dt->format('D');

    // substract if Saturday or Sunday
    if (($curr == 'Sat' && get_field('ps_sunday', 'options') == 'True' ) || ($curr == 'Sun' && get_field('ps_saturday', 'options') == 'True' ) || ($curr == 'Mon' && get_field('ps_monday', 'options') == 'True' ) || ($curr == 'Tue' && get_field('ps_tuesday', 'options') == 'True' ) || ($curr == 'Wed' && get_field('ps_wednesday', 'options') == 'True' ) || ($curr == 'Thu' && get_field('ps_thursday', 'options') == 'True' ) || ($curr == 'Fri' && get_field('ps_friday', 'options') == 'True' )) {
       $days--;
    } 

    // (optional) for the updated question
  //  elseif (in_array($dt->format('Y-m-d'), $holidays)) {
    //    $days--;
   // }
}

$total_days = $days - 1;
echo "₱"; echo $total_days * get_field('g_fine', get_field('p_group_id', get_field('id_number'))) ; echo ".00";


}
}

?></td>
                 <td><?php 
                 if(get_field('status') == '1'){
                     echo "<span style='color:orange;'>Out</span>";
                 }elseif(get_field('status') == '2'){
                     echo "<span style='color:green;'>In</span>";
                 }
                 ?></td>
                 <td>
                     
                     
 <!-- Button trigger modal -->
<a  class="btn-ci  <?php if(get_field('status') == '2'){ echo "disabled";} ?> " data-toggle="modal" data-target="#checkInModal-<?php echo get_the_ID(); ?>">
  Check In 
</a>&nbsp;&nbsp;<a  class="btn-renew <?php if(get_field('status') == '2'){ echo "disabled";} ?>" data-toggle="modal" data-target="#RenewModal-<?php echo get_the_ID(); ?>">
  Renew
</a>

<!-- Check In Modal -->
<div class="modal fade" id="checkInModal-<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
              <form method="GET" action="">
      <div class="modal-body">

        Are you sure you want to check in?
      <!--    <input type="date" class='inline_input_text' id="check_in_date" name="check_in_date"> -->
            <input type='hidden' name='check_out_book_id' value="<?php echo get_the_ID(); ?>">
            <input type='hidden' name='fine_amount' value="<?php  echo $total_days * get_field('g_fine', get_field('p_group_id', get_field('id_number'))) ; ?>">
           
          
            
        
      </div>
      <div class="modal-footer">
           <input type='submit' value='Submit' class="btn-search" name='check_in'> 
      <!--  <button type="button" class="btn-close" data-dismiss="modal">Close</button> -->
     
      </div>
      
          </form>

    </div>
  </div>
</div>



<!-- Renew Modal -->
<div class="modal fade" id="RenewModal-<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
          
            <form method="GET" action="">
      <div class="modal-body">

          <input type="date"  name="renew_date" class='inline_input_text' value="<?php echo get_field('date_due'); ?>">
            <input type='hidden' name='check_out_book_id' value="<?php echo get_the_ID(); ?>">
         

            
      </div>
      <div class="modal-footer">
             <input type='submit' class='btn-search' value='Submit' name='renew'> 
        <!--<button type="button" class="btn-close"  data-dismiss="modal">Close</button> -->
     
      </div>
              </form>
    </div>
  </div>
</div>

                 </td>
                </tr>
                <?php
$i++;
}
    ?>
            
            <?php

}
?>
</tbody>
             </table>
       
    </div>
</div>
</div>
</div>


<?php } ?>
                    
                    
                    
                </div>
                <?php include get_theme_file_path("partials/footer.php");?>
            </div>
        </div>
    </div>
</section>





         <!------------------------------------------------------ JAVASCRIPT ---------------------------------------------------------------------->
<!--
 <script>
 
 
                function serviceRequest(){
                var refresh=100; // Refresh rate in milli seconds
                mytime=setTimeout('updateServiceRequest()',refresh)
            }
            
             function updateServiceRequest() {
           
          document.getElementById("acf-field_63db4650c56f1").value = document.getElementById("check_out_due_date").value;
          document.getElementById("acf-field_63e1f40e8af23").value = document.getElementById("check_in_date").value;
            
           
           serviceRequest();
            
            }
            
            updateServiceRequest();
            </script> -->
            







<?php get_footer();?>