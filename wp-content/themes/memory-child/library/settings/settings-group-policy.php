<section>
    <div class="main-content">





        <div class="main-body__area" style="margin-top: 0;">
            <div class="catalog">
                <div class="catalog__add">
                    <div class="catalog__add--title">
                        <h3>
                            Policy Setting
                        </h3>
                    </div>
                    <div class="catalog__add--content">
                        <?php
                        acf_form(array(
                            'post_id' => 'options',
                            'field_groups' => array(
                                'group_63e594d1944ea',
                            ),
                            'updated_message' => __("Policy Settings Successfully Updated.", 'acf'),

                            'submit_value' => 'Save Changes',
                        ));
                        ?>

                        <?php
                        /*   
        $options = array(
        'post_id' => 'options',
		'fields' => array('field_6375937dee3bd'), 
		);
        acf_form($options); 
    
           */ ?>
                    </div>
                </div>
            </div>

        </div>




    </div>
</section>
<br>


<div class="tab__content">
    <div class="tab__content--header">
        <div class="catalog__add--title">
            <h3>
                Group Setting
            </h3>
        </div>

        <div class="tab__content--browse">
            <!--<div class="browse">
                <span>More than 1000+ Browse Archives</span>
            </div> -->
            <div class="button">
                <a href="<?php echo site_url('/add-group'); ?>">Add</a>
            </div>
        </div>
    </div>


    <div class="tab__content--table">
        <table id="table_archives" class="display">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $arg_groups = array(
                'post_type' => 'settings-group',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'paged' => $paged,
            );
            $arg_query = new WP_Query($arg_groups);
            ?>
            <thead>
                <tr>
                    <th>Counter</th>
                    <th>Group Name</th>
                    <th>Description</th>
                    <th> Action</th>
                </tr>
            </thead>
            <?php if ($arg_query->have_posts()) {
                $i = 1; ?>

                <tbody>
                    <?php while ($arg_query->have_posts()) {
                        $arg_query->the_post(); ?>
                        <tr>
                            <td class="counter"><?php echo $i; ?></td>
                            <td><?php echo get_field('group_name'); ?></td>
                            <td><?php echo get_field('description'); ?></td>
                            <td class="actions">
                                <div class="table__content--body action">
                                    <a href="<?php the_permalink(); ?>" class="preview">Preview</a>
                                    <a href="<?php echo get_delete_post_link(); ?>" class=" delete"
                                        onclick="return confirm('Are you sure you wanna delete this?')">Delete</a>
                                    <a href="<?php echo site_url('/edit-archives'); ?>?post=<?php the_ID(); ?>"
                                        class="edit">Edit</a>
                                </div>
                            </td>
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