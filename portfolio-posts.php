<?php

// Get current page number from URL, or default to 1 if not set
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Custom query for 'portfolio' post type with pagination
$portfolio_query = new WP_Query(array(
    'post_type' => 'portfolio',
    // 'posts_per_page' => 6, set in WP Dashboard > Settings > Reading
    'paged' => $paged,
    'order' => 'DESC',
    'orderby' => 'date'
));

// Pagination args for the paginate_links function
$big = 999999999; // Placeholder for pagination
$pagination_args = array(
    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format'    => '/page/%#%/',
    'current'   => max(1, get_query_var('paged')),
    'total'     => $portfolio_query->max_num_pages,
    'prev_text' => esc_attr__('&larr;'),
    'next_text' => esc_attr__('&rarr;'),
);

// Initialize the icon mapping array variables
global $role_icons, $technology_icons, $language_icons;

// Icon Mapping: 'ACF/SCF Value (not label)' => 'Icon Name' 
// Icon Name: 'SVG Set Name' + 'SVG symbol ID' (no spaces)

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

// Retrieve any ACF/SCF field objects as an associative array
function retrieve_field_object($field_name) {
    $field = get_field_object($field_name);
    if ($field) {
        $value = $field['value'];
        $label = $field['choices'][$value] ?? null;
        return array('value' => $value, 'label' => $label);
    }
    return null;
}

//Helper function to create valid, unique HTML IDs to attach to elements
function make_safe_id($string, $post_id) {
    $id = strtolower($string);
    $id = preg_replace('/[^a-z0-9]+/', '-', $id); // replace non-alphanumeric with hyphen
    $id = trim($id, '-');                      // remove leading/trailing hyphens
    return $id . '-' . $post_id;              // append post ID for uniqueness
}

echo '<div id="posts-container" class="container">';

