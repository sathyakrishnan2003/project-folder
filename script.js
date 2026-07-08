// ==============================
// JavaScript ES6+ Basics
// Week 1 - Day 3
// ==============================

// Arrow Function + Template Literal
const greet = (name) => `Hello, ${name}! Welcome to JavaScript ES6+.`;

// Object Destructuring
const student = {
    name: "Sathya",
    course: "MCA",
    year: "2nd Year"
};

const { name, course, year } = student;

console.log("Name:", name);
console.log("Course:", course);
console.log("Year:", year);

// Array
const numbers = [10, 20, 30, 40, 50];

// map()
const doubled = numbers.map(num => num * 2);
console.log("Doubled:", doubled);

// filter()
const greaterThan25 = numbers.filter(num => num > 25);
console.log("Greater Than 25:", greaterThan25);

// reduce()
const total = numbers.reduce((sum, num) => sum + num, 0);
console.log("Total:", total);

// Array Destructuring
const colors = ["Red", "Green", "Blue"];

const [firstColor, secondColor, thirdColor] = colors;

console.log("First Color:", firstColor);
console.log("Second Color:", secondColor);
console.log("Third Color:", thirdColor);

// Event Listener
const button = document.getElementById("btn");

button.addEventListener("click", () => {
    alert(greet(name));

    button.textContent = "Clicked!";
    button.style.backgroundColor = "green";
});