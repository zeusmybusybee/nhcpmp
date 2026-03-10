<?php
wp_enqueue_style(
    'memory-style',
    get_stylesheet_directory_uri() . '/assets/css/style.css',
    array(),
    filemtime(get_stylesheet_directory() . '/assets/css/style.css')
);


?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <meta property="og:image" content="<?php echo get_field('meta_image', 'option'); ?>">
    <meta property="og:description" content='<?php echo get_field('meta_description', 'option'); ?>'>
    <meta property="og:url" content="<?php echo home_url($_SERVER['REQUEST_URI']); ?>">
    <meta name="keywords" content="<?php echo get_field('meta_keywords', 'option'); ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/archiving/archiving.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
    <!--[if lt IE 9]>
	<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js?ver=3.7.0"></script>
	<![endif]-->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <?php wp_head(); ?>
</head>
<style>
    html {
        margin: 0 !important;
    }
</style>

<body <?php body_class(); ?>>