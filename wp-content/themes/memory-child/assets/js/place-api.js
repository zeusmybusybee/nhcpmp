document.addEventListener('DOMContentLoaded', function () {

  const proxy = '/nhcpmp/wp-content/themes/memory-child/ph-proxy.php';

  const regionSel = document.getElementById('region');
  const provinceSel = document.getElementById('province');
  const citySel = document.getElementById('city');

  if (!regionSel) return;

  const params = new URLSearchParams(window.location.search);
  const urlRegion = params.get('region');
  const urlProvince = params.get('province');
  const urlCity = params.get('city');

  // ================= LOAD REGIONS =================
  fetch(`${proxy}?endpoint=regions`)
    .then(r => r.json())
    .then(res => {

      res.data.forEach(r => {
        regionSel.innerHTML += `<option value="${r.psgc_code}">${r.name}</option>`;
      });

      if (urlRegion) {
        regionSel.value = urlRegion;
        loadProvinces(urlRegion);
      }
    });

  // ================= LOAD PROVINCES =================
  function loadProvinces(regionCode) {

    provinceSel.innerHTML = '<option value="">Select Province</option>';
    provinceSel.disabled = true;
    citySel.innerHTML = '<option value="">Select City/Municipality</option>';
    citySel.disabled = true;

    fetch(`${proxy}?endpoint=provinces`)
      .then(r => r.json())
      .then(res => {

        res.data
          .filter(p => p.region_code === regionCode)
          .forEach(p => {
            provinceSel.innerHTML += `<option value="${p.psgc_code}">${p.name}</option>`;
          });

        provinceSel.disabled = false;

        if (urlProvince) {
          provinceSel.value = urlProvince;
          loadCities(urlProvince);
        }
      });
  }

  // ================= LOAD CITIES =================
  function loadCities(provinceCode) {

    citySel.innerHTML = '<option value="">Select City/Municipality</option>';
    citySel.disabled = true;

    fetch(`${proxy}?endpoint=cities`)
      .then(r => r.json())
      .then(res => {

        res.data
          .filter(c => c.province_code === provinceCode)
          .forEach(c => {
            citySel.innerHTML += `<option value="${c.psgc_code}">${c.name}</option>`;
          });

        citySel.disabled = false;

        if (urlCity) {
          citySel.value = urlCity;
        }
      });
  }

  // ================= USER INTERACTION (NO AUTO RELOAD) =================
  regionSel.addEventListener('change', function () {
    if (this.value) {
      loadProvinces(this.value);
    } else {
      provinceSel.innerHTML = '<option value="">Select Province</option>';
      provinceSel.disabled = true;
      citySel.innerHTML = '<option value="">Select City/Municipality</option>';
      citySel.disabled = true;
    }
  });

  provinceSel.addEventListener('change', function () {
    if (this.value) {
      loadCities(this.value);
    } else {
      citySel.innerHTML = '<option value="">Select City/Municipality</option>';
      citySel.disabled = true;
    }
  });

});
