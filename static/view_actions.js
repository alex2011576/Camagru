
function myFunction() {
    var x = document.getElementById("navMenu");
    if (x.className.indexOf(" d-flex") == -1) {
      x.className = x.className.replace(" d-none", " d-flex");
    } else { 
      x.className = x.className.replace(" d-flex", " d-none");
    }
  }