<!-- See tecnate-portfolio/README.md for project details & code explanation -->

<?php
// Initialize the custom post type query for portfolio items
global $portfolio_query;

// Set up pagination and post type query arguments to pass to the WP_Query constructor
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => 10,
    'paged' => $paged
);

// Initialize a new instance of the WP_Query class for the SQL database query
$portfolio_query = new WP_Query( $args );

// Initialize icon mappings
global $role_icons, $technology_icons, $language_icons;

// Icon Mapping: 'ACF/SCF value (NOT label)' => 'Icon Name' 
// Note: Icon Name = 'SVG Set Name' + '(SVG symbol ID)'

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
];

?>
