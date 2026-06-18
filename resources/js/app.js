import "./bootstrap";

const startBtn = document.getElementById("startBtn");
const stopBtn = document.getElementById("stopBtn");
const taskForm = document.getElementById("taskForm");

/* FOCUS */

// create task
taskForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const titleInput = document.getElementById("title");

    if (!titleInput.value.trim()) {
        return;
    }

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

// Insert task into UI
function addTaskToUI(task) {
    const container = document.getElementById("taskContainer");

    const html = `
    <div class="cardx">
        <div class="task">

            <div class="task-title">
                ${task.title}
            </div>

            <button class="btn btn-success btn-sm startBtn"
                    data-task-id="${task.id}"
                    data-task-title="${task.title}">
                Start
            </button>

        </div>
    </div>
    
`;

    container.insertAdjacentHTML("beforeend", html);
}

// timer function

let startTime = null;
let timerInterval = null;

function updateTimer() {
    const now = Date.now();
    const elapsed = Math.floor((now - startTime) / 1000);

    const h = String(Math.floor(elapsed / 3600)).padStart(2, "0");
    const m = String(Math.floor((elapsed % 3600) / 60)).padStart(2, "0");
    const s = String(elapsed % 60).padStart(2, "0");

    document.getElementById("timer").innerText = `${h}:${m}:${s}`;
}

function startTimer() {
    // stop old timer if another start button was click.
    if (timerInterval) clearInterval(timerInterval);

    // count the timer every 1 seconds.
    timerInterval = setInterval(updateTimer, 1000);
}

// Start button

document.addEventListener("click", async function (e) {
    if (!e.target.classList.contains("startBtn")) return;

    const button = e.target;

    const taskId = button.dataset.taskId;

    const activeTask = button.dataset.taskTitle;

    const response = await fetch("/sessions/start", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            task_id: taskId,
        }),
    });

    const data = await response.json();

    startTime = Date.parse(data.session.start_time);

    if (!startTime) {
        console.error("Invalid start_time:", data.session.start_time);
        return;
    }

    if (!data.success) {
        alert(data.message);
        return;
    }

    document.getElementById("taskName").innerText = activeTask;

    document.getElementById("focusMode").style.display = "flex";

    startTimer(updateTimer);
});

// stop timer
document.getElementById("stopBtn").addEventListener("click", async function () {
    const response = await fetch("/sessions/stop", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
    });

    const data = await response.json();

    if (!data.success) {
        alert(data.message);
        return;
    }

    // stop timer
    startTime = null;
    clearInterval(timerInterval);

    document.getElementById("focusMode").style.display = "none";
});
