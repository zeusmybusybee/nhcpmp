document.addEventListener('DOMContentLoaded', function () {

  const proxy = '/nhcpmp/wp-content/themes/memory-child/ph-proxy.php';

  const regionSel = document.querySelector('select[name="region"]');
  const provinceSel = document.querySelector('select[name="province"]');
  const citySel = document.querySelector('select[name="city"]');

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

    Promise.all([
      fetch(`${proxy}?endpoint=cities`).then(r => r.json()),
      fetch(`${proxy}?endpoint=municipalities`).then(r => r.json())
    ])
      .then(([citiesRes, munRes]) => {

        const combined = [
          ...citiesRes.data,
          ...munRes.data
        ];

        combined
          .filter(loc => loc.province_code === provinceCode)
          .forEach(loc => {
            citySel.innerHTML += `<option value="${loc.psgc_code}">${loc.name}</option>`;
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
