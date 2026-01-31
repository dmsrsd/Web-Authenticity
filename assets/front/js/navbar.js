
  // Handle clicks for elements with data-dynamic-id attributes
//   const elements = document.querySelectorAll("[data-dynamic-id]");

//   elements.forEach((element) => {
//     const id = element.getAttribute("data-dynamic-id");

//     element.href = `/#${id}`;
//     element.id = `collapse${id}`;

//     element.addEventListener("click", () => {
//       $("#" + id).collapse("toggle");
//       $("html, body").animate(
//         {
//           scrollTop: $("#" + id + "Heading").offset().top - 87
//         },
//         1000
//       );
//     });
//   });

  // Handle clicks from different pages with URL parameters
  window.addEventListener("DOMContentLoaded", () => {
    // Parse URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const sectionId = urlParams.get("sectionId");

    // Check if a target ID is specified in the URL
    if (sectionId) {
      const targetElement = document.getElementById(sectionId);

      if (targetElement) {
        // Check if the target element should be initially open
        if (!targetElement.classList.contains("show")) {
          // Toggle the target element if it's not already open
          $("#" + sectionId).collapse("toggle");
        }

        // Scroll to the target element with an offset
        $("html, body").animate(
          {
            scrollTop: $("#" + sectionId + "Heading").offset().top - 87
          },
          1000
        );
      }
    }

    /** Add active class on navbar */
    const links = document.querySelectorAll('.nav li a');
    const fullpath = window.location.href;
    const url = window.location.pathname;
    const slug = url.substring(url.lastIndexOf('/') + 1);
    for (link of links) {
      if (slug === link.getAttribute('href')
        || url === link.getAttribute('href') || fullpath === link.getAttribute('href')
      ) {
        link.classList.add('active')
      } else {
        link.classList.remove('active')
      }
    }
    console.log(window.location.href)
});
