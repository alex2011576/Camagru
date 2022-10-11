
function myFunction() {
  var x = document.getElementById("navMenu");
  if (x.className.indexOf(" d-flex") == -1) {
    x.className = x.className.replace(" d-none", " d-flex");
  } else { 
    x.className = x.className.replace(" d-flex", " d-none");
  }
}

function toggle_by_class(class_name) {
  const boxes = document.getElementsByClassName(class_name);

  for (const box of boxes) {
      box.classList.toggle('d-none');
  }
}

function display_by_class(class_name) {
    const boxes = document.getElementsByClassName(class_name);

    for (const box of boxes) {
        box.classList.remove('d-none');
    }
}

function hide_by_class(class_name) {
    const boxes = document.getElementsByClassName(class_name);

    for (const box of boxes) {
        box.classList.add('d-none');
    }
}