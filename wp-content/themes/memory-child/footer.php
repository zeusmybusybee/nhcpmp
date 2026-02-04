<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Memory
 */

?>

</div><!-- #content -->



<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="row add_padding">
            <div class="col-md-4">
                <?php if (have_rows('ph_logos', 'option')): ?>
                    <ul class="ph_logos">
                        <?php while (have_rows('ph_logos', 'option')) : the_row();
                            $default_image = get_template_directory_uri() . '/assets/images/default_image.jpg';
                            $logos = get_sub_field('logo');
                            $photo_url = $logos ? $logos['url'] : $default_image;
                            $name = get_sub_field('alt_name');
                        ?>
                            <li class="ph_logo_item">
                                <img src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($name); ?>">
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>no logo available</p>
                <?php endif; ?>
                <div class="break"></div>
                <div class="first_column">
                    <?php the_field('first_column_text', 'option'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div id="footer-links">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'container' => 'ul',         // Optional: wraps menu in <ul> only
                        'menu_class' => 'footer-menu' // CSS class for <ul>
                    ));
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="map_frame">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.309407129412!2d120.97575107574104!3d14.581437177544228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ca2572c53067%3A0xef0fcd0983b717fd!2sNational%20Historical%20Commission%20of%20the%20Philippines!5e0!3m2!1sen!2sph!4v1770186812224!5m2!1sen!2sph" width="420" height="210" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <?php if (have_rows('socials', 'option')): ?>
                    <ul class="socials">
                        <?php
                        $icons = [
                            'facebook' => '<i class="fa-brands fa-facebook"></i>',
                            'instagram' => '<i class="fa-brands fa-instagram"></i>',
                            'x'  => '<i class="fa-brands fa-x-twitter"></i>',
                            'tiktok' => '<i class="fa-brands fa-tiktok"></i>',
                            'youtube'  => '<i class="fa-brands fa-youtube"></i>',
                        ];

                        while (have_rows('socials', 'option')) : the_row();
                            $social_name = strtolower(get_sub_field('name')); // lowercase to match keys
                            $social_link = get_sub_field('link');
                        ?>
                            <li class="social_item">
                                <a href="<?php echo esc_url($social_link); ?>" target="_blank">
                                    <?php
                                    // Show icon if exists, otherwise show nothing or fallback image
                                    echo isset($icons[$social_name]) ? $icons[$social_name] : '';
                                    ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No social media links available</p>
                <?php endif; ?>

            </div>
        </div>

    </div>
    <div class="footer_information">
        <?php
        $icons_address = [
            '<i class="fa-solid fa-location-dot"></i>',
            '<i class="fa-solid fa-globe"></i>',
            '<i class="fa-brands fa-facebook"></i>',
            '<i class="fa-solid fa-envelope"></i>',
            '<i class="fa-solid fa-phone"></i>',
        ];

        // Get repeater rows
        $rows = get_field('address', 'option');

        if ($rows): ?>
            <ul class="footer_info_list">
                <?php foreach ($rows as $index => $row):
                    $info = $row['description'];

                    // Get icon by index, fallback to empty if out of range
                    $icon_html = isset($icons_address[$index]) ? $icons_address[$index] : '';
                ?>
                    <li class="footer_info_item">
                        <?php echo $icon_html; ?>
                        <?php echo esc_html($info); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No footer information available</p>
        <?php endif; ?>
    </div>
    <div class="gov_footer">
        <div class="row">
            <div class="col-md-3">
                <div class="gov_logo">
                    <img src="<?php the_field('gov_image', 'option'); ?>" alt="Government Logo">
                </div>
            </div>
            <?php if (have_rows('second_footer', 'option')): ?>
                <?php while (have_rows('second_footer', 'option')) : the_row(); ?>
                    <div class="col-md-3">
                        <div class="gov_information">
                            <?php the_sub_field('column_texts'); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No footer columns available</p>
            <?php endif; ?>
            <div class="col-md-3">
                <p class="gov_links_title">Government Links</p>
                <?php if (have_rows('governments_links', 'option')): ?>
                    <ul class="gov_links">
                        <?php while (have_rows('governments_links', 'option')) : the_row();
                            $link_text = get_sub_field('governments_name');
                            $link_url = get_sub_field('link');
                        ?>
                            <li class="gov_link_item">
                                <a href="<?php echo esc_url($link_url); ?>" target="_blank"><?php echo esc_html($link_text); ?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No government links available</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <p class="copyright"><b>Copyright</b> © <span id="year"></span> NHCP</p>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>