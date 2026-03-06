// Auto-update copyright year
document.addEventListener("DOMContentLoaded", function() {
    var yearElem = document.getElementById("year");
    if(yearElem) {
        yearElem.textContent = new Date().getFullYear();
    }
});



document.addEventListener("DOMContentLoaded", function () {
    const mainImage = document.getElementById("nrhss-main-image");
    const thumbs = document.querySelectorAll(".nrhss-thumb");

    thumbs.forEach(thumb => {
        thumb.addEventListener("click", function () {

            // Swap image
            mainImage.style.opacity = 0;
            setTimeout(() => {
                mainImage.src = this.dataset.full;
                mainImage.style.opacity = 1;
            }, 150);

            // Active state
            thumbs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");
        });
    });
});

jQuery(document).ready(function ($) {
  let currentIndex = 0;
  const visibleCount = 3;
  const thumbHeight = 100; // 90px + 10px gap
  const $gallery = $(".nrhss-gallery");
  const totalThumbs = $(".nrhss-thumb").length;

  $(".thumb-next").click(function () {
    if (currentIndex < totalThumbs - visibleCount) {
      currentIndex++;
      $gallery.animate(
        {
          scrollTop: currentIndex * thumbHeight,
        },
        200,
      );
    }
  });

  $(".thumb-prev").click(function () {
    if (currentIndex > 0) {
      currentIndex--;
      $gallery.animate(
        {
          scrollTop: currentIndex * thumbHeight,
        },
        200,
      );
    }
  });
});

  jQuery(document).ready(function ($) {
    $(".collections-dropdown").on("change", function () {
      var url = $(this).val();
      if (url) {
        window.location.href = url;
      }
    });
  });


  
jQuery(document).ready(function ($) {
  $(".scroll-next").click(function (e) {
    e.preventDefault();

    $("html, body").animate(
      {
        scrollTop: $("#next-section").offset().top,
      },
      800,
    );
  });
});


  jQuery(document).ready(function ($) {
    var filters = $(".applied-filters");

    if (filters.length) {
      filters.prependTo("#applied-filters-container");
    }
  });