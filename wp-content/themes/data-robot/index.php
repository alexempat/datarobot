<?php
/*
Theme Name: Data Robot
Theme URI: https://hasayone.com
Author: Alexandr Orlovskiy
Description: Special theme for Data Robot Test
Version: 1.0.0
Text Domain: datarobot
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>><?php wp_body_open(); ?><div id="page">
            <div class="site-title"><div class="site-title-bg">
                    <h1><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <?php
                    $blank_description = get_bloginfo('description', 'display');
                    if ($blank_description || is_customize_preview()) :
                        ?>
                        <p class="site-description"><?php echo esc_html($blank_description); ?></p>
                    <?php endif; ?>
                </div></div>
            <?php the_custom_logo(); ?>

            <footer id="colophon" class="site-footer"><div class="site-info">
                    <?php esc_html_e('Intentionally Blank', 'intentionally-blank'); ?>
                    <?php /* translators: Proudly powered by WordPress */ ?>
                    - <a href="<?php echo esc_url(__('https://wordpress.org/', 'intentionally-blank')); ?>"><?php printf(esc_html__('Proudly powered by %s', 'intentionally-blank'), 'WordPress'); ?></a>
                </div></footer>
        </div><!-- #page -->
        <?php wp_footer(); ?>
    </body>
</html>
