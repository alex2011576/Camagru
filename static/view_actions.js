
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

var my_atoi = function(str) {
  var i = 0;
  var sign = 1;
  var res = 0;
  var INT_MAX = 2147483647;
  var INT_MIN = - INT_MAX - 1;

  while (str[i] === ' ') i++;

  if (str[i] === '+' || str[i] === '-') {
    sign = str[i] === '+' ? 1 : -1;
    i++;
  }

  while (str[i] >= '0' && str[i] <= '9') {
    res = (res * 10) + (str[i] - 0);
    if (sign === 1 && res > INT_MAX) return INT_MAX;
    if (sign === -1 && res > INT_MAX + 1) return INT_MIN;
    i++;
  }

  return res * sign;
};