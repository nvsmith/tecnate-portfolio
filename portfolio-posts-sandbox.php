<?php

// Get current page number from URL, or default to 1 if not set
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Define the custom query for 'portfolio' post type with pagination
$portfolio_query = new WP_Query(array(
    'post_type' => 'portfolio',
    'posts_per_page' => 6,
    'paged' => $paged,
    'order' => 'DESC',
    'orderby' => 'date'
));

// Icon Mapping: 'ACF/SCF Value' => 'Icon Name'
// Note: Icon Name = '(SVG Set Name)(SVG symbol ID)'

// Define the icon mapping for primary role
$role_icons = array(
    'Front-end Developer' => 'portfoliofrontend-developer',
    'Back-end Developer' => 'portfoliobackend-developer',
    'Full-stack Developer' => 'portfoliofullstack-developer',
    'Consultant' => 'portfolioconsultant',
    'UI/UX Designer' => 'portfolioui-ux-designer'
);

// Define the icon mapping for primary technology
$technology_icons = array(
    'Bootstrap' => 'portfoliobootstrap',
    'jQuery' => 'portfoliojquery',
    'React' => 'portfolioreact',
    'Node.js' => 'portfolionodejs',
    'WordPress' => 'portfoliowordpress',
    'WooCommerce' => 'portfoliowoocommerce',
    'API' => 'portfolioapi',
    'MySQL' => 'portfoliomysql',
    'Git' => 'portfoliogit'
);

// Define the icon mapping for languages
$language_icons = array(
    'HTML' => 'portfoliohtml',
    'Markdown' => 'portfoliomarkdown',
    'CSS' => 'portfoliocss',
    'JavaScript' => 'portfoliojavascript',
    'PHP' => 'portfoliophp',
    'C++' => 'portfoliocplusplus',
    'Bash' => 'portfoliobash'
);


// Start The Loop to render each post
if ($portfolio_query) :
    if ($portfolio_query->have_posts()) :

        // Top Pagination
        $big = 999999999; // need an unlikely placeholder in the base parameter for the paginate_links function
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), // Structure URL for pagination, using a placeholder for the page number
            'format' => '?paged=%#%', // Format URL structure
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

            // Retrieve ACF/SCF fields for overlay content
            $primary_role = get_field_object('primary_role');
            $primary_role_value = $primary_role['value']; // e.g., "Front-end Developer"; used for icon mapping
            $primary_role_label = $primary_role['choices'][$primary_role_value]; // e.g., "Building responsive, interactive user interfaces"

            $primary_technology = get_field_object('primary_technology');
            $primary_technology_value = $primary_technology['value']; // e.g., "React"; used for icon mapping
            $primary_technology_label = $primary_technology['choices'][$primary_technology_value]; // e.g., "JavaScript library for fast, interactive user interfaces"

            $language1 = get_field('language1');
            $language2 = get_field('language2');
            $language3 = get_field('language3');

            // Echo each ACF/SCF field value in <p> tags, but only if the field exists and has a value
            if ( $project_title !== false && $project_title ) echo '<p>' . $project_title . '</p>';
            if ( $primary_image !== false && $primary_image ) echo '<p>' . $primary_image . '</p>';
            if ( $primary_development_category !== false && $primary_development_category ) echo '<p>' . $primary_development_category . '</p>';
            if ( $primary_project_category !== false && $primary_project_category ) echo '<p>' . $primary_project_category . '</p>';
            if ( $card_summary !== false && $card_summary ) echo '<p>' . $card_summary . '</p>';
            if ( $primary_role_value !== false && $primary_role_value ) echo '<p>' . $primary_role_value . '</p>';
            if ( $primary_technology_value !== false && $primary_technology_value ) echo '<p>' . $primary_technology_value . '</p>';
            if ( $language1 !== false && $language1 ) echo '<p>' . $language1 . '</p>';
            if ( $language2 !== false && $language2 ) echo '<p>' . $language2 . '</p>';
            if ( $language3 !== false && $language3 ) echo '<p>' . $language3 . '</p>';
            echo '<hr>';

        endwhile;

        // Bottom Pagination
        $big = 999999999; // need an unlikely placeholder in the base parameter for the paginate_links function
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), // Structure URL for pagination, using a placeholder for the page number
            'format' => '?paged=%#%', // Format URL structure
            'current' => max(1, get_query_var('paged')), // Current page number
            'total' => $portfolio_query->max_num_pages, // Total number of pages
            'prev_text' => esc_attr__('&larr; Previous'), // Previous page link
            'next_text' => esc_attr__('Next &rarr;'), // Next page link
        ));

        // Reset post data to prevent conflicts with other loops
        wp_reset_postdata();
        if (wp_reset_postdata() === false) :
            echo '<p>Error: Post data reset failed</p>';
        endif;

    else :
        echo '<p>Sorry, there are no posts available.</p>';
    endif;

else : 
    echo `<p>Query Failed</p>`;
endif;

?>
