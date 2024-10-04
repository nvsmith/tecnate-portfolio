<!-- 
See tecnate-portfolio/README.md for project details

This pagination system works as follows:
1. Get the current page number from the URL by using the `get_query_var('paged')` function.
- If the page number is not set, it defaults to 1.
2. Set up an array of arguments to pass to the `WP_Query` constructor. 
- This array will be used to build the SQL query that will fetch the posts.
3. Set the `post_type` and `posts_per_page` arguments.
4. Set the `paged` argument to the current page number
- This tells WordPress to fetch the posts from the correct page in the pagination. 
-->

<?php
// Declare the query as a global variable to use across multiple Oxygen Code Blocks
global $the_query;

// Create a custom post type query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => 10,
    'paged' => $paged
);

// Initialize a new instance of the WP_Query class and pass the query arguments into it.
// This will generate the SQL query that will be used to fetch the posts from the database.
$the_query = new WP_Query( $args );
?>
