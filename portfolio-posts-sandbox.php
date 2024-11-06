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

// Icon Mapping: 'ACF/SCF Value (not label)' => 'Icon Name' 
// Icon Name: 'SVG Set Name' + '(SVG symbol ID)'

// Primary Role Icon Mapping
$role_icons = [
    'Front-end Developer' => 'portfoliofrontend-developer',
    'Back-end Developer' => 'portfoliobackend-developer',
    'Full-stack Developer' => 'portfoliofullstack-developer',
    'Consultant' => 'portfolioconsultant',
    'UI/UX Designer' => 'portfolioui-ux-designer'
];

// Technology Icon Mapping
$technology_icons = [
    'Bootstrap' => 'portfoliobootstrap',
    'jQuery' => 'portfoliojquery',
    'React' => 'portfolioreact',
    'Node.js' => 'portfolionodejs',
    'WordPress' => 'portfoliowordpress',
    'WooCommerce' => 'portfoliowoocommerce',
    'API' => 'portfolioapi',
    'MySQL' => 'portfoliomysql',
    'Git' => 'portfoliogit'
];

// Language Icon Mapping
$language_icons = [
    'HTML' => 'portfoliohtml',
    'Markdown' => 'portfoliomarkdown',
    'CSS' => 'portfoliocss',
    'JavaScript' => 'portfoliojavascript',
    'PHP' => 'portfoliophp',
    'C++' => 'portfoliocplusplus',
    'Bash' => 'portfoliobash'
];

echo '<div id="posts-container" class="container">';

// Start The Loop to fetch posts
if ($portfolio_query) :
    if ($portfolio_query->have_posts()) :

        // Top Pagination
        echo '<div id="top-pagination" class="row row__pagination">';
            $big = 999999999; // Placeholder in the base parameter for the paginate_links function
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), // Structure URL for pagination, using a placeholder for the page number
                'format' => '/page/%#%/', // Format URL structure to match Oxygen defaults
                'current' => max(1, get_query_var('paged')), // Current page number
                'total' => $portfolio_query->max_num_pages, // Total number of pages
                'prev_text' => esc_attr__('&larr; Previous'), // Previous page link
                'next_text' => esc_attr__('Next &rarr;'), // Next page link
            ));
        echo '</div>'; // end top pagination

        echo '<div id="posts-row" class="row">';
            while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                // Retrieve ACF/SCF for base sections
                $project_title = get_field('project_title');
                $primary_image = get_field('primary_image');
                $primary_development_category = get_field('primary_development_category');
                $primary_project_category = get_field('primary_project_category');
                $card_summary = get_field('card_summary');  

                // Retrieve ACF/SCF for overlay content
                $primary_role = get_field_object('primary_role');
                $primary_role_value = $primary_role['value']; // e.g., "Front-end Developer"; used for icon mapping
                $primary_role_label = $primary_role['choices'][$primary_role_value]; // e.g., "Building responsive, interactive user interfaces"
                
                $primary_technology = get_field_object('primary_technology');
                $primary_technology_value = $primary_technology['value']; // e.g., "React"; used for icon mapping
                $primary_technology_label = $primary_technology['choices'][$primary_technology_value]; // e.g., "JavaScript library for fast, interactive user interfaces"
                
                $language1 = get_field('language1');
                $language2 = get_field('language2');
                $language3 = get_field('language3');

            endwhile;
        echo '</div>'; // end posts-row

        // Bottom Pagination
        echo '<div id="bottom-pagination" class="row row__pagination">';
            $big = 999999999; // Placeholder in the base parameter for the paginate_links function
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), // Structure URL for pagination, using a placeholder for the page number
                'format' => '/page/%#%/', // Format URL structure to match Oxygen defaults
                'current' => max(1, get_query_var('paged')), // Current page number
                'total' => $portfolio_query->max_num_pages, // Total number of pages
                'prev_text' => esc_attr__('&larr; Previous'), // Previous page link
                'next_text' => esc_attr__('Next &rarr;'), // Next page link
            ));
        echo '</div>'; // end bottom pagination

        // Reset post data to prevent conflicts with other loops
        wp_reset_postdata();

    else :
        echo 
        '<div id="no-posts-row" class="row">
            <p id="no-posts" class="error">Sorry, there are no posts available.</p>
        </div>';
    endif;

else : 
    echo '<p id="query-failed" class="error">Query Failed</p>';
endif;

echo '</div>'; // end posts-container

?>
