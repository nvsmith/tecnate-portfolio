<?php

// Get current page number from URL, or default to 1 if not set
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Define the custom query for 'portfolio' post type with pagination
$portfolio_query = new WP_Query(array(
    'post_type' => 'portfolio',
    // 'posts_per_page' => 6, set in WP Dashboard > Settings > Reading
    'paged' => $paged,
    'order' => 'DESC',
    'orderby' => 'date'
));

// Start The Loop to render each post
if ($portfolio_query) :
    if ($portfolio_query->have_posts()) :

        // Top Pagination
        $big = 999999999; // Need an unlikely placeholder in the base parameter for the paginate_links function
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), // Structure URL for pagination, using a placeholder for the page number
            'format' => '/page/%#%/', // Format URL structure to match Oxygen defaults
            'current' => max(1, get_query_var('paged')), // Current page number
            'total' => $portfolio_query->max_num_pages, // Total number of pages
            'prev_text' => esc_attr__('&larr; Previous'), // Previous page link
            'next_text' => esc_attr__('Next &rarr;'), // Next page link
        ));

        while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
            // Retrieve ACF/SCF fields for base sections
            $project_title = get_field('project_title');
            $primary_image = get_field('primary_image');
            $primary_development_category = get_field('primary_development_category');
            $primary_project_category = get_field('primary_project_category');
            $card_summary = get_field('card_summary');

            // Echo each ACF/SCF field value in <p> tags, but only if the field exists and has a value
            if ($project_title) echo '<p>' . $project_title . '</p>';
            if ($primary_image) echo '<p>' . $primary_image . '</p>';
            if ($primary_development_category) echo '<p>' . $primary_development_category . '</p>';
            if ($primary_project_category) echo '<p>' . $primary_project_category . '</p>';
            if ($card_summary) echo '<p>' . $card_summary . '</p>';
            echo '<hr>';

        endwhile;

        // Bottom Pagination
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), // Structure URL for pagination, using a placeholder for the page number
            'format' => '/page/%#%/', // Format URL structure to match Oxygen defaults
            'current' => max(1, get_query_var('paged')), // Current page number
            'total' => $portfolio_query->max_num_pages, // Total number of pages
            'prev_text' => esc_attr__('&larr; Previous'), // Previous page link
            'next_text' => esc_attr__('Next &rarr;'), // Next page link
        ));

        // Reset post data to prevent conflicts with other loops
        wp_reset_postdata();

    else :
        echo '<p>Sorry, there are no posts available.</p>';
    endif;

else : 
    echo '<p>Query Failed</p>';
endif;

?>
