<a id="readme-top"></a>

# Tecnate Portfolio

### Version 2.0

<a href="https://tecnate.dev" target="_blank" rel="author">Tecnate</a> | Last Updated: 08 Nov 2024

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
-   JavaScript
-   WordPress

<!-- GETTING STARTED -->

## Getting Started

This portfolio was crafted for WordPress.

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

### The Posts Section

In Oxygen, the posts section is comprised of two main containers:

1. Icon container. I hid this entire container, but it houses all the custom icons that are used throughout the archive. This was the most reliable way I found to get these icons to render properly, by adding them directly to the page via Oxygen so they can be used throughout the archive.
2. Posts Code Block. This is where all the magic happens. All the logic to render The Loop, Pagination, and custom JavaScript effects are housed here. All development was done locally before being copied into Oxygen:
    1. Custom post type query, pagination, The Loop, and rendering logic: [portfolio-posts.php](portfolio-posts.php)
    2. All styles that control this archive and card design: [portfolio-archive.css](portfolio-archive.css)
    3. Category columns vs. row toggle depending on the card size: [categories-flex-toggle.js](categories-flex-toggle.js)

#### Pagination For A Custom Post Type

Getting the pagination links to work properly was very tricky; early attempts to use the links kept resulting in a `404 Error`. But in the end I found a solution, so here's what I had to do to get things to work:

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
-   For the Icon Name, the pattern is: `'(SVG Icon Set Name)` + `(SVG Symbol ID)'`.
    -   My custom icons are uploaded into Oxygen as an SVG set named "portfolio". So for my "Git" icon, the ACF/SCF icon mapping in PHP looks like `'Git' => 'portfoliogit'`.
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
