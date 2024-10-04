<?php
global $the_query; // Access the query initialized in the `global-query.php` file

// Start The Loop to render each post
if( $the_query->have_posts() ) :
    echo '<div id="posts-container" class="container">';
        echo '<div id="posts-row" class="row">';

    while ( $the_query->have_posts() ) : $the_query->the_post();
        // Retrieve ACF
        $project_title = get_field('project_title');
        $primary_image = get_field('primary_image');
        $primary_role = get_field('primary_role');
        $primary_technology = get_field('primary_technology');
        $language1 = get_field('language1');
        $language2 = get_field('language2');
        $language3 = get_field('language3');
        $primary_development_category = get_field('primary_development_category');
        $primary_project_type = get_field('primary_project_type');
        $card_summary = get_field('card_summary');  
?>

            <!-- Render each post in a 6/12 column layout until the md breakpoint (<992px)  -->
            <div class="col-md-6 col--pad">
                <div class="post__wrapper">

                    <!-- Display Primary Image -->
                    <?php if( $primary_image && is_array( $primary_image ) ) : ?>
                        <img src="<?php echo esc_url( $primary_image['url'] ); ?>" alt="<?php echo esc_attr( $primary_image['alt'] ); ?>">
                        <?php else : ?>
                            <p>No image available</p>
                    <?php endif; ?>

                    <!-- Display Project Title or fallback to post title -->
                    <?php if ($project_title) : ?>
                        <h5><?php echo esc_html($project_title); ?></h5>
                    <?php else : ?>
                        <h5><?php the_title(); ?></h5> <!-- Fallback to post title -->
                    <?php endif; ?>

                    <!-- Display Primary Role -->
                    <?php if ($primary_role) : ?>
                        <p><strong>Role:</strong> <?php echo esc_html($primary_role); ?></p>
                    <?php endif; ?>

                    <!-- Display Primary Technology -->
                    <?php if ($primary_technology) : ?>
                        <p><strong>Technology:</strong> <?php echo esc_html($primary_technology); ?></p>
                    <?php endif; ?>

                    <!-- Display Programming Languages -->
                    <?php if ($language1 || $language2 || $language3) : ?>
                        <p><strong>Languages:</strong>
                            <?php echo esc_html($language1 ? $language1 : ''); ?>
                            <?php echo esc_html($language2 ? ', ' . $language2 : ''); ?>
                            <?php echo esc_html($language3 ? ', ' . $language3 : ''); ?>
                        </p>
                    <?php endif; ?>

                    <!-- Display Development Category -->
                    <?php if ($primary_development_category) : ?>
                        <p><strong>Category:</strong> <?php echo esc_html($primary_development_category); ?></p>
                    <?php endif; ?>

                    <!-- Display Project Type -->
                    <?php if ($primary_project_type) : ?>
                        <p><strong>Type:</strong> <?php echo esc_html($primary_project_type); ?></p>
                    <?php endif; ?>

                    <!-- Display Card Summary or fallback to post excerpt -->
                    <?php if ($card_summary) : ?>
                        <p><?php echo esc_html($card_summary); ?></p>
                    <?php else : ?>
                        <p><?php the_excerpt(); ?></p> <!-- Fallback to post excerpt -->
                    <?php endif; ?>

                    <a href="<?php the_permalink(); ?>">View Project</a>

                </div> <!-- end post__wrapper -->
            </div> <!-- end col-md-6 --> 
            <!-- end render each post -->

<?php
    endwhile;
        echo '</div>'; // end posts-row
    echo '</div>'; // end of container
else : echo '<p>Sorry, there are no posts available.</p>';

endif;
    
// Reset post data to prevent conflicts with other loops
wp_reset_postdata();
?>