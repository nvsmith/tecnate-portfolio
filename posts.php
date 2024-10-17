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
                    <div class="card__body">

                        <!-- Begin Base Sections -->
                        
                        <!-- Display Primary Image -->
                        <div class="card-hero" style = "background-image: url('<?php echo esc_url($primary_image['url']); ?>')">
                        </div> <!-- end card-hero -->
                        
                        <div class="card-summary">
                            <!-- Display Card Summary or fallback to post excerpt -->
                            <p><?php echo esc_html($card_summary ?: get_the_excerpt()); ?></p>
    
                            <div class="card__btn">
                                <a href="<?php the_permalink(); ?>">View Project</a>
                            </div>
                        </div> <!-- end card-summary -->
                        
                        <div class="card-footer">
                            <?php
                            $post_date = get_the_date('d M Y');
                            echo '<p class="card-footer__date">Published: ' . esc_html($post_date) . '</p>';
                            ?>
                        </div> <!-- end card-footer -->
                        <!-- End Base Sections -->

                        <!-- Begin Overlay Sections -->
                        <div class="card-overlay card-overlay__title-container">
                            <div class="card-icon__wrapper card-icon__wrapper--role">
                                <!-- Display Primary Role Icon -->
                                <?php if (isset($role_icons[$primary_role])) : ?>
                                    <svg class="card-icon card-icon--role"><use xlink:href="#<?php echo esc_attr($role_icons[$primary_role]); ?>"></use></svg>
                                <?php endif; ?>
                            </div>

                            <div class="wrapper__title">
                                <!-- Display Project Title or fallback to post title -->
                                <h5><?php echo esc_html($project_title ?: get_the_title()); ?></h5>
                            </div>

                            <div class="card-icon__wrapper card-icon__wrapper--technology">
                                <!-- Display Primary Technology Icon -->
                                <?php if (isset($technology_icons[$primary_technology])) : ?>
                                    <svg class="card-icon card-icon--technology"><use xlink:href="#<?php echo esc_attr($technology_icons[$primary_technology]); ?>"></use></svg>
                                <?php endif; ?>
                            </div>
                        </div> <!-- end overlay__title-container -->

                        <div class="card-overlay card-overlay__language-container">
                            <!-- Display language icons -->
                            <?php foreach ([$language1, $language2, $language3] as $language) :
                                if ($language && array_key_exists($language, $language_icons)) : ?>
                                    <div class="card-icon__wrapper card-icon__wrapper--language">
                                        <svg class="card-icon card-icon--language"><use xlink:href="#<?php echo esc_attr($language_icons[$language]); ?>"></use></svg>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                        </div> <!-- end overlay__language-container -->

                        <div class="card-overlay card-overlay__category-container">
                            <!-- Display Development Category -->
                            <?php if ($primary_development_category) : ?>
                                <h4 class="card__development">Category: <span><?php echo esc_html($primary_development_category); ?></span></h4>
                            <?php endif; ?>
    
                            <!-- Display Project Category -->
                            <?php if ($primary_project_category) : ?>
                                <h4 class="card__project">Type: <span><?php echo esc_html($primary_project_category); ?></span></h4>
                            <?php endif; ?>
                        </div> <!-- end overlay__category-container -->
                        <!-- End Overlay Sections -->
                    </div> <!-- end card__body -->
                </div> <!-- end card__mat -->
            </div> <!-- end card -->
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