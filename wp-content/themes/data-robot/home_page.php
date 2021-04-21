<?php

/**
 * Template Name: Home Page
 */
get_header();

$context = Timber::get_context();$response = wp_remote_get('https://api.jsonbin.io/b/5dd7cefb040d843991f7183c');
$posts = json_decode(wp_remote_retrieve_body($response));
$context['departments'] = $posts->departments;
$context['jobs'] = $posts->jobs;
Timber::render('templates/content.twig', $context);
?>

<?php

get_footer();
