//ALT LAB STUFF

// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("wrapper-navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop+60;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

//make videos full size no matter what
var videos = document.querySelectorAll('iframe[src^="https://www.youtube.com/"], iframe[src^="https://player.vimeo.com"], iframe[src^="https://www.youtube-nocookie.com/"]'); //get video iframes

for (var i = 0; i < videos.length; i++) {
    var el = videos.item(i);      
      var wrapper = document.createElement('div'); //create wrapper 
      wrapper.classList.add("video-responsive"); //give wrapper the class      
      el.parentNode.insertBefore(wrapper, el); //insert wrapper      
      wrapper.appendChild(el); // move video into wrapper
}

