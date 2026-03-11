    console.log('test');
    function openTab(event, tabName) {

        // Hide all tab content
        var tabcontent = document.getElementsByClassName("tabcontent");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Remove active class from all buttons
        var tablinks = document.getElementsByClassName("tablinks");
        for (var i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        // Show the selected tab
        document.getElementById(tabName).style.display = "block";

        // Add active class to clicked button
        evt.currentTarget.classList.add("active");
    }