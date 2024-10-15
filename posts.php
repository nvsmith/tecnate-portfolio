<?php
global $the_query; // Access the query initialized in the `global-query.php` file

// Start The Loop to render each post
if( $the_query->have_posts() ) :
    echo '<div id="posts-container" class="container">';
    echo '<div id="posts-row" class="row">';

    while ( $the_query->have_posts() ) : $the_query->the_post();
        // Retrieve ACF fields
        $project_title = get_field('project_title');
        $primary_image = get_field('primary_image');
        $primary_role = get_field('primary_role');
        $primary_technology = get_field('primary_technology');
        $language1 = get_field('language1');
        $language2 = get_field('language2');
        $language3 = get_field('language3');
        $primary_development_category = get_field('primary_development_category');
        $primary_project_category = get_field('primary_project_category');
        $card_summary = get_field('card_summary');  

        // Icon Mapping: 'ACF Choice Value' => 'Icon Name ("portfolio" + SVG symbol ID)'

        // Define the icon mapping for primary role
        $role_icons = [
            'Front-end Developer' => 'portfoliofrontend-developer',
            'Back-end Developer' => 'portfoliobackend-developer',
            'Full-stack Developer' => 'portfoliofullstack-developer',
            'Consultant' => 'portfolioconsultant',
            'UI/UX Designer' => 'portfolioui-ux-designer'
        ];

        // Define the icon mapping for primary technology
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

        // Define the icon mapping for languages
        $language_icons = [
            'HTML' => 'portfoliohtml',
            'Markdown' => 'portfoliomarkdown',
            'CSS' => 'portfoliocss',
            'JavaScript' => 'portfoliojavascript',
            'PHP' => 'portfoliophp',
            'C++' => 'portfoliocplusplus',
            'Bash' => 'portfoliobash'
        ];?>

        <!-- Render post in a 6/12 column layout until the md breakpoint -->
        <div class="col-md-6 col--pad">
            <div class="card">
                <div class="card__mat">
                    <div class="card__content-wrapper">
                        <div class="card__img-wrapper"
                            style="background-image: url(<?php echo esc_url( $primary_image['url'] ); ?>);">
                        
                            <div class="card__title-container">
                                <div class="card__role-wrapper">
                                    <!-- Display Primary Role Icon -->
                                    <?php if (isset($role_icons[$primary_role])) : ?>
                                        <svg class="ct-fancy-icon card__role-icon"><use xlink:href="#<?php echo esc_attr($role_icons[$primary_role]); ?>"><use></svg>
                                    <?php endif; ?>
                                </div>

                                <div class="card__title-wrapper">
                                    <!-- Display Project Title or fallback to post title -->
                                    <h5><?php echo esc_html($project_title ? $project_title : get_the_title()); ?></h5>
                                </div>

                                <div class="card__technology-wrapper">
                                    <!-- Display Primary Technology Icon -->
                                    <?php if (isset($technology_icons[$primary_technology])) : ?>
                                        <svg class="ct-fancy-icon card__technology-icon"><use xlink:href="#<?php echo esc_attr($technology_icons[$primary_technology]); ?>"></use></svg>
                                    <?php endif; ?>
                                </div>
                            </div>
    
                            <div class="card__language-container">
                                <!-- Display language icons -->
                                <?php foreach ([$language1, $language2, $language3] as $language) :
                                    if ($language && array_key_exists($language, $language_icons)) : ?>
                                    <div class="card__language-icon-wrapper">
                                        <svg class="ct-fancy-icon card__language-icon"><use xlink:href="#<?php echo esc_attr($language_icons[$language]); ?>"></use></svg>
                                    </div>
                                    <?php endif;
                                endforeach; ?>
                            </div>

                        </div>
    
                        <div class="card__category-wrapper">
                            <!-- Display Development Category -->
                            <?php if ($primary_development_category) : ?>
                                <h4 class="card__development">Category:<?php echo esc_html($primary_development_category); ?></h4>
                            <?php endif; ?>
    
                            <!-- Display Project Category -->
                            <?php if ($primary_project_category) : ?>
                                <h4 class="card__project">Type: <?php echo esc_html($primary_project_category); ?></h4>
                            <?php endif; ?>
                        </div>
    
                        <div class="card__summary-wrapper">
                            <!-- Display Card Summary or fallback to post excerpt -->
                            <?php if ($card_summary) : ?>
                                <p><?php echo esc_html($card_summary); ?></p>
                            <?php else : ?>
                                <p><?php the_excerpt(); ?></p> <!-- Fallback to post excerpt -->
                            <?php endif; ?>
    
                            <div class="card__btn">
                                <a href="<?php the_permalink(); ?>">View Project</a>
                            </div>
                        </div>
                    </div>

                    <div class="card__footer"></div>
                </div>
            </div>
        </div> <!-- end col-md-6 | End post rendering --> 

<?php
    endwhile;
    echo '</div>'; // end posts-row
    echo '</div>'; // end posts-container
else : 
    echo '<p>Sorry, there are no posts available.</p>';
endif;
    
// Reset post data to prevent conflicts with other loops
wp_reset_postdata();
?>
