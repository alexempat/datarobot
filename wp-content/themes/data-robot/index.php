<?php
/*
  Theme Name: Data Robot
  Theme URI: https://hasayone.com
  Author: Alexandr Orlovskiy
  Description: Special theme for Data Robot Test
  Version: 1.0.0
  Text Domain: datarobot
 */
get_header();

$response = wp_remote_get('https://api.jsonbin.io/b/5dd7cefb040d843991f7183c');
$posts = json_decode(wp_remote_retrieve_body($response));
$departments = $posts->departments;

/**
 * Pagination
 */
$total_articles_number = count($posts->jobs);
$articles_per_page = 10;
$total_pages = ceil($total_articles_number / $articles_per_page);
if (!isset($_REQUEST['from'])) {
    $from = 0;
} else {
    $from = $_REQUEST['from'];
}
?>

<!-- Header Block -->
<div class="uk-container " uk-filter="target: .js-filter">
    <div class="fp-head uk-container uk-grid uk-position-relative">
        <h1>Our open positions</h1>
        
        <!-- Title & Filter -->
        <div class="uk-position-top-right">
            <button class="fp-head__button" type="button"><span>All departments</span><img src="<?php echo get_template_directory_uri() ?>/assets/img/icon/Path.svg" uk-svg></button>
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
    
    <!-- Content -->
    <ul class="fp-card uk-grid js-filter uk-position-relative">
        <?php
        $i = $from;
        foreach (array_slice($posts->jobs, $from) as $post) {
            $i++;
            if ($i > ($from + $articles_per_page)) {
                break;
            }
            $department_id = $post->departments[0];

            /*
             * Single Block
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
            . '</div>'; 
            
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
            . '</div>'; 
            
            // Bottom - Link
            echo '<div class="fp-card__content-bottom">'
            . '<a href="' . $post->absolute_url . '" target="_blank">Learn More<img src="' . get_template_directory_uri() . '/assets/img/icon/arrow_blue.svg" uk-svg></a>'
            . '</div>';

            echo '</li>'; //End Single Block
        }
        ?>
    </ul>
    <div class=" uk-container uk-text-center">
        <div class="fp-pagination">
            <?php
            // Pagination
            for ($i = 0; $i < $total_pages; $i++) {
                $page_number = $i * $articles_per_page;
                if ($page_number != $from) {
                    echo "<a href='" . $PHP_SELF . "?from=" . $page_number . "'> " . ($i + 1) . " </a>";
                } else {
                    echo "<a class='uk-active' href='" . $PHP_SELF . "?from=" . $page_number . "'> " . ($i + 1) . " </a>";
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
