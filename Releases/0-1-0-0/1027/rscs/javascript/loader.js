document.body.onload = function(){
    setTimeout(function() {
        var preloader = document.getElementById('loader');
        if( !preloader.classList.contains('done') )
        {
            preloader.classList.add('done');
        }

        // Einblenden der Elemente "topnavbar" und "playercontrolbar"
        var topNavbar = document.getElementById('topnavbar');
        var playerControlBar = document.getElementById('playercontrolbar');

        if (topNavbar && playerControlBar) {
            topNavbar.style.visibility = 'visible';
            topNavbar.style.display = 'block'; // Element einblenden und Platz einnehmen
            playerControlBar.style.visibility = 'visible';
            playerControlBar.style.display = 'block'; // Element einblenden und Platz einnehmen
        }
    }, 1000);
}
