// Auto-update copyright year
document.addEventListener("DOMContentLoaded", function() {
    var yearElem = document.getElementById("year");
    if(yearElem) {
        yearElem.textContent = new Date().getFullYear();
    }
});



document.addEventListener("DOMContentLoaded", function () {
  const mainImage = document.getElementById("nrhss-main-image");
  const mainLink = document.getElementById("nrhss-main-link");
  const thumbs = document.querySelectorAll(".nrhss-thumb");

  // Deduplicate images bago gumawa ng gallery array
  const uniqueUrls = new Set();
  const gallery = [];

  thumbs.forEach((thumb) => {
    const src = thumb.dataset.full;
    if (!uniqueUrls.has(src)) {
      uniqueUrls.add(src);
      gallery.push({ src: src, type: "image" });
    }
  });

  // Helper: Hanapin index ng current active image sa gallery array
  function getCurrentIndex() {
    const currentSrc = mainImage.src;
    return gallery.findIndex((item) => item.src === currentSrc);
  }

  // Open Fancybox gallery sa tamang index base sa current preview
  mainLink.addEventListener("click", function (e) {
    e.preventDefault();
    const startIndex = getCurrentIndex();
    Fancybox.show(gallery, { startIndex: startIndex >= 0 ? startIndex : 0 });
  });

  // Thumbnail click lang mag swap ng preview
  thumbs.forEach((thumb) => {
    thumb.addEventListener("click", function () {
      mainImage.src = this.dataset.full;
      thumbs.forEach((t) => t.classList.remove("active"));
      this.classList.add("active");
    });
  });

  // Scroll buttons para sa thumbnails
  const galleryWrapper = document.querySelector(".nrhss-gallery");
  const prev = document.querySelector(".thumb-prev");
  const next = document.querySelector(".thumb-next");

  prev.addEventListener("click", () => {
    galleryWrapper.scrollBy({ left: -120, behavior: "smooth" });
  });
  next.addEventListener("click", () => {
    galleryWrapper.scrollBy({ left: 120, behavior: "smooth" });
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