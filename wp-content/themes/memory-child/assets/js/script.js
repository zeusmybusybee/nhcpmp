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
  //  LEVEL I
  const levelI = {
    "national-historical-landmark": "National Historical Landmark",
    "national-historical-site": "National Historical Site",
    "national-monument": "National Monument",
    "national-shrine": "National Shrine",
    "unesco-world-heritage-site": "UNESCO World Heritage Site",
  };

  //  LEVEL II
  const levelII = {
    "association-institution-organization": "Association/Institution/Organization",
    "buildings-structures": "Buildings/Structures",
    "heritage-house": "Heritage House",
    "heritage-zone-historic-center": "Heritage Zone / Historic Center",
    "personages": "Personages",
    "sites-events": "Sites/Events",
  };

  const $category = $("#registry_category");

  function filterCategories() {
    const selectedVal = $category.val();
    const level = $("#level_status").val();

    let activeLevel = null;
    if (level === "level-i") activeLevel = levelI;
    else if (level === "level-ii") activeLevel = levelII;


    $category.find("option").hide();
    $category.find('option[value=""]').show(); 

    if (!activeLevel) return; 

  
    $category.find("option").each(function () {
      const key = $(this).val(); // using value as key
      if (activeLevel.hasOwnProperty(key)) $(this).show();

      //  keep selected visible
      if ($(this).val() === selectedVal) $(this).show();
    });
  }

  //  SET VALUES FROM URL
  const urlParams = new URLSearchParams(window.location.search);
  const selectedCategory = urlParams.get("registry_category");
  const selectedLevel = urlParams.get("level_status");

  if (selectedCategory) $category.val(selectedCategory);
  if (selectedLevel) $("#level_status").val(selectedLevel);


  filterCategories();


  $("#level_status").on("change", filterCategories);
});

jQuery(document).ready(function ($) {
  // LEVEL I
  const levelI = {
    "bank": "Bank*",
    "battle-site-2": "Battle Site*",
    "belfry": "Belfry*",
    "buildings-structures": "Buildings/Structures*",
    "capitol-building": "Capitol Building*",
    "cemetery": "Cemetery*",
    "clubhouse": "Clubhouse*",
    "convent": "Convent",
    "declaration-marker": "Declaration Marker*",
    "fortification": "Fortification*",
    "garden": "Garden*",
    "historic-center": "Historic Center*",
    "hotel": "Hotel*",
    "house-of-worship": "House of Worship*",
    "house": "House*",
    "kampanaryo-ng-jaro": "Kampanaryo ng Jaro*",
    "lighthouse": "Lighthouse*",
    "memorial": "Memorial*",
    "monument": "Monument*",
    "nhcp-museum": "NHCP Museum*",
    "penitentiary": "Penitentiary*",
    "plaza": "Plaza*",
    "prison-cell": "Prison Cell*",
    "school": "School*",
    "site-of-important-event": "Site of an Important Event*",
    "site": "Site*",
    "university": "University*",
    "watchtower": "Watchtower*"
  };

  // LEVEL II (EDIT MO BASE SA DATA MO)
const levelII = {
  "aquarium": "Aquarium",
  "battle-site": "Battle Site",
  "beach": "Beach",
  "belfry": "Belfry",
  "biographical-marker": "Biographical Marker",
  "bridge": "Bridge",
  "capitol-building": "Capitol Building",
  "cathedral": "Cathedral",
  "cemetery": "Cemetery",
  "convent": "Convent",
  "dam": "Dam",
  "fortification": "Fortification",
  "foundation-site": "Foundation Site",
  "fountain": "Fountain",
  "gabaldon-school": "Gabaldon School",
  "gateway": "Gateway",
  "golf-course": "Golf Course",
  "group-of-houses": "Group of Houses",
  "hospital": "Hospital",
  "house": "House",
  "house-of-worship": "House of Worship",
  "lighthouse": "Lighthouse",
  "memorare": "Memorare",
  "memorial": "Memorial",
  "military-camp": "Military Camp",
  "military-structure": "Military Structure",
  "monument": "Monument",
  "museum": "Museum",
  "office-building": "Office Building",
  "plaza": "Plaza",
  "polvorin": "Polvorin",
  "post-office": "Post Office",
  "prison": "Prison",
  "private-company": "Private Company",
  "private-institution": "Private Institution",
  "ranch": "Ranch",
  "restaurant": "Restaurant",
  "retreat-house": "Retreat House",
  "ridge": "Ridge",
  "rizal-monuments": "Rizal monuments",
  "room": "Room",
  "ruins": "Ruins",
  "school": "School",
  "seminary": "Seminary",
  "simbahan-ng-canaman": "Simbahan ng Canaman",
  "site": "Site",
  "site-of-an-important-event": "Site of an Important Event",
  "tomas-pinpin": "Tomas Pinpin",
  "town-city-hall": "Town/City Hall",
  "trading-house": "Trading house",
  "train-station": "Train Station",
  "university": "University",
  "watchtower": "Watchtower"
};


function filterOptions() {
  const $type = $("#type");
  const selectedVal = $type.val();
  const level = $("#level_status").val();

  let activeLevel = null;

  if (level === "level-i") {
    activeLevel = levelI;
  } else if (level === "level-ii") {
    activeLevel = levelII;
  }

  //  STEP 1: hide all muna
  $type.find("option").hide();
  $type.find('option[value=""]').show(); // show "-Type-"

  //  kung walang level → wag magpakita ng options
  if (!activeLevel) {
    return;
  }

  //  STEP 2: show only allowed options
  $type.find("option").each(function () {
    const key = $(this).data("key");

    if (activeLevel.hasOwnProperty(key)) {
      $(this).show();
    }

    //  keep selected visible (important)
    if ($(this).val() === selectedVal) {
      $(this).show();
    }
  });
}

  //  SET VALUES FROM URL (IMPORTANT)
  const urlParams = new URLSearchParams(window.location.search);
  const selectedType = urlParams.get("labels");
  const selectedLevel = urlParams.get("level_status");

  if (selectedType) {
    $("#type").val(selectedType);
  }

  if (selectedLevel) {
    $("#level_status").val(selectedLevel);
  }

  //  INIT
  filterOptions();

  //  ON CHANGE
  $("#level_status").on("change", function () {
    filterOptions();
  });
});

jQuery(document).ready(function ($) {
  $("#show-mobile-only").html($(".show-mobile-only").html());
});
