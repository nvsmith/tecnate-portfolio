// Update flex direction & heading font size based on the width of the categories container
function toggleFlexAndFont() {
    const categories = document.querySelectorAll(".card__categories");

    categories.forEach((container) => {
        if (container.offsetWidth < 340) {
            // Set flex direction to column
            container.style.flexDirection = "column";
            // Shrink font size of category headings
            const categoryHeadings = container.querySelectorAll(
                ".card__category--heading"
            );
            categoryHeadings.forEach((heading) => {
                heading.style.fontSize = "0.6rem";
            });
        } else {
            // Revert flex direction to row
            container.style.flexDirection = "row";
            // Revert font size of category headings
            const categoryHeadings = container.querySelectorAll(
                ".card__category--heading"
            );
            categoryHeadings.forEach((heading) => {
                heading.style.fontSize = "0.8rem";
            });
        }
    });
}

// Initial call based on the current width
toggleFlexAndFont();

// Handle resizing
window.addEventListener("resize", toggleFlexAndFont);
