jQuery(document).ready(function ($) {

    const regionSelect = $('#region_selected');
    const provinceSelect = $('#province_selected');
    const citySelect = $('#municipality_selected');

    function fetchData(type, code = '') {
        let url = ph_ajax.ajax_url + `?action=ph_place_api&type=${type}`;
        if (code) url += `&code=${code}`;
        return $.getJSON(url);
    }

    // --- Load Regions ---
    fetchData('regions').done(function (response) {
        const regions = response.data; // <-- use .data
        if (!Array.isArray(regions)) {
            console.error('Regions data invalid:', response);
            return;
        }

        regionSelect.html('<option value="">Region</option>');
        regions.forEach(r => {
            if (!r.psgc_code || !r.name) return;
            regionSelect.append(
                $('<option>').val(r.name).text(r.name).attr('data-code', r.psgc_code)
            );
        });

        console.log('Regions loaded:', regions);
    }).fail(function (err) {
        console.error('Failed to fetch regions:', err);
    });

    // --- On Region Change: Load Provinces ---
    regionSelect.on('change', function () {
        provinceSelect.html('<option value="">Province</option>');
        citySelect.html('<option value="">City / Municipality</option>');

        const regionCode = $(this).find(':selected').data('code');
        if (!regionCode) return;

        fetchData('provinces', regionCode).done(function (response) {
            const provinces = response.data; // <-- use .data
            if (!Array.isArray(provinces)) {
                console.error('Provinces data invalid:', response);
                return;
            }

            provinces.forEach(p => {
                provinceSelect.append(
                    $('<option>').val(p.name).text(p.name).attr('data-code', p.psgc_code)
                );
            });

            console.log('Provinces loaded:', provinces);
        }).fail(function (err) {
            console.error('Failed to fetch provinces:', err);
        });
    });

    // --- On Province Change: Load Cities ---
    provinceSelect.on('change', function () {
        citySelect.html('<option value="">City / Municipality</option>');

        const provinceCode = $(this).find(':selected').data('code');
        if (!provinceCode) return;

        fetchData('cities', provinceCode).done(function (response) {
            const cities = response.data; // <-- use .data
            if (!Array.isArray(cities)) {
                console.error('Cities data invalid:', response);
                return;
            }

            cities.forEach(c => {
                citySelect.append(
                    $('<option>').val(c.name).text(c.name)
                );
            });

            console.log('Cities loaded:', cities);
        }).fail(function (err) {
            console.error('Failed to fetch cities:', err);
        });
    });

});
