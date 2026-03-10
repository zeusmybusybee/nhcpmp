<div class="tab__content">
    <div class="tab__content--header">
       <div class="catalog__add--title">
<h3>
Resources Status
</h3>
</div>
    </div>
    <div class="tab__content--table">



     <div class="tab">
                        <div class="tab__btn">
               
                            <button class="tablinks active" onclick="onholdresources()">
                                On-hold Resources
                            </button>
                            <button class="tablinks"  onclick="toptenmostborrowed()">
                                Top Ten Most Borrowed
                            </button>
                            <button class="tablinks" onclick="toptenpatron()">
                                Top Ten Patron Attendees
                            </button>
                        


                        </div>
                   
                        <div id="on-hold-resources"  class="tabcontent" style="display:block">
                            <?php include_once 'resources/on-hold-resources.php';?>
                        </div>
                        <div id="top-ten-most-borrowed" class="tabcontent" style="display:none">
                            <?php include_once 'resources/top-ten-most-borrowed.php';?>
                        </div>
                        <div id="top-ten-patron" class="tabcontent" style="display:none">
                            <?php include_once 'resources/top-ten-patron.php';?>
                        </div>
                        
                        
                     
<div id='activeTab'></div>

<div id="onHoldResourcesTab" style="display: none;">
  <div class="main-body__main">
                        <div class="main-body__main--title">
                            <h3>On-hold Resources</h3>
                 <div class="main-body__area">
         
   <div class="tab__content--table">
       
  <?php     
     $arg_booksmanuscript = array(
    'post_type' => 'books-manuscript',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'paged' => $paged,
    'meta_query' => array(
    'relation' => 'AND',
		array(
		'key' => 'status',
		'value' => array('Reference', 'Restricted'),
		'compare' => 'IN'
		),
    )
);
$arg_manuscript_query = new WP_Query($arg_booksmanuscript);
?>
 <?php if ($arg_manuscript_query->have_posts()) { $i = 1;?>
  <div class="grid-100"> 
    <table id="table_booksandmanuscripts2" class="display">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Publisher</th>
                    <th>Date of Publication</th>
                    <th>Identifier/ISBN</th>
                    <th>Call Number</th>
                    <th>Accession Number</th>
            
                </tr>
            </thead>
            
  <?php while ($arg_manuscript_query->have_posts()) {
    $arg_manuscript_query->the_post();?>
    <tr>
        <td><?php echo get_the_title(); ?></td>
        <td><?php echo get_field('bm_publisher'); ?></td>
        <td><?php echo get_field('bm_date_of_publication'); ?></td>
        <td><?php echo get_field('bm_identifier_isbn'); ?></td>
        <td><?php echo get_field('bm_call_number'); ?></td>
        <td><?php echo get_field('accession_number'); ?></td>
   
    </tr>
    <?php } ?>
    </tbody></table>
    </div>
    <?php } ?>  
       
</div>
</div>
</div>
</div>
       
       
</div>

<div id="topTenMostBorrowedTab" style="display: none;">

     <div class="main-body__main">
                        <div class="main-body__main--title">
                            <h3>Top Ten Most Borrowed Books</h3>
                 <div class="main-body__area">
         
   <div class="tab__content--table">
        
         <?php 
     
     global $wpdb;


    $result = $wpdb->get_results( "SELECT ID, count(ID) as total_count FROM wp_posts INNER JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.ID WHERE post_type='checkout_books' AND post_status='publish' GROUP BY post_title ORDER BY total_count DESC LIMIT 10"  );
   // $result = $wpdb->get_results( " SELECT * FROM wp_posts WHERE post_type='checkout_books' group by post_title"  );
   
    if($result){ ?>
    
       <table id="table_archives2" class="display">
             <thead>
                <tr>
                  
                    <th>Title</th>
                    <th>Call Number</th>
                    <th>Accession Number</th>
                    <th>Publisher</th>
                    <th>Date of Publication</th>
                    <th>Identifier/ISBN</th>
         
                </tr>
            </thead>
        
  <?php      
    foreach ($result as $page) {
     $post_id = $page->ID; $book_id = get_field('book_id', $post_id) ;
      // echo $book_id;
      // echo get_field('accession_number', $book_id); echo "<br>"; ?>
      
      <tr>
          <td><?php echo get_the_title($book_id); ?></td>
          <td><?php echo get_field('call_number', $book_id); ?></td>
          <td><?php echo get_field('accession_number', $book_id); ?></td>
          <td><?php echo get_field('bm_publisher', $book_id); ?></td>
          <td><?php echo get_field('bm_date_of_publication', $book_id); ?></td>
          <td><?php echo get_field('bm_identifier_isbn', $book_id); ?></td>
      </tr>
   <?php }
    ?>
    
    </table>
  <?php  }
    
    
     ?>
     
     

</tbody>
             </table>
       
    </div>
</div>
</div>
</div>


</div>

<div id="topTenPatron" style="display: none;">


<div class="main-body__main">
                        <div class="main-body__main--title">
                            <h3>Top Ten Patron Attendees</h3>
                 <div class="main-body__area">
         
   <div class="tab__content--table">

<?php  $top_ten_patron = $wpdb->get_results( "SELECT ID, count(ID) as total_count FROM wp_posts INNER JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.ID WHERE post_type='checkout_books' AND post_status='publish' GROUP BY post_author ORDER BY total_count DESC LIMIT 10"  );
   
   
    if($top_ten_patron){ ?>
    
       <table id="table_case2" class="display">
             <thead>
                <tr>
                  
                    <th>Name</th>
                    <th>ID Number</th>
                    <th>Group</th>
                    <th>Degree/Course/Department</th>
                    <th>Year Level</th>
                    <th>Address</th>
                    <th>Contact Number</th>
         
                </tr>
            </thead>
        
  <?php      
    foreach ($top_ten_patron as $patron) {
     $post_id2 = $patron->ID; $patron_id = get_field('id_number', $post_id2) ;
      ?>
      
      <tr>
          <td><?php echo get_field('p_name', $patron_id); ?></td>
          <td><?php echo get_field('id_number', $patron_id); ?></td>
          <td><?php echo get_field('p_group', $patron_id); ?></td>
          <td><?php echo get_field('p_degree_course_department', $patron_id); ?></td>
          <td><?php echo get_field('p_year_level', $patron_id); ?></td>
          <td><?php echo get_field('p_address', $patron_id); ?></td>
          <td><?php echo get_field('p_contact_number', $patron_id); ?></td>
      </tr>
   <?php }
    ?>
    
    </table>
  <?php  }
    
    
     ?>
         </div>
</div>
</div>
</div>

</div>



                         
                    </div>

      
    </div>
</div>






<script>
function onholdresources() {
  document.getElementById("activeTab").innerHTML = document.getElementById("onHoldResourcesTab").innerHTML;
  

$(document).ready(function() {
    $('#table_booksandmanuscripts2').DataTable( {
        dom: 'Bfrtip',
  buttons: [{ extend: "excel", text: "Export to Excel", title: null, messageTop: '<?php echo get_field('policy_header', 'option'); ?>' }],
  
    } );
} );


}
function toptenmostborrowed() {
  document.getElementById("activeTab").innerHTML = document.getElementById("topTenMostBorrowedTab").innerHTML;
  
  $(document).ready(function() {
    $('#table_archives2').DataTable( {
        dom: 'Bfrtip',
  buttons: [{ extend: "excel", text: "Export to Excel", title: null, messageTop: '<?php echo get_field('policy_header', 'option'); ?>' }],
  
    } );
} );

}
function toptenpatron() {
  document.getElementById("activeTab").innerHTML = document.getElementById("topTenPatron").innerHTML;
  
  $(document).ready(function() {
    $('#table_case2').DataTable( {
        dom: 'Bfrtip',
  buttons: [{ extend: "excel", text: "Export to Excel", title: null, messageTop: '<?php echo get_field('policy_header', 'option'); ?>' }],
  
    } );
} );

}
</script>


