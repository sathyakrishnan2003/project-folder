const question = document.getElementById("question");
const options = document.getElementById("options");
const nextBtn = document.getElementById("nextBtn");

let currentQuestion = null;

async function loadQuestion() {

    const response = await fetch("https://opentdb.com/api.php?amount=1&type=multiple");

    const data = await response.json();

    currentQuestion = data.results[0];

    question.innerHTML = currentQuestion.question;

    options.innerHTML = "";

    let answers = [...currentQuestion.incorrect_answers];

    answers.push(currentQuestion.correct_answer);

    answers.sort(() => Math.random() - 0.5);

    answers.forEach(answer => {

        const btn = document.createElement("button");

        btn.innerHTML = answer;

        btn.onclick = () => {

            if (answer === currentQuestion.correct_answer) {

                alert("Correct!");

            } else {

                alert("Wrong Answer!");

            }

        };

        options.appendChild(btn);

    });

}

nextBtn.addEventListener("click", loadQuestion);

loadQuestion();