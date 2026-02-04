// Auto-update copyright year
document.addEventListener("DOMContentLoaded", function() {
    var yearElem = document.getElementById("year");
    if(yearElem) {
        yearElem.textContent = new Date().getFullYear();
    }
});
