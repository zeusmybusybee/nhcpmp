<div class="tab__content">

    <div class="tab__content--table">
        <table id="table_patron2" class="display">
      <?php

$arg_analytics = array(
    'post_type' => 'patrons',
    'post_status' => 'publish',
    'posts_per_page' => -1,

  
);
$arg_query = new WP_Query($arg_analytics);
?>
            <thead>
                
                <tr>
                    <th>Name</th>
                    <th>ID Number </th>
                    <th>Group</th>
                    <th>Degree/Course/Department</th>
                    <th>Year Level</th>
                    <th>Address</th>
                    <th>Contact Number</th>
              
               
                </tr>
                
            </thead>
            <?php if ($arg_query->have_posts()) {$i = 1;?>

            <tbody>
                <?php while ($arg_query->have_posts()) {  $arg_query->the_post();?>
             <tr>
                   <td><?php echo get_field('p_name'); ?></td>
                   <td><?php echo get_field('p_id_number'); ?></td>
                   <td><?php echo get_field('p_group'); ?></td>
                   <td><?php echo get_field('p_degree_course_department'); ?></td>
                   <td><?php echo get_field('p_year_level'); ?></td>
                   <td><?php echo get_field('p_address'); ?></td>
                   <td><?php echo get_field('p_contact_number'); ?></td>
                </tr>
                <?php
$i++;
}
    ?>
            </tbody>
            <?php

}
?>
        </table>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#table_patron2').DataTable( {
        dom: 'Bfrtip',
  buttons: [{ extend: "excel", text: "Export to Excel", title: null, messageTop: '<?php echo get_field('policy_header', 'option'); ?>' }],
  
    } );
} );

</script>