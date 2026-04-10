$(document).ready(function () {
  // 👉 AUTO LOAD kapag may selected region
  let selectedRegion = $("#acf-region").val();
  if (selectedRegion) {
    console.log("Auto-loading provinces for selected region:", selectedRegion);
    loadProvinces(selectedRegion);
  }

  // When Region changes
  $("#acf-region").on("change", function () {
    let region = $(this).val();
    console.log("Region changed:", region);

    $("#acf-province").html("<option>Loading...</option>");
    $("#acf-city").html("<option>Select City / Municipality</option>");

    if (!region) {
      $("#acf-province").html("<option value=''>Select Province</option>");
      $("#acf-city").html(
        "<option value=''>Select City / Municipality</option>",
      );
      return;
    }

    loadProvinces(region);
  });

  // When Province changes
  $("#acf-province").on("change", function () {
    let province = $(this).val();
    console.log("Province changed:", province);

    $("#acf-city").html("<option>Loading...</option>");

    if (!province) {
      $("#acf-city").html(
        "<option value=''>Select City / Municipality</option>",
      );
      return;
    }

    loadCities(province);
  });

  // -----------------------------
  // Helper function: Load Provinces
  // -----------------------------
  function loadProvinces(region) {
    $.ajax({
      url: acf_ajax.ajaxurl,
      type: "POST",
      data: {
        action: "acf_get_provinces",
        region_for_historic: region,
      },
      success: function (response) {
        $("#acf-province").html(response);

        // 👉 restore selected province
        let selectedProvince = $("#acf-province").data("selected");
        if (selectedProvince) {
          console.log("Restoring selected province:", selectedProvince);
          $("#acf-province").val(selectedProvince).trigger("change"); // auto load cities
        }
      },
      error: function (xhr, status, error) {
        console.error("Failed to load provinces:", status, error);
        $("#acf-province").html(
          "<option value=''>Failed to load provinces</option>",
        );
      },
    });
  }

  // -----------------------------
  // Helper function: Load Cities
  // -----------------------------
  function loadCities(province) {
    $.ajax({
      url: acf_ajax.ajaxurl,
      type: "POST",
      data: {
        action: "acf_get_cities",
        province_for_historic: province,
      },
      success: function (response) {
        $("#acf-city").html(response);

        // 👉 restore selected city
        let selectedCity = $("#acf-city").data("selected");
        if (selectedCity) {
          console.log("Restoring selected city:", selectedCity);
          $("#acf-city").val(selectedCity);
        }
      },
      error: function (xhr, status, error) {
        console.error("Failed to load cities:", status, error);
        $("#acf-city").html("<option value=''>Failed to load cities</option>");
      },
    });
  }
});
