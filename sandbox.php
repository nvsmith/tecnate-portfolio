BACKUP...THIS WORKS SO FAR

<!-- 
This pagination system works as follows:
1. Get the current page number from the URL by using the `get_query_var('paged')` function.
- If the page number is not set, it defaults to 1.
2. Set up an array of arguments to pass to the `WP_Query` constructor. 
- This array will be used to build the SQL query that will fetch the posts.
3. Set the `post_type` argument to tell WordPress to fetch the desired post type.
4. Set the `posts_per_page` argument to tell WordPress how many posts to fetch per page.
5. Set the `paged` argument to the current page number
- This tells WordPress to fetch the posts from the correct page in the pagination. 
-->

<?php
// Create a custom query to get all the posts of type 'portfolio'
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => 10,
    'paged' => $paged
);
$the_query = new WP_Query( $args );

// Start the Loop
if( $the_query->have_posts() ) :
    echo '<div id="posts-container" class="container">';
    echo '<div id="posts-row" class="row">';

    while ( $the_query->have_posts() ) : $the_query->the_post();
?>
    
    <div class="col-md-6 col--pad"> <!-- 6/12 column layout until <992px breakpoint  -->
        <div class="post__wrapper">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
            <?php endif; ?>
           
            <h3>
                <?php the_title(); ?>
            </h3>
            
            <h4>
                <?php the_excerpt(); ?>
            </h4>


            <a href="<?php the_permalink(); ?>" class="btn">View Project</a>
        </div> <!-- end post__wrapper -->
    </div> <!-- end col-md-6 -->

<?php
    endwhile;

    echo '</div>'; // end of row

    // Pagination
    if ($the_query->max_num_pages > 1) {
        echo '<div class="row">';
            echo '<div class="col">';
                
            // Pagination links
                echo paginate_links(array(
                    // base url of the pagination links
                    'base' => get_pagenum_link(1) . '%_%',
                    // format of the pagination links
                    'format' => '?paged=%#%',
                    // text for the previous page link
                    'prev_text' => __('&larr; Previous'),
                    // text for the next page link
                    'next_text' => __('Next &rarr;'),
                    // total number of pages
                    'total' => $the_query->max_num_pages,
                    // current page number
                    'current' => max(1, get_query_var('paged')),
                ));
            
            echo '</div>'; // end of pagination col
        echo '</div>'; // end of pagination row
    }

    echo '</div>'; // end of container

else : echo '<p>Sorry, there are no posts available.</p>';

endif;
    
// Reset post data to prevent conflicts with other loops
wp_reset_postdata();
?>