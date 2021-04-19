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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.4/lodash.min.js"></script><script src="js/script.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.10/lodash.min.js"></script>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class('fp'); ?>><?php wp_body_open(); ?>

        <?php
        $response = wp_remote_get('https://api.jsonbin.io/b/5dd7cefb040d843991f7183c');
        $posts = json_decode(wp_remote_retrieve_body($response));
        $departments = $posts->departments;
        ?>


        <div class="uk-container " uk-filter="target: .js-filter">

            <div class="fp-head uk-container uk-grid uk-position-relative">
                <h1>Our open positions</h1>
                <!-- Desktop -->
                <div class="uk-position-top-right">
                    <button class="fp-head__button" type="button">All departments</button>
                    <div uk-dropdown="mode: click" style="display: none" uk-overflow-auto>
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active" uk-filter-control><a href="">All departments</a></li>
                            <?php
                            foreach ($departments as $tag) :
                                $tag_stop = esc_html($tag->name);
                                ?>
                                <li uk-filter-control="[data-cat-filter*='<?php echo esc_html($tag->name); ?>']"><a href="#"><?php echo esc_html($tag->name); ?></a></li>
                                <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>

                </div>
            </div>

            <ul class="fp-card uk-grid js-filter uk-position-relative">

                <?php

                foreach ($posts->jobs as $post) {
                    $department_id = $post->departments[0];
                    /*
                     * Block
                     */
                    echo '<li class="fp-card__content" id="' . $post->id . '"';
                    foreach ($departments as $department) {
                        $name = $department->name;
                        if ($department->id == $department_id) {
                            echo 'data-cat-filter="' . esc_html($name) . '">';
                        }
                    }
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
                    . '<a href="' . $post->absolute_url . '" target="_blank">Learn More <img src="' . get_template_directory_uri() . '/assets/img/icon/arrow_blue.svg" uk-svg></a>'
                    . '</div>'; //End bottom block

                    echo '</li>'; //End block
                }
                ?> 
            </ul>
        </div>

        <?php wp_footer(); ?>
        </body>
</html>
