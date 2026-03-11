<div class="tab__content">

    <div class="tab__content--table">
        <table id="table_serial2" class="display">
            <?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$arg_archives = array(
    'post_type' => 'serial',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'paged' => $paged,
);
$arg_query = new WP_Query($arg_archives);
?>
            <thead>
                <tr>
                  
                    <th>Title</th>
                    <th>Call Number</th>
                    <th>Place of publication</th>
                    <th>Publisher</th>
                    <th>Description</th>
                    <th>Frequency</th>
                    <th>Latest Received</th>
                    <th>Subject</th>
                    <th>Corporate</th>
                    <th>Discipline</th>
                    <th>ISSN</th>
                    <th>Location</th>
                    <th>Barcode</th>
                    <th>Electronic Access</th>
                    <th>Accession Number</th>
                  
                
                </tr>
            </thead>
            <?php if ($arg_query->have_posts()) {$i = 1;?>

            <tbody>
                <?php while ($arg_query->have_posts()) {
    $arg_query->the_post();?>
                <tr>
               
                    <td class="counter"><?php echo get_the_title(); ?></td>
                    <td class="counter"><?php echo get_field('s_call_number'); ?></td>
                    <td class="counter"><?php echo get_field('s_place_of_publication'); ?></td>
                    <td class="counter"><?php echo get_field('s_publisher'); ?></td>
                    <td class="counter"><?php echo get_field('s_description'); ?></td>
                    <td class="counter"><?php echo get_field('s_frequency'); ?></td>
                    <td class="counter"><?php echo get_field('s_latest_received'); ?></td>
                    <td class="counter"><?php echo get_field('s_subject'); ?></td>
                    <td class="counter"><?php echo get_field('s_corporate'); ?></td>
                    <td class="counter"><?php echo get_field('s_discipline'); ?></td>
                    <td class="counter"><?php echo get_field('s_issn'); ?></td>
                    <td class="counter"><?php echo get_field('s_location'); ?></td>
                    <td class="counter"><?php echo get_field('s_barcode'); ?></td>
                    <td class="counter"><?php echo get_field('s_electronic_access'); ?></td>
                    <td class="counter"><?php echo get_field('accession_number'); ?></td>
                  
                 
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
    $('#table_serial2').DataTable( {
        dom: 'Bfrtip',
  buttons: [{ extend: "excel", text: "Export to Excel", title: null, messageTop: '<?php echo get_field('policy_header', 'option'); ?>' }],
  
    } );
} );

</script>