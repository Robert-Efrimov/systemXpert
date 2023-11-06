var menuIcon = document.querySelector('.menu-icon');
var menu = document.querySelector('.menu');

menuIcon.addEventListener('click', function() {
  menu.classList.toggle('active');
});