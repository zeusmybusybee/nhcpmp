// Auto-update copyright year
document.addEventListener("DOMContentLoaded", function () {
  var yearElem = document.getElementById("year");
  if (yearElem) {
    yearElem.textContent = new Date().getFullYear();
  }
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

jQuery(document).ready(function ($) {
  // hide all options except first
  $("#registry_category option:not(:first)").hide();

  $("#level_status").change(function () {
    let level = $(this).val();

    let levelI = [
      "national-historical-landmark",
      "national-historical-site",
      "national-monument",
      "national-shrine",
      "unesco-world-heritage-site",
    ];

    let levelII = [
      "association-institution-organization",
      "buildings-structures",
      "heritage-house",
      "heritage-zone-historic-center",
      "personages",
      "sites-events",
    ];

    // hide all first
    $("#registry_category option:not(:first)").hide();

    if (level === "level-i") {
      levelI.forEach(function (slug) {
        $('#registry_category option[value="' + slug + '"]').show();
      });
    }

    if (level === "level-ii") {
      levelII.forEach(function (slug) {
        $('#registry_category option[value="' + slug + '"]').show();
      });
    }
  });
});
 jQuery(document).ready(function ($) {
   // TYPES per level
   let levelI_types = [
     "Battle Site",
     "Fortification",
     "Historic Center",
     "Monument",
     "NHCP Museum",
     "Site of an Important Event",
     "Site",
     "Belfry",
     "Buildings/Structures",
     "Capitol Building",
     "Cemetery",
     "Clubhouse",
     "Convent",
     "Declaration marker",
     "Garden",
     "Hotel",
     "House of Worship",
     "House",
     "Kampanaryo ng Jaro",
     "Lighthouse",
     "Memorial",
     "Penitentiary",
     "Plaza",
     "Prison Cell",
     "School",
     "University",
     "Watchtower",
   ];

   let levelII_types = [
     "Battle Site",
     "Fortification",
     "Historic Center",
     "Monument",
     "NHCP Museum",
     "Site of an Important Event",
     "Site",
     "Belfry",
     "Buildings/Structures",
     "Capitol Building",
     "Cemetery",
     "Clubhouse",
     "Convent",
     "Declaration marker",
     "Garden",
     "Hotel",
     "House of Worship",
     "House",
     "Kampanaryo ng Jaro",
     "Lighthouse",
     "Memorial",
     "Penitentiary",
     "Plaza",
     "Prison Cell",
     "School",
     "University",
     "Watchtower",
   ];

   // initially hide all except first
   $("#type option:not(:first)").hide();

   $("#level_status").change(function () {
     let level = $(this).val();

     // hide all first
     $("#type option:not(:first)").hide();

     if (level === "level-i") {
       levelI_types.forEach(function (val) {
         $('#type option[value="' + val + '"]').show();
       });
     }

     if (level === "level-ii") {
       levelII_types.forEach(function (val) {
         $('#type option[value="' + val + '"]').show();
       });
     }
   });
 });
jQuery(document).ready(function ($) {
  $("#show-mobile-only").html($(".show-mobile-only").html());
});
