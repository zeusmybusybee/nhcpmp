<?php /** Template Name: Collection Development Data Generation List */?>

<style>
.form-inline {  
  display: flex;
  flex-flow: row wrap;
  align-items: center;
}


.form-inline input {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  padding: 10px;
  background-color: #fff;
  border: 1px solid #ddd;
  width: 80%;
}

</style>

<style>

form.example select {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 70%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
  margin-left: 2%;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}

thead{
    background:#234d8d;
    
}

table.dataTable thead > tr > th.sorting{
 
    color: #fff;
}

button.dt-button.buttons-excel.buttons-html5, .btn-collection-development-search {
    background: #0095ff;
    border-bottom: aliceblue;
    border-radius: 5px;
}
</style>


<div class="tab__content">
    <div class="tab__content--header">
        <div class="tab__content--browse">
            
            <!-- <div class="browse">
                <span>More than 1000+ Browse Acession List</span>
            </div> 
            <div class="button">
                <a href="<?php // echo site_url('/add-accession-list'); ?>">Add</a>
            </div>
            -->
        </div>
    </div>
    
    
    <form method="GET" class="form-inline" >

    <input type='text' name='call_number' placeholder="Call Number">
    <input type='hidden' name='step' value='collection-development-search' >
    <button type="submit" class='btn-collection-development-search'>Submit</button>
    </form>
    
    
    
  
    
    <!--<form method="GET" action="">
        


  
  <input type='submit' name='submit' value="Search">


    </form> -->
    
    
    
    <div class="tab__content--table">
      
            <?php
             error_reporting(0);
            if($_GET['step'] == 'collection-development-search'){
                ?>
                
            <script>
$(document).ready(function(){
 $('#autoTriggerModal').click(function(){
    
    });
  // set time out 5 sec
     setTimeout(function(){
        $('#autoTriggerModal').trigger('click');
    }, 100);
});
</script>

                
        <?php        
          $call_number =  $_GET['call_number'];
/*------------------------------------------ DISPLAY TABLE ---------------------------------------------------------------------------------*/
            
$arg_cd_list = array(
    'post_type' => array('books-manuscript','academic-courseworks', 'audio-recordings', 'audio-visual', 'serial', 'video-recording'),
    'post_status' => 'publish',
    'posts_per_page' => -1,
     'meta_query' => array(
    'relation' => 'AND',
    array(
		'key' => array('ac_call_number','ar_call_number', 'call_number', 'bm_call_number', 's_call_number', 'vr_call_number'),
		'value' => $call_number,
		'compare' => 'LIKE'
		),
    )
    
    
  
);
$arg_query_cd_list = new WP_Query($arg_cd_list);
?>
           
          <?php if ($arg_query_cd_list->have_posts()) {$i = 1; ?>
          
             <table id="table_collection_developmen" class="display">
                <thead>
                <tr>
                    <th>Call Number</th>
                    <th>Title</th>
                    <th>Place of Publication</th>
                    <th>Publisher</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
          
          
           <?php while ($arg_query_cd_list->have_posts()) { $arg_query_cd_list->the_post();?>


                <tr>
                
                <td>
                    <?php
                    if(get_post_type(get_the_ID()) == 'books-manuscript'){
                        echo get_field('bm_call_number');
                    }elseif(get_post_type(get_the_ID()) == 'academic-courseworks'){
                         echo get_field('call_number');
                    }elseif(get_post_type(get_the_ID()) == 'audio-recordings'){
                         echo get_field('ar_call_number');
                    }elseif(get_post_type(get_the_ID()) == 'audio-visual'){
                         echo get_field('call_number');
                    }elseif(get_post_type(get_the_ID()) == 'serial'){
                         echo get_field('s_call_number');
                    }elseif(get_post_type(get_the_ID()) == 'video-recording'){
                         echo get_field('vr_call_number');
                    }
                     ?>
                </td>
                <td><?php echo get_the_title(); ?></td>
                <td>
                   <?php
                    if(get_post_type(get_the_ID()) == 'books-manuscript'){
                        echo get_field('bm_place_of_publication');
                    }elseif(get_post_type(get_the_ID()) == 'academic-courseworks'){
                         echo get_field('ac_place_of_publication');
                    }elseif(get_post_type(get_the_ID()) == 'audio-recordings'){
                         echo get_field('ar_place_of_publication');
                    }elseif(get_post_type(get_the_ID()) == 'audio-visual'){
                         echo get_field('place_of_publication');
                    }elseif(get_post_type(get_the_ID()) == 'serial'){
                         echo get_field('s_place_of_publication');
                    }elseif(get_post_type(get_the_ID()) == 'video-recording'){
                         echo get_field('vr_place_of_publication');
                    }
                     ?>
                    </td>
                
                
                <td>
                     <?php
                    if(get_post_type(get_the_ID()) == 'books-manuscript'){
                        echo get_field('bm_publisher_name');
                    }elseif(get_post_type(get_the_ID()) == 'academic-courseworks'){
                         echo get_field('ac_publisher_name');
                    }elseif(get_post_type(get_the_ID()) == 'audio-recordings'){
                         echo get_field('ar_publisher_name');
                    }elseif(get_post_type(get_the_ID()) == 'audio-visual'){
                         echo get_field('publisher_name');
                    }elseif(get_post_type(get_the_ID()) == 'serial'){
                         echo get_field('s_publisher_name');
                    }elseif(get_post_type(get_the_ID()) == 'video-recording'){
                         echo get_field('vr_publisher_name');
                    }
                     ?>
                     
                   </td>
                    
                    
                <td>
                    <?php
                    if(get_post_type(get_the_ID()) == 'books-manuscript'){
                        echo get_field('bm_description');
                    }elseif(get_post_type(get_the_ID()) == 'academic-courseworks'){
                         echo get_field('ac_description');
                    }elseif(get_post_type(get_the_ID()) == 'audio-recordings'){
                         echo get_field('ar_description');
                    }elseif(get_post_type(get_the_ID()) == 'audio-visual'){
                         echo get_field('description');
                    }elseif(get_post_type(get_the_ID()) == 'serial'){
                         echo get_field('s_description');
                    }elseif(get_post_type(get_the_ID()) == 'video-recording'){
                         echo get_field('vr_description');
                    }
                     ?>
                     
                 </td>
   
                 
                </tr>

           
             
           
             


<?php $i++; } ?>
              
               </tbody>
             </table>
         <?php }

/*---------------------------------------------------------------------------------------------------------------------------*/


}



?>
     
    </div>
</div>


<script>
$(document).ready(function() {
    $('#table_collection_developmen').DataTable( {
        dom: 'Bfrtip',
  buttons: [{ extend: "excel", text: "Export to Excel", title: null, messageTop: '<?php echo get_field('policy_header', 'option'); ?>' }],
  
    } );
} );

</script>
