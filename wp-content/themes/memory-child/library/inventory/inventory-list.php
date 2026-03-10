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
    
    
    
    <form method="GET" class="example" action="">
    <select class="custom-select" name='inventory_list_data_type' >
    <option value="0">Select Inventory List:</option>
    <option value="academic-courseworks">Academic Courseworks</option>
    <option value="analytic-literature">Analytic and Book Literature</option>
    <option value="archive">Archive</option>
    <option value="audio-recordings">Audio Recordings</option>
    <option value="audio-visual">Audio Visual</option>
    <option value="books-manuscript">Books and Manu Scripts</option>
    <option value="cases">Cases</option>
    <option value="e-resources">E-Resources</option>
    <option value="museums">Museums</option>
    <option value="patrons">Patrons</option>
    <option value="periodical-article">Periodical Article</option>
    <option value="serial">Serial</option>
    <option value="vertical-file">Vertical File</option>
    <option value="video-recording">Video Recordings</option>
    <option value="website">Website</option>

  </select>
  
  <button type="submit">Submit</button>
</form>
    
    
    
    <!--<form method="GET" action="">
        


  
  <input type='submit' name='submit' value="Search">


    </form> -->
    
    
    
    <div class="tab__content--table">
      
            <?php
             error_reporting(0);
            if($_GET['inventory_list_data_type']){
          $inventory_type =  $_GET['inventory_list_data_type'];
/*------------------------------------------ DISPLAY TABLE ---------------------------------------------------------------------------------*/
            
$arg_accession_list = array(
    'post_type' => "$inventory_type",
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'paged' => $paged,
);
$arg_query = new WP_Query($arg_accession_list);
?>
           
          <?php if ($arg_query->have_posts()) {$i = 1; ?>
            
            
            
 <?php if($inventory_type == 'archive' ){ ?>
           <table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Accession No.</th>
                    <th>Title</th>
                    <th>Reference Code</th>
                    <th>Date(s)</th>
                    <th>Level of description</th>
                    <th>Extent/Form</th>
                    <th>Name of creator</th>
                    <th>Admin/Biographical history</th>
                    <th>Archival History</th>
                    <th>Source or Transfer</th>
                    <th>Scope and content</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                
                <td><?php echo get_field('accession_number'); ?></td>
                <td><?php echo get_the_title(); ?></td>
                <td><?php echo get_field('arc_reference_code'); ?></td>
                <td><?php echo get_field('arc_dates'); ?></td>
                <td><?php echo get_field('arc_level_of_description'); ?></td>
                <td><?php echo get_field('arc_extentform'); ?></td>
                <td><?php echo get_field('arc_name_of_creator'); ?></td>
                <td><?php echo get_field('arc_adminbiographical_history'); ?></td>
                <td><?php echo get_field('arc_archival_history'); ?></td>
                <td><?php echo get_field('arc_source_or_transfer'); ?></td>
                <td><?php echo get_field('arc_scope_and_content'); ?></td>
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>
             
             
               
<?php }elseif($inventory_type == 'museums' ){ ?>


   <table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Accession No.</th>
                    <th>Title </th>
                    <th>Title Type</th>
                    <th>Object name</th>
                    <th>Object name type</th>
                    <th>Object name authority</th>
                    <th>Object number</th>
                    <th>Object number type</th>
                    <th>Object number date</th>
                    <th>Production Place</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                
                <td><?php echo get_field('accession_number'); ?></td>
                <td><?php echo get_the_title(); ?></td>
                <td><?php echo get_field('m_title_type'); ?></td>
                <td><?php echo get_field('m_object_name'); ?></td>
                <td><?php echo get_field('m_object_name_type'); ?></td>
                <td><?php echo get_field('m_object_name_authority'); ?></td>
                <td><?php echo get_field('m_object_number'); ?></td>
                <td><?php echo get_field('m_object_number_type'); ?></td>
                <td><?php echo get_field('object_number_date'); ?></td>
                <td><?php echo get_field('m_production_place'); ?></td>
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>


<?php }elseif($inventory_type == 'patrons' ){ ?>


  <table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>ID Number</th>
                    <th>Group</th>
                    <th>Degree/Course/Department</th>
                    <th>Year Level</th>
                    <th>Address</th>
                    <th>Contact number</th>
                    <th>Material Out</th>
                    <th>Overdue</th>
                    <th>Email</th>
                    <th>Date entered</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                
                <td><?php echo get_field('p_id_number'); ?></td>
                <td><?php echo get_field('group_name', get_field('p_group_id', get_the_ID())); ?></td>
                <td><?php echo get_field('p_degree_course_department'); ?></td>
                <td><?php echo get_field('p_year_level'); ?></td>
                <td><?php echo get_field('p_address'); ?></td>
                <td><?php echo get_field('p_contact_number'); ?></td>
                <td><?php echo get_field('p_material_out'); ?></td>
                <td><?php echo get_field('p_overdue'); ?></td>
                <td><?php echo get_field('p_email'); ?></td>
                <td><?php echo get_field('p_date_entered'); ?></td>
          
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>


<?php }elseif($inventory_type == 'books-manuscript' ){ ?>

   <table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Statement of Responsibility</th>
                    <th>Parallel Title</th>
                    <th>Variant Title</th>
                    <th>Main Creator</th>
                    <th>Other Creator</th>
                    <th>Contributors</th>
                    <th>Corporate Body</th>
                    <th>Place of Publication</th>
                    <th>Publisher</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                
                <td><?php echo get_field('bm_statement_of_responsibility'); ?></td>
                <td><?php echo get_field('bm_parallel_title'); ?></td>
                <td><?php echo get_field('bm_variant_title'); ?></td>
                <td><?php echo get_field('bm_main_creator'); ?></td>
                <td><?php echo get_field('bm_other_creator'); ?></td>
                <td><?php echo get_field('bm_contributors'); ?></td>
                <td><?php echo get_field('bm_corporate_body'); ?></td>
                <td><?php echo get_field('bm_place_of_publication'); ?></td>
                <td><?php echo get_field('bm_publisher'); ?></td>
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>


<?php }elseif($inventory_type == 'academic-courseworks' ){  ?>

  <table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Creators</th>
                    <th>Institution</th>
                    <th>Course Program</th>
                    <th>Date Year</th>
                    <th>Illustrative Details</th>
                    <th>Dimension</th>
                    <th>Supplementary Content</th>
                    <th>Call Number</th>
                    <th>Accession</th>
                    <th>Language</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                
                <td><?php echo get_field('ac_creators'); ?></td>
                <td><?php echo get_field('ac_institution'); ?></td>
                <td><?php echo get_field('ac_course_program'); ?></td>
                <td><?php echo get_field('ac_date_year'); ?></td>
                <td><?php echo get_field('ac_illustrative_details'); ?></td>
                <td><?php echo get_field('ac_dimension'); ?></td>
                <td><?php echo get_field('ac_supplementary_content'); ?></td>
                <td><?php echo get_field('call_number'); ?></td>
                <td><?php echo get_field('ac_accession'); ?></td>
                <td><?php echo get_field('ac_language'); ?></td>
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>

<?php }elseif($inventory_type == 'audio-recordings' ){ ?>

  <table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Other Title Information</th>
                    <th>Parallel Title</th>
                    <th>Variant Title</th>
                    <th>Statement of Responsibility</th>
                    <th>Edition Statement</th>
                    <th>Place of Publication</th>
                    <th>Publisher Name</th>
                    <th>Date of Publication</th>
                    <th>Place of Distribution</th>
                    <th>Distributors Name</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                
                <td><?php echo get_field('ar_other_title_information'); ?></td>
                <td><?php echo get_field('ar_parallel_title'); ?></td>
                <td><?php echo get_field('ar_variant_title'); ?></td>
                <td><?php echo get_field('ar_statement_of_responsibility'); ?></td>
                <td><?php echo get_field('ar_edition_statement'); ?></td>
                <td><?php echo get_field('ar_place_of_publication'); ?></td>
                <td><?php echo get_field('ar_publisher_name'); ?></td>
                <td><?php echo get_field('ar_date_of_publication'); ?></td>
                <td><?php echo get_field('ar_place_of_distribution'); ?></td>
                <td><?php echo get_field('ar_distributors_name'); ?></td>
                <td><?php echo get_field('ar_copyright_date'); ?></td>
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>

<?php }elseif($inventory_type == 'video-recording' ){ ?>

<table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Other Title Information</th>
                    <th>Preferred Title</th>
                    <th>Parallel Title</th>
                    <th>Variant Title</th>
                    <th>Statement of Responsibility</th>
                    <th>Edition Statement</th>
                    <th>Place of Publication</th>
                    <th>Publishers Name</th>
                    <th>Date of Publication</th>
                    <th>Place of Distribution</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                
                <td><?php echo get_field('vr_other_title_information'); ?></td>
                <td><?php echo get_field('vr_preferred_title'); ?></td>
                <td><?php echo get_field('vr_parallel_title'); ?></td>
                <td><?php echo get_field('vr_variant_title'); ?></td>
                <td><?php echo get_field('vr_statement_of_responsibility'); ?></td>
                <td><?php echo get_field('vr_edition_statement'); ?></td>
                <td><?php echo get_field('vr_place_of_publication'); ?></td>
                <td><?php echo get_field('vr_publishers_name'); ?></td>
                <td><?php echo get_field('vr_date_of_publication'); ?></td>
                <td><?php echo get_field('vr_place_of_distribution'); ?></td>
                
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>

<?php }elseif($inventory_type == 'audio-visual' ){  ?>

<table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Call Number</th>
                    <th>Accession Number</th>
                    <th>Level</th>
                    <th>Statement of Responsibility</th>
                    <th>Parallel Title</th>
                    <th>Variant Title</th>
                    <th>Main Creator</th>
                    <th>Other Creator</th>
                    <th>Contributors</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                <td><?php echo get_the_title(); ?></td>
                <td><?php echo get_field('call_number'); ?></td>
                <td><?php echo get_field('accession_number'); ?></td>
                <td><?php echo get_field('level'); ?></td>
                <td><?php echo get_field('statement_of_responsibility'); ?></td>
                <td><?php echo get_field('parallel_title'); ?></td>
                <td><?php echo get_field('variant_title'); ?></td>
                <td><?php echo get_field('main_creator'); ?></td>
                <td><?php echo get_field('other_creator'); ?></td>
                <td><?php echo get_field('contributors'); ?></td>
          
                
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>
             

<?php }elseif($inventory_type == 'e-resources' ){  ?>

<table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Creator(s)</th>
                    <th>Publisher</th>
                    <th>Date</th>
                    <th>Identifier</th>
                    <th>Description</th>
                    <th>Source</th>
                    <th>Format</th>
                    <th>Language </th>
                    <th>Contributor</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                <td><?php echo get_the_title(); ?></td>
                <td><?php echo get_field('er_creators'); ?></td>
                <td><?php echo get_field('er_publisher'); ?></td>
                <td><?php echo get_field('er_date'); ?></td>
                <td><?php echo get_field('er_identifier'); ?></td>
                <td><?php echo get_field('er_description'); ?></td>
                <td><?php echo get_field('er_source'); ?></td>
                <td><?php echo get_field('er_format'); ?></td>
                <td><?php echo get_field('er_language'); ?></td>
                <td><?php echo get_field('er_contributor'); ?></td>
          
                
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>

<?php }elseif($inventory_type == 'serial' ){  ?>

<table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Call Number</th>
                    <th>Place of Publication</th>
                    <th>Publisher</th>
                    <th>Description</th>
                    <th>Frequency </th>
                    <th>Latest Received</th>
                    <th>Holding</th>
                    <th>Notes</th>
                    <th>Subject</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                <td><?php echo get_the_title(); ?></td>
                <td><?php echo get_field('s_call_number'); ?></td>
                <td><?php echo get_field('s_place_of_publication'); ?></td>
                <td><?php echo get_field('s_publisher'); ?></td>
                <td><?php echo get_field('s_description'); ?></td>
                <td><?php echo get_field('s_frequency'); ?></td>
                <td><?php echo get_field('s_latest_received'); ?></td>
                <td><?php echo get_field('s_holding'); ?></td>
                <td><?php echo get_field('s_notes'); ?></td>
                <td><?php echo get_field('s_subject'); ?></td>
                
          
                
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>

<?php }elseif($inventory_type == 'website' ){ ?>

<table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Variant Title</th>
                    <th>Parallel Title</th>
                    <th>Publisher's name</th>
                    <th>Date of publication</th>
                    <th>Mode of issuance </th>
                    <th>Note on title </th>
                    <th>Note on issue</th>
                    <th>Content Type</th>
                    <th>Media Type</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                <td><?php echo get_the_title(); ?></td>
                <td><?php echo get_field('ws_variant_title'); ?></td>
                <td><?php echo get_field('ws_parallel_title'); ?></td>
                <td><?php echo get_field('ws_publishers_name'); ?></td>
                <td><?php echo get_field('ws_date_of_publication'); ?></td>
                <td><?php echo get_field('ws_mode_of_issuance'); ?></td>
                <td><?php echo get_field('ws_note_on_title'); ?></td>
                <td><?php echo get_field('ws_note_on_issue'); ?></td>
                <td><?php echo get_field('ws_content_type'); ?></td>
                <td><?php echo get_field('ws_media_type'); ?></td>
                
          
                
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>

<?php }elseif($inventory_type == 'analytic-literature'){ ?>

<table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Title of Book</th>
                    <th>Contributor(s)</th>
                    <th>Place of Publication</th>
                    <th>Publisher</th>
                    <th>Year of Publication</th>
                    <th>Pages</th>
                    <th>Language </th>
                    <th>Location</th>
                    <th>Electronic Access </th>
                    <th>Keywords/Subjects</th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                <td><?php echo get_field('abl_title_of_book'); ?></td>
                <td><?php echo get_field('abl_contributors'); ?></td>
                <td><?php echo get_field('abl_place_of_publication'); ?></td>
                <td><?php echo get_field('abl_publisher'); ?></td>
                <td><?php echo get_field('abl_year_of_publication'); ?></td>
                <td><?php echo get_field('abl_pages'); ?></td>
                <td><?php echo get_field('abl_language'); ?></td>
                <td><?php echo get_field('abl_location'); ?></td>
                <td><?php echo get_field('abl_electronic_access'); ?></td>
                <td><?php echo get_field('abl_keyword_subjects'); ?></td>
                
          
                
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>


<?php }elseif($inventory_type == 'cases'){  ?>

<table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Petitioner </th>
                    <th>Petitioner counsel</th>
                    <th>Respondent</th>
                    <th>Respondent Counsel</th>
                    <th>Case</th>
                    <th>Judge</th>
                    <th>Court  </th>
                    <th>Decision </th>
                    <th>G.R Number</th>
                    <th>Source </th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                <td><?php echo get_field('c_petitioner'); ?></td>
                <td><?php echo get_field('c_petitioner_counsel'); ?></td>
                <td><?php echo get_field('c_respondent'); ?></td>
                <td><?php echo get_field('c_respondent_counsel'); ?></td>
                <td><?php echo get_field('c_case'); ?></td>
                <td><?php echo get_field('c_judge'); ?></td>
                <td><?php echo get_field('c_court'); ?></td>
                <td><?php echo get_field('c_decision'); ?></td>
                <td><?php echo get_field('c_gr_number'); ?></td>
                <td><?php echo get_field('c_source'); ?></td>
                
          
                
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>

<?php }elseif($inventory_type == 'periodical-article'){  ?>

<table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Creator(s) </th>
                    <th>Periodical Title</th>
                    <th>Volume </th>
                    <th>Issue/Number</th>
                    <th>Date </th>
                    <th>Pages </th>
                    <th>Type   </th>
                    <th>Language  </th>
                    <th>Location </th>
                    <th>Electronic Access </th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                <td><?php echo get_field('pa_creators'); ?></td>
                <td><?php echo get_field('pa_periodical_title'); ?></td>
                <td><?php echo get_field('pa_volume'); ?></td>
                <td><?php echo get_field('pa_issue_number'); ?></td>
                <td><?php echo get_field('pa_date'); ?></td>
                <td><?php echo get_field('pa_pages'); ?></td>
                <td><?php echo get_field('pa_type'); ?></td>
                <td><?php echo get_field('pa_language'); ?></td>
                <td><?php echo get_field('pa_location'); ?></td>
                <td><?php echo get_field('pa_electronic_access'); ?></td>
                
          
                
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>

<?php }elseif($inventory_type == 'vertical-file'){  ?>

<table id="table_accession2" class="display">
                <thead>
                <tr>
                    <th>Creator(s) </th>
                    <th>Source </th>
                    <th>Date  </th>
                    <th>Reference Code</th>
                    <th>Description  </th>
                    <th>Type of Documents </th>
                    <th>Location    </th>
                    <th>Copy   </th>
                    <th>Type of Material </th>
                    <th>Electronic Access </th>
                </tr>
            </thead>
            <tbody>
 <?php while ($arg_query->have_posts()) { $arg_query->the_post();?>
                <tr>
                <td><?php echo get_field('vf_creators'); ?></td>
                <td><?php echo get_field('vf_source'); ?></td>
                <td><?php echo get_field('vf_date'); ?></td>
                <td><?php echo get_field('vf_reference_code'); ?></td>
                <td><?php echo get_field('vf_description'); ?></td>
                <td><?php echo get_field('vf_type_of_documents'); ?></td>
                <td><?php echo get_field('vf_location'); ?></td>
                <td><?php echo get_field('vf_copy'); ?></td>
                <td><?php echo get_field('vf_type_of_material'); ?></td>
                <td><?php echo get_field('vf_electronic_access'); ?></td>
                
          
                
                 
                </tr>
 <?php $i++; } ?>
            </tbody>
             </table>


<?php } ?>



<?php }

/*---------------------------------------------------------------------------------------------------------------------------*/


}



?>
     
    </div>
</div>



<script>
$(document).ready(function() {
    var printCounter = 0;
 
    // Append a caption to the table before the DataTables initialisation
  /*  $('#table_accession2').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>'); */
 
    $('#table_accession2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: null,
                text: "Export to Excel",
                messageTop: '<?php echo get_field('policy_header', 'option'); ?>'
            },
           
           
           
          
        ]
    } );
} );
</script>