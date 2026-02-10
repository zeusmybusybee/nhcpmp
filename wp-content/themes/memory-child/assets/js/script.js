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

