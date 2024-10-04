<a id="readme-top"></a>

# Tecnate Portfolio

### Version 2.0

<a href="https://tecnate.dev" target="_blank" rel="author">Tecnate</a> | Last Updated: 2024.10.03

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

-   A custom post type and custom fields.
-   A custom post type query, declared globally.
-   The `WP_Query` constructor and **The Loop** for WordPress.
-   Arrays.
-   Pagination.
-   Integration with my customized Bootstrap-inspired layout and stylesheets.

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
    -   ACF plugin
    -   CPTUI plugin
-   CSS stylesheets:
    -   Customized Bootstrap-inspired layout.
    -   Designs and text styles.

### Installation

1. Install WordPress and the plugins listed above.
2. Add the customized stylesheets.
3. Create the custom post type and post fields.
4. Populate the custom post type fields with data as needed.
5. All final development work should be done (or imported) into Oxygen directly. See the **Usage** section below for details.

<!-- USAGE EXAMPLES -->

## Usage

I needed a customized, completely controllable design and functionality for my portfolio, rather than relying on preset style/code. But I still wanted everything to remain in my Oxygen Builder to keep my website code consolidated under a single source.

So here's how to do it:

1. Develop all code in a text editor of your choice.
2. Copy over the final code into Oxygen:

-   1st Code Block: Initializes the custom query globally for the custom post type (`global-query.php`).
    -   Do this in order to use pagination anywhere in the **posts** page section.
    -   For this design, portfolio page navigation is going to display before AND after the posts render from The Loop.
-   2nd Code Block: Uses the query in the pagination block before the posts render (`pagination.php`).
-   3rd Code Block: Uses the query in the posts loop (`posts.php`).
-   4th Code Block: Uses the query in the pagination block after the posts render (`pagination.php`).

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
