import "./bootstrap";

const startBtn = document.getElementById("startBtn");
const stopBtn = document.getElementById("stopBtn");
const taskForm = document.getElementById("taskForm");

/* FOCUS */

// create task
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
    document.getElementById("emptyTask").style.display = "none";
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

// Start button
document.querySelectorAll(".startBtn").forEach((button) => {
    button.addEventListener("click", async function () {
        const taskId = this.dataset.taskId;

        const response = await fetch("/sessions/start", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
            body: JSON.stringify({
                task_id: taskId,
            }),
        });

        const data = await response.json();

        if (!data.success) {
            alert(data.message);
            return;
        }

        console.log("Session started:", data.session);

        // 👉 NOW start your timer ONLY after success
        startTimer();
    });
});

// timer function

let seconds = 0;
let timer = null;

function startTimer() {
    seconds = 0;

    timer = setInterval(() => {
        seconds++;

        let h = String(Math.floor(seconds / 3600)).padStart(2, "0");
        let m = String(Math.floor((seconds % 3600) / 60)).padStart(2, "0");
        let s = String(seconds % 60).padStart(2, "0");

        document.getElementById("timer").innerText = `${h}:${m}:${s}`;
        document.getElementById("focusMode").style.display = "flex";
    }, 1000);
}

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

    console.log("Session stopped:", data.session);

    // stop timer
    clearInterval(timer);

    document.getElementById("focusMode").style.display = "none";
});

// stopBtn.addEventListener("click", () => {
//     clearInterval(timer);
// });
