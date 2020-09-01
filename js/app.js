let sideNav = document.querySelector("#menu");
let openBtn = document.querySelector('#btn-menu-open');
let closeBtn = document.querySelector('#btn-menu-close');

openBtn.addEventListener('click', showMenu);
closeBtn.addEventListener('click', hideMenu);

function showMenu() {
    // console.log('jac');
    if (sideNav.classList.contains('hide-menu')) sideNav.classList.remove('hide-menu');
    sideNav.classList.add('show-menu');
}
function hideMenu() {
    sideNav.classList.add('hide-menu');
    if (sideNav.classList.contains('show-menu')) sideNav.classList.remove('show-menu');

}
document.addEventListener('play', function(e){
    var audios = document.getElementsByTagName('audio');
    for(var i = 0, len = audios.length; i < len;i++){
        if(audios[i] != e.target){
            audios[i].pause();
        }
    }
}, true);

$(document).ready(function(){
    // Add smooth scrolling to all links
    $("a").on('click', function(event) {
  
      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();
  
        // Store hash
        var hash = this.hash;
  
        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 800, function(){
     
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      } // End if
    });
  });