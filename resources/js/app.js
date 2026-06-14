import "./bootstrap";

let timer;
let seconds = 0;
const startBtn = document.getElementById("startBtn");
const stopBtn = document.getElementById("stopBtn");
const taskForm = document.getElementById("taskForm");

/* FOCUS */

taskForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const titleInput = document.getElementById("title");

    const response = await fetch("/tasks", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            title: titleInput.value,
        }),
    });

    const data = await response.json();

    addTaskToUI(data);

    bootstrap.Modal.getInstance(document.getElementById("taskModal")).hide();

    taskForm.reset();
});

function addTaskToUI(task) {
    const container = document.getElementById("taskContainer");

    const html = `
    <div class="cardx">
        <div class="task">

            <div class="task-title">
                ${task.title}
            </div>

            <button class="btn btn-success btn-sm startBtn"
                    data-task-id="${task.id}">
                Start
            </button>

        </div>
    </div>
    
`;

    container.insertAdjacentHTML("beforeend", html);
}

// startBtn.addEventListener("click", () => {
//     document.getElementById("focusMode").style.display = "flex";

//     seconds = 0;

//     timer = setInterval(() => {
//         seconds++;

//         let h = String(Math.floor(seconds / 3600)).padStart(2, "0");
//         let m = String(Math.floor((seconds % 3600) / 60)).padStart(2, "0");
//         let s = String(seconds % 60).padStart(2, "0");

//         document.getElementById("timer").innerText = `${h}:${m}:${s}`;
//     }, 1000);
// });

// stopBtn.addEventListener("click", () => {
//     clearInterval(timer);
//     document.getElementById("focusMode").style.display = "none";
// });