// Start The Loop to fetch posts
if ($portfolio_query->have_posts()) :

    // Top Pagination
    echo '<div id="top-pagination" class="row row__pagination">';
        echo paginate_links($pagination_args);
    echo '</div>'; // end top pagination

    echo '<div id="posts-row" class="row">';
    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();

        // Retrieve all ACF/SCF for the current post
        $custom_fields = get_fields();

        // Accessing all standard fields
        $project_title = $custom_fields['project_title'] ?? get_the_title(); // fallback to post title
        $primary_image = $custom_fields['primary_image'] ?? null;
        $primary_development_category = $custom_fields['primary_development_category'] ?? null;
        $primary_project_category = $custom_fields['primary_project_category'] ?? null;
        $card_summary = $custom_fields['card_summary'] ?? null;
        $language1 = $custom_fields['language1'] ?? null;
        $language2 = $custom_fields['language2'] ?? null;
        $language3 = $custom_fields['language3'] ?? null;

        // Accessing all field objects
        $primary_role = retrieve_field_object('primary_role');
        $primary_role_value = $primary_role['value'] ?? null;
        $primary_role_label = $primary_role['label'] ?? null;

        $primary_technology = retrieve_field_object('primary_technology');
        $primary_technology_value = $primary_technology['value'] ?? null;
        $primary_technology_label = $primary_technology['label'] ?? null;

        ?>

        <!-- Render post in a 6/12 column layout until the md breakpoint -->
        <div class="col-md-6 col__card">
            <article class="card">
                <div class="card__mat">
                    <div class="card__body">

                        <!-- BEGIN BASE SECTIONS -->
                        <div class="card__hero" style="background-image: url('<?php echo esc_url($primary_image['url']); ?>')">
                            <div class="card__title-wrapper">
                                <h2 class="card__title"><?php echo esc_html($project_title); ?></h2>
                            </div>

                            <!-- Project Button -->
                            <a class="card__btn" href="<?php the_permalink(); ?>">View Project</a>
                        </div> <!-- end card__hero -->
                        
                        <div class="card__summary">
                            <p><?php echo esc_html($card_summary); ?></p>
                        </div> <!-- end card__summary -->
                        
                        <div class="card__categories">
                            <!-- Display Development Category -->
                            <div class="card__category">
                                <h3 class="card__category--heading">Category</h3>
                                <h3 class="card__category--text"><?php echo esc_html($primary_development_category); ?></h3>
                            </div>
                        

                            <!-- Display Project Category -->
                            <div class="card__category">
                                <h3 class="card__category--heading">Type</h3>
                                <h3 class="card__category--text"><?php echo esc_html($primary_project_category); ?></h3>
                            </div>
                        </div> <!-- end card__categories -->
                        <!-- END BASE SECTIONS -->

                        <!-- BEGIN OVERLAY CONTENT -->
                        <div class="card__overlay card__overlay--role">

                            <!-- Primary Role Icon -->
                            <div class="card__icon-wrapper card__icon-wrapper--role" tabindex="0">
                                <?php if (isset($role_icons[$primary_role_value])) :
                                    $role_id = make_safe_id($primary_role_value, get_the_ID()); 
                                ?>
                                    <svg class="card__icon card__icon--role" role="img" aria-labelledby="<?php echo esc_attr($role_id); ?>">
                                        <use xlink:href="#<?php echo esc_attr($role_icons[$primary_role_value]); ?>"></use>
                                    </svg>
                                    <div class="card__tooltip card__tooltip--right" role="tooltip" id="<?php echo esc_attr($role_id); ?>">
                                        <div class="card__tooltip--value">
                                            My Role: <?php echo esc_html($primary_role_value); ?>
                                        </div>
                                        <div class="card__tooltip--label">
                                            <?php echo esc_html($primary_role_label); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Main Tech Icon -->
                            <div class="card__icon-wrapper card__icon-wrapper--technology" tabindex="0">
                                <?php if (isset($technology_icons[$primary_technology_value])) : 
                                    $tech_id = make_safe_id($primary_technology_value, get_the_ID()); 
                                ?>
                                    <svg class="card__icon card__icon--technology" role="img" aria-labelledby="<?php echo esc_attr($tech_id); ?>">
                                        <use xlink:href="#<?php echo esc_attr($technology_icons[$primary_technology_value]); ?>"></use>
                                    </svg>
                                    <div class="card__tooltip card__tooltip--right" role="tooltip" id="<?php echo esc_attr($tech_id); ?>">
                                        <div class="card__tooltip--value">
                                            Main Tech: <?php echo esc_html($primary_technology_value); ?>
                                        </div>
                                        <div class="card__tooltip--label">
                                            <?php echo esc_html($primary_technology_label); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div> <!-- end card__overlay--role -->

                        <!-- Language Icons -->
                        <div class="card__overlay card__overlay--languages">
                            <?php foreach (array_filter([$language1, $language2, $language3]) as $language) :
                                if (array_key_exists($language, $language_icons)) : 
                                    $language_id = make_safe_id($language, get_the_ID());                                    
                            ?>
                                    <div class="card__icon-wrapper card__icon-wrapper--language" tabindex="0">
                                        <svg class="card__icon card__icon--language" role="img" aria-labelledby="<?php echo esc_attr($language_id); ?>">
                                            <use xlink:href="#<?php echo esc_attr($language_icons[$language]); ?>"></use>
                                        </svg>
                                        <div class="card__tooltip card__tooltip--left" role="tooltip" id="<?php echo esc_attr($language_id); ?>">
                                            Coded with <?php echo esc_html($language); ?>
                                        </div>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                        </div> <!-- end card__overlay--languages -->
                        <!-- END OVERLAY CONTENT -->

                    </div> <!-- end card__body -->
                </div> <!-- end card__mat -->
            </article> <!-- end card -->
        </div> <!-- end col__card -->

        <?php

    endwhile;
    echo '</div>'; // end posts-row

    // Bottom Pagination
    echo '<div id="bottom-pagination" class="row row__pagination">';
        echo paginate_links($pagination_args);
    echo '</div>'; // end bottom pagination

    // Reset post data to prevent conflicts with other loops
    wp_reset_postdata();

else :
    echo 
    '<div id="no-posts-row" class="row">
        <p id="no-posts" class="error">Sorry, there are no portfolio items available.</p>
    </div>';
endif;

echo '</div>'; // end posts-container

?>