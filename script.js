// Theme Switcher

const themeBtn = document.getElementById("themeBtn");

themeBtn.addEventListener("click", () => {

document.body.classList.toggle("dark");

});

// Existing Button

const btn = document.getElementById("btn");

btn.addEventListener("click", () => {

alert("Button Clicked!");

});