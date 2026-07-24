// 1. Arrow Function
const greet = (name = "Guest") => `Hello, ${name}!`;
console.log(greet("Sathya"));

// 2. Addition
const add = (a, b) => a + b;
console.log(add(10, 20));

// 3. Multiplication
const multiply = (a, b) => a * b;
console.log(multiply(5, 6));

// 4. Square
const square = num => num * num;
console.log(square(8));

// 5. Even or Odd
const isEven = num => num % 2 === 0;
console.log(isEven(12));

// 6. Rest Operator
const total = (...numbers) =>
    numbers.reduce((sum, num) => sum + num, 0);
console.log(total(10, 20, 30, 40));

// 7. Spread Operator
const numbers = [1, 2, 3];
const newNumbers = [...numbers, 4, 5];
console.log(newNumbers);

// 8. Object Function
const student = {
    name: "Sathya",
    course: "MCA"
};

const showStudent = ({ name, course }) =>
    console.log(`${name} - ${course}`);

showStudent(student);

// 9. Promise Example
const promiseExample = new Promise((resolve, reject) => {
    const success = true;

    if (success)
        resolve("Promise Resolved!");
    else
        reject("Promise Rejected!");
});

promiseExample
    .then(result => console.log(result))
    .catch(error => console.log(error));

// 10. Async / Await + Fetch API
async function getUsers() {
    try {

        const response = await fetch("https://jsonplaceholder.typicode.com/users");

        const users = await response.json();

        console.log(users);

    } catch (error) {

        console.log("Error:", error);

    }
}

getUsers();