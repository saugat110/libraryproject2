// Get the current URL
var currentUrl = window.location.href;

// Get all the links in the sidebar
var links = document.querySelectorAll('.sidebar a');

// Loop through the links and check if the href matches the current URL
for (var i = 0; i < links.length; i++) {
  var link = links[i];

  if (link.href === currentUrl) {
    // Add the "active" class to the link
    link.classList.add('active');
  }
}
