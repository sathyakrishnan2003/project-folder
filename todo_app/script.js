const taskInput = document.getElementById("taskInput");
const addBtn = document.getElementById("addBtn");
const taskList = document.getElementById("taskList");

let tasks = JSON.parse(localStorage.getItem("tasks")) || [];

function saveTasks(){
    localStorage.setItem("tasks", JSON.stringify(tasks));
}

function displayTasks(){

    taskList.innerHTML = "";

    tasks.forEach((task,index)=>{

        const li = document.createElement("li");

        li.textContent = task.text;

        if(task.completed){
            li.classList.add("completed");
        }

        li.addEventListener("click",()=>{

            tasks[index].completed = !tasks[index].completed;

            saveTasks();

            displayTasks();

        });

        const deleteBtn = document.createElement("button");

        deleteBtn.textContent="Delete";

        deleteBtn.className="delete";

        deleteBtn.addEventListener("click",(e)=>{

            e.stopPropagation();

            tasks.splice(index,1);

            saveTasks();

            displayTasks();

        });

        li.appendChild(deleteBtn);

        taskList.appendChild(li);

    });

}

addBtn.addEventListener("click",()=>{

    const text = taskInput.value.trim();

    if(text==="") return;

    tasks.push({
        text:text,
        completed:false
    });

    saveTasks();

    displayTasks();

    taskInput.value="";

});

displayTasks();