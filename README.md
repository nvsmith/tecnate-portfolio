<a id="readme-top"></a>

# OWS Portfolio 2.0

<a href="https://outpostwebstudio.com/" target="_blank" rel="author">Nate @ Outpost Web Studio</a> | Last Updated: 28 MAY 2025

## About The Project

This is a highly customized portfolio archive template for WordPress, built with **Oxygen**, **PHP**, **JavaScript**, and **CSS**. It implements extensive front-end and back-end integration:

-   **Custom WP_Query** with pagination

    -   Retrieves “portfolio” CPT entries in reverse‐chronological order
    -   Uses `paginate_links()` and dynamic page-URL placeholders for both top and bottom pagers

-   **Advanced Custom Fields (ACF/SCF) integration**

    -   Pulls in project-specific data (title, hero image, summary, categories, languages) via `get_fields()`
    -   Uses a helper (`retrieve_field_object()`) to resolve select-field values and labels

-   **Icon mapping & SVG sprites**

    -   Maps roles, technologies, and languages to SVG symbol IDs
    -   Renders contextual overlays with tooltips (role, tech, languages) for each card

-   **Responsive grid & BEM-based styling**

    -   Wraps items in Bootstrap/Oxygen containers and rows (`.container`, `.row`, `.col-md-6`)
    -   Uses BEM classnames (`card__hero`, `card__overlay--languages`, etc.) for maintainable, modular CSS

-   **Oxygen Builder compatibility**

    -   Can be dropped into an Oxygen template’s Code Block
    -   Leverages Oxygen’s UI and HTML elements while keeping custom markup clean

-   **Progressive enhancement**

    -   Graceful fallback if no portfolio items exist
    -   Separation of markup (PHP), behavior (JavaScript/pagination links), and presentation (CSS/BEM)

This setup presents a fully‐featured, paginated portfolio archive that’s 100% theme-agnostic, easy to extend, and optimized for maintainability.

<div align="center">

![screenshot1](screenshots/screenshot1.png "before")

<!-- ![screenshot2](screenshots/screenshot2.png "after") -->

</div>

### Built With

-   HTML
-   CSS
-   PHP
-   JavaScript
-   WordPress

<!-- GETTING STARTED -->

## Getting Started

This portfolio was crafted for Oxygen/WordPress.

### Prerequisites

-   WordPress installation
    -   Oxygen plugin
    -   ACF/SCF plugin (from WP Engine)
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
4. Create the custom post type (CPT UI) and custom post fields (ACF/SCF).
5. Populate the custom post fields with desired data.
6. All final development work should be imported into Oxygen directly. See the **Usage** section below for details.

## Development

I needed a customized, completely controllable design and functionality for my portfolio, rather than relying on preset style/code. But I still wanted everything to remain in my Oxygen Builder to keep my website code consolidated under a single source.

### Setting Up Your Environment

1. Create an Archive Template in Oxygen and apply it to your custom post type.
2. Within the Oxygen Builder, add a `Code Block` element to house all the custom PHP/CSS code for the post loop that you develop.
    1. Note: Using Oxygen, I created (and then hid) a separate container to initially load all my custom icons to the page. I found this was the most reliable way that I could get theses icons to render later within my custom Code Blocks.
3. Develop all code in a text editor of your choice.
4. Copy over the code into your Oxygen code block and save to render.
    1. Make sure the front-end looks and behaves as expected.
    2. After all testing, minify the final code within your Code Block for improved performance.

### The Posts Section

In Oxygen, the posts section is comprised of two main containers:

1. `Icon Container`: I hid this entire container, but it houses all the custom icons that are used for the archive. This was the most reliable way I found to get these icons to render properly, by adding them directly to the page via the Oxygen UI.
2. `Posts Code Block`: This is where all the magic happens. All the logic to render The Loop, Pagination, and custom JavaScript effects are housed here. All development was done locally before being copied into Oxygen:
    1. Custom post type query, pagination, The Loop, and rendering logic: [portfolio-posts.php](portfolio-posts.php)
    2. All styles that control this archive and card design: [portfolio-archive.css](portfolio-archive.css)
    3. Category columns vs. row toggle depending on the card size: [categories-flex-toggle.js](categories-flex-toggle.js)

#### Pagination For A Custom Post Type

Getting the pagination links (specifically, the top set) to work properly was very tricky; early attempts to use the links kept resulting in a `404 Error`. But in the end I found a solution:

-   Rather than setting the number of posts via the custom query in your code, use the **WP Dashboard > Settings > Reading** controls instead.
-   Add an Oxygen Easy Posts element in the Posts Section (I didn’t set up any custom queries, I just allowed the defaults since this archive is set to my desired ‘portfolio’ post type anyway).
-   On the front-end, use the default pagination links that render from the Easy Posts element and note the URL format. Use this format into the pagination arguments array in [portfolio-posts.php](portfolio-posts.php).
    -   It should look something like `'format'    => '/page/%#%/'`
-   Go to **WP Dashboard > Settings > Permalinks**. Choose any different permalinks structure and save, then revert back to the "Post name" structure and save again to refresh the links in WordPress.
-   After testing that the custom pagination works, you can delete the Easy Posts element in Oxygen.

#### Custom Icons & Tooltips

-   ACF/SCF Choice values can be viewed/edited from the **WP Dashboard > ACF/SCF** menu.
    -   In ACF/SCF, if a choice selection is defined as a `value : label`, you must use the `get_field_object(fieldName)` function rather than the typical `get_field(fieldName)` function in order to properly define and separate the value and label.
    -   It is always the value, not the label, that gets mapped to the icon.
-   For icon mapping in PHP, the pattern is: `'ACF Value' => 'Icon Name'`.
    -   For the Icon Name, the pattern is: `'SVG Icon Set Name` + `SVG Symbol ID'` (no spaces).
        -   My custom icons are uploaded into Oxygen as an SVG set named "portfolio". So for my "Git" icon, the ACF/SCF icon mapping in PHP looks like `'Git' => 'portfoliogit'`.
-   Dev File - SVG icon set: [symbol-defs.svg](symbol-defs.svg).
    -   My design implements custom tooltips. As such, to disable browsers' native tooltips, I removed all `<title>` elements directly from my SVG file before importing into Oxygen.
-   Dev File - SVG icon set backup: [symbol-defs.svg.bak](symbol-defs.svg.bak).
    -   This original file backup retains the `<title>` elements for all icons.

## Roadmap

A new custom portfolio post template to complement the RPG Card Style of the portfolio archive.

## License

Distributed under the [MIT License](https://choosealicense.com/licenses/mit/).

## Contact

Nate: [Website](https://outpostwebstudio.com/lets-talk-shop/) | [GitHub](https://github.com/nvsmith)

## Acknowledgments

-   [Best README Template](https://github.com/othneildrew/Best-README-Template/tree/master)

<p align="right">(<a href="#readme-top">back to top</a>)</p>
