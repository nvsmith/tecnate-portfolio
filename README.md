<a id="readme-top"></a>

# Tecnate Portfolio

### Version 2.0

<a href="https://tecnate.dev" target="_blank" rel="author">Tecnate</a> | Last Updated: 29 Oct 2024

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

This is a newly designed portfolio for <a href="https://tecnate.dev/portfolio" target="_blank" rel="author">Tecnate</a>, customized specifically for use with the Oxygen Builder in WordPress. The project utilizes:

-   Custom: post type, fields, post type query, archive, icons, and tooltips.
-   Globablly-scoped variables.
-   Icon mapping via associative arrays.
-   The `WP_Query` constructor class and **The Loop** for WordPress.
-   Pagination.
-   Integration with my customized Bootstrap-inspired layout and stylesheets.
-   Responsive design.

<!-- <div align="center">

![screenshot1](screenshots/screenshot1.png "before")
![screenshot2](screenshots/screenshot2.png "after")

</div> -->

### Built With

-   HTML
-   CSS
-   PHP
-   WordPress

<!-- GETTING STARTED -->

## Getting Started

This portfolio was crafted for WordPress.

### Prerequisites

-   WordPress installation
    -   Oxygen plugin
    -   ACF/SCF plugin (WP Engine)
    -   CPTUI plugin
-   CSS stylesheets:
    -   Customized Bootstrap-inspired layout.
    -   Designs and text styles.
    -   Custom Portfolio Archive
-   Custom SVG Icon Set

### Installation

1. Install WordPress and the plugins listed above.
2. Add the customized stylesheets.
3. Import a single SVG file (defining all desired custom icon symbols) directly into Oxygen.
4. Create the custom post type (CPTUI) and custom post fields (ACF/SCF).
5. Populate the custom post fields with desired data.
6. All final development work should be imported into Oxygen directly. See the **Usage** section below for details.

<!-- USAGE EXAMPLES -->

## Usage

I needed a customized, completely controllable design and functionality for my portfolio, rather than relying on preset style/code. But I still wanted everything to remain in my Oxygen Builder to keep my website code consolidated under a single source.

So here's how to do it:

1. Create an Archive Template in Oxygen and apply it to your custom post type.
2. Within the Oxygen Builder, add a Code Block element to house all the custom PHP/CSS code for the post loop that you develop.
    1. Note: Using Oxygen, I created (and then hid) a separate container to initially load all my custom icons to the page. I found this was the most reliable way that I could get theses icons to render later within my custom Code Blocks.
3. Develop all code in a text editor of your choice.
4. Copy over the code into your Oxygen code block and save to render.
    1. Make sure the front-end looks and behaves as expected.
    2. After all testing, minify the final code within your Code Block for improved performance.

### Code Blocks in Oxygen

1. Global Queries Code Block: Initializes custom queries globally, including for the custom post type. See the _Global Queries_ section below for notes about how this code works.
    - Declare global variables in order to use pagination and custom portfolio icons anywhere in the **posts** page section. Otherwise, The Loop will get very messy!
    - Dev file: [global-queries.php](global-queries.php)
2. Top Pagination Code Block: Uses the post-type query in the pagination block before the posts render.
    - Dev file: [pagination.php](pagination.php)
3. Posts Code Block: Uses the global queries defined in the first code block to execute The Loop and render portfolio items and their custom icons and tooltips. This block houses all the CSS for the portfolio cards as well.
    - Dev file: [portfolio-posts.php](portfolio-posts.php).
    - Dev file: [portfolio-archive.css](portfolio-archive.css).
4. Bottom Pagination Code Block: Uses the post-type query in the pagination block after the posts render. This reuses the same code as the Top Pagination (for now).
    - Dev file: [pagination.php](pagination.php)

### Global Queries: Custom Post, Pagination, & Icons

#### Custom Post Query & Pagination System

```php
// Get current page number from URL, or default to 1 if not set
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Set up an array of query arguments for the custom post type
// Set 'paged' to the current page number to tell WordPress to fetch the posts from the correct page in the pagination.
$args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => 10,
    'paged' => $paged
);

// Pass the query arguments into a new instance of the WP_Query constructor class.
// This builds the SQL query that fetches posts from the database.
$portfolio_query = new WP_Query( $args );
```

#### Custom Icons & Tooltips

-   ACF/SCF Choice values can be viewed/edited from the **WP Dashboard > ACF/SCF** menu.
    -   In ACF/SCF, if a choice selection is defined as a `value : label`, you must use the `get_field_object(fieldName)` function rather than the typical `get_field(fieldName)` function in order to properly define and separate the value and label.
    -   It is always the value, not the label, that gets mapped to the icon.
-   For icon mapping in PHP, the pattern is: `'ACF Value' => 'Icon Name'`.
-   For the Icon Name, the pattern is: `'(SVG Icon Set Name)` + `(SVG Symbol ID)'`.
    -   My custom icons are uploaded into Oxygen as an SVG set named "portfolio".
    -   Example: for the "Git" icon, the ACF/SCF icon mapping in PHP would look like `'Git' => 'portfoliogit'` .
-   Dev File (SVG icon set): [symbol-defs.svg](symbol-defs.svg).
    -   My design implements custom tooltips. As such, to disable browsers' native tooltips, I removed all `<title>` elements directly from my SVG file before importing into Oxygen.
-   Dev File (SVG icon set backup): [symbol-defs.svg.bak](symbol-defs.svg.bak).
    -   This original file backup retains the `<title>` elements for all icons.

<!-- ROADMAP -->

## Roadmap

TBD

<!-- CONTRIBUTING -->

## Contributing

This is a customized portfolio design built specifically with the WordPress/Oxygen framework in mind. I'm not accepting code contributions for this project at this time, however I'm always open to suggestions.

<!-- LICENSE -->

## License

Distributed under the [MIT License](https://choosealicense.com/licenses/mit/).

<!-- CONTACT -->

## Contact

Nate: [Website](https://tecnate.dev/) | [GitHub](https://github.com/nvsmith) | [Gravatar](https://gravatar.com/nvsmith435)

<!-- ACKNOWLEDGMENTS -->

## Acknowledgments

#### README Template

-   [Best README Template](https://github.com/othneildrew/Best-README-Template/tree/master)

<p align="right">(<a href="#readme-top">back to top</a>)</p>
