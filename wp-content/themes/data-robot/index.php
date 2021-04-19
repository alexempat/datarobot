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
    <body <?php body_class(); ?>><?php wp_body_open(); ?>

        <!--
            You need to get raw data from a remote server( link ),
            process it and then be able to output structured content in your template.  
        -->  
        
        <?php
        $response = wp_remote_get('https://api.jsonbin.io/b/5dd7cefb040d843991f7183c');
        $posts = json_decode(wp_remote_retrieve_body($response));
        echo '<div class="latest-posts">';
        foreach ($posts->jobs as $post) {
           // echo '<h2>ID = ' . $post->id . '</h2>';
        }
        echo '</div>';
        ?>


        <?php wp_footer(); ?>
    </body>
</html>