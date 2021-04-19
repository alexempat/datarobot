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
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class('fp'); ?>><?php wp_body_open(); ?>

        <!--
            You need to get raw data from a remote server( link ),
            process it and then be able to output structured content in your template.  
        -->  

        <div class="uk-container " >
            <div class="fp-head uk-container">
                <h1>Our open positions</h1>
            </div>
            <div class="fp-card uk-grid">

                <?php
                $response = wp_remote_get('https://api.jsonbin.io/b/5dd7cefb040d843991f7183c');
                $posts = json_decode(wp_remote_retrieve_body($response));
                $departments = $posts->departments;
                foreach ($posts->jobs as $post) {

                    $department_id = $post->departments[0];
                    /*
                     * Block
                     */
                    echo '<div class="fp-card__content" id="' . $post->id . '">';
                    // Top - Title
                    echo '<div class="fp-card__content-top">'
                    . '<a href="' . $post->absolute_url . '" target="_blank"><h3>' . $post->title . '</h3></a>'
                    . '</div>'; //End top block
                    // Center - Content
                    echo '<div class="fp-card__content-center">'
                    . '<div class="fp-card__content-center-location">'
                    . $post->location->name
                    . '</div>'
                    . '<div class="fp-card__content-center-department">';
                    foreach ($departments as $department) {
                        $name = $department->name;
                        if ($department->id == $department_id) {
                            echo $name;
                        }
                    }
                    echo '</div> '
                    . '</div>'; //End center block
                    // Bottom - Link
                    echo '<div class="fp-card__content-bottom">'
                    . '<a href="' . $post->absolute_url . '" target="_blank">Learn More <img src="' . get_template_directory_uri() . '/assets/img/icon/arrow_blue.svg"></a>'
                    . '</div>'; //End bottom block

                    echo '</div>'; //End block
                }
                ?> 

            </div>
        </div>

        <?php wp_footer(); ?>
    </body>
</html>
