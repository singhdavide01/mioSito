const input = document.getElementById("todo-input");
const addBtn = document.getElementById("add-btn");
const todoList = document.getElementById("todo-list");

addBtn.addEventListener("click", addTodo);
todoList.addEventListener("click", removeTodo);

function addTodo() {
    const task = input.value.trim();
    if (task === "") return;

    const li = document.createElement("li");
    li.innerHTML = `${task} <button>X</button>`;
    todoList.appendChild(li);
    input.value = "";
}

function removeTodo(e) {
    if (e.target.tagName === "BUTTON") {
        const li = e.target.parentElement;
        todoList.removeChild(li);
    }
}
