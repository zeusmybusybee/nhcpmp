(function($){

    acf.add_action('ready', function(){

        const region = $('select[name="acf[field_698be9c75887e]"]');
        const province = $('select[name="acf[field_698be9e358880]"]');
        const city = $('select[name="acf[field_698be9d15887f]"]');

        const proxy = acfLocation.proxy;

        const savedRegion = region.val();
        const savedProvince = province.val();
        const savedCity = city.val();

        // LOAD REGIONS
        fetch(`${proxy}?endpoint=regions`)
        .then(r => r.json())
        .then(res => {

            region.html('<option value="">Select Region</option>');

            res.data.forEach(r => {
                region.append(`<option value="${r.psgc_code}">${r.name}</option>`);
            });

            if(savedRegion){
                region.val(savedRegion).trigger('change');
            }
        });

        // REGION -> PROVINCE
        region.on('change', function(){

            province.html('<option value="">Loading...</option>');
            city.html('<option value="">Select City</option>');

            fetch(`${proxy}?endpoint=provinces`)
            .then(r => r.json())
            .then(res => {

                province.html('<option value="">Select Province</option>');

                res.data
                .filter(p => p.region_code === region.val())
                .forEach(p => {
                    province.append(`<option value="${p.psgc_code}">${p.name}</option>`);
                });

                if(savedProvince){
                    province.val(savedProvince).trigger('change');
                }
            });
        });

        // PROVINCE -> CITY
        province.on('change', function(){

            city.html('<option value="">Loading...</option>');

            fetch(`${proxy}?endpoint=cities`)
            .then(r => r.json())
            .then(res => {

                city.html('<option value="">Select City</option>');

                res.data
                .filter(c => c.province_code === province.val())
                .forEach(c => {
                    city.append(`<option value="${c.psgc_code}">${c.name}</option>`);
                });

                if(savedCity){
                    city.val(savedCity);
                }
            });
        });

    });

})(jQuery);
