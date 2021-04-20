<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.4/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.10/lodash.min.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class('fp'); ?>><?php wp_body_open(); ?>