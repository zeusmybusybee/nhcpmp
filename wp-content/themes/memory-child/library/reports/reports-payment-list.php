<div class="tab__content">

    <div class="tab__content--table">
        <table id="table_eresources2" class="display">
      <?php

$arg_analytics = array(
    'post_type' => 'checkout_books',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_query' => array(
    'relation' => 'AND',
    array(
		'key' => 'fine_amount'
		),
    )
  
);
$arg_query = new WP_Query($arg_analytics);
?>
            <thead>
                
                <tr>
                    <th>ID Number </th>
                    <th>Accession</th>
                    <th>Title</th>
                    <th>Date out</th>
                    <th>Date due</th>
                    <th>Fine Amount</th>
              
               
                </tr>
                
            </thead>
            <?php if ($arg_query->have_posts()) {$i = 1;?>

            <tbody>
                <?php while ($arg_query->have_posts()) {  $arg_query->the_post();?>
             <tr>
                   <td><?php echo get_field('id_number'); ?></td>
                   <td><?php echo get_field('accession_number'); ?></td>
                   <td><?php echo get_the_title(get_field('book_id')); ?></td>
                   <td><?php echo get_field('date_out'); ?></td>
                   <td><?php echo get_field('date_due'); ?></td>
                    <td><?php echo "₱"; echo get_field('fine_amount'); echo ".00";?></td>
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
    $('#table_eresources2').DataTable( {
        dom: 'Bfrtip',
  buttons: [{ extend: "excel", text: "Export to Excel", title: null, messageTop: '<?php echo get_field('policy_header', 'option'); ?>' }],
  
    } );
} );

</script>