<?php
global $portfolio_query; // Access the query initialized in the `global-query.php` file

if ($portfolio_query->max_num_pages > 1) {
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
                'total' => $portfolio_query->max_num_pages,
                // current page number
                'current' => max(1, get_query_var('paged')),
            ));
        
        echo '</div>'; // end of pagination col
    echo '</div>'; // end of pagination row
}
?>