<?php

// Get the custom post type query & icon mappings in the Global Queries Code Block in Oxygen
global $portfolio_query; 
global $role_icons, $technology_icons, $language_icons;

// Start The Loop to render each post
if( $portfolio_query->have_posts() ) :
    echo '<div id="posts-container" class="container">';
    echo '<div id="posts-row" class="row">';

    while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
        // Retrieve ACF (or SCF) fields
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
?>

        <!-- Render post in a 6/12 column layout until the md breakpoint -->
        <div class="col-md-6 col__card">
            <article class="card">
                <div class="card__mat">
                    <div class="card__body">

                        <!-- BEGIN BASE SECTIONS -->
                        <div class="card__hero" style="background-image: url('<?php echo esc_url($primary_image['url']); ?>')">
                            <div class="card__title-wrapper">
                                <h2 class="card__title"><?php echo esc_html($project_title ?: get_the_title()); ?></h2>
                            </div>

                            <!-- Project Button -->
                            <a class="card__btn" href="<?php the_permalink(); ?>" class="">View Project</a>
                        </div> <!-- end card__hero -->
                        
                        
                        <div class="card__summary">
                            <p><?php echo esc_html($card_summary ?: get_the_excerpt()); ?></p>
                        </div> <!-- end card__summary -->
                        
                        <div class="card__categories">
                            <!-- Display Development Category -->
                             <div class="card__category">
                                <?php if ($primary_development_category) : ?>
                                    <h3 class="card__category--heading">Category</h3>
                                    <h3 class="card__category--text"><?php echo esc_html($primary_development_category); ?></h3>
                                <?php endif; ?>
                             </div>
                           

                            <!-- Display Project Category -->
                             <div class="card__category">
                                 <?php if ($primary_project_category) : ?>
                                     <h3 class="card__category--heading">Type</h3>
                                     <h3 class="card__category--text"><?php echo esc_html($primary_project_category); ?></h3>
                                 <?php endif; ?>
                             </div>
                        </div> <!-- end card__categories -->
                        <!-- END BASE SECTIONS -->

                        <!-- BEGIN OVERLAY CONTENT -->
                        <div class="card__overlay card__overlay--role">
                            <div class="card__icon-wrapper card__icon-wrapper--role">
                                <?php if (isset($role_icons[$primary_role])) : ?>
                                    <svg class="card__icon card__icon--role">
                                        <use xlink:href="#<?php echo esc_attr($role_icons[$primary_role]); ?>"></use>
                                    </svg>
                                    <div class="card__tooltip--right">My Role: <?php echo esc_html($primary_role); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="card__icon-wrapper card__icon-wrapper--technology">
                                <?php if (isset($technology_icons[$primary_technology])) : ?>
                                    <svg class="card__icon card__icon--technology">
                                        <use xlink:href="#<?php echo esc_attr($technology_icons[$primary_technology]); ?>"></use>
                                    </svg>
                                    <div class="card__tooltip--right">Main Tech: <?php echo esc_html($primary_technology); ?></div>
                                <?php endif; ?>
                            </div>
                        </div> <!-- end card__overlay--role -->

                        <div class="card__overlay card__overlay--languages">
                            <?php foreach ([$language1, $language2, $language3] as $language) :
                                if ($language && array_key_exists($language, $language_icons)) : ?>
                                    <div class="card__icon-wrapper card__icon-wrapper--language">
                                        <svg class="card__icon card__icon--language">
                                            <use xlink:href="#<?php echo esc_attr($language_icons[$language]); ?>"></use>
                                        </svg>
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
    echo '</div>'; // end posts-container
else : 
    echo '<p>Sorry, there are no posts available.</p>';
endif;
    
// Reset post data to prevent conflicts with other loops
wp_reset_postdata();

?>