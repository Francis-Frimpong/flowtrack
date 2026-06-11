import "./bootstrap";

let timer;
let seconds = 0;
const startBtn = document.getElementById("startBtn");
const stopBtn = document.getElementById("stopBtn");

/* FOCUS */
startBtn.addEventListener("click", () => {
    document.getElementById("focusMode").style.display = "flex";

    seconds = 0;

    timer = setInterval(() => {
        seconds++;

        let h = String(Math.floor(seconds / 3600)).padStart(2, "0");
        let m = String(Math.floor((seconds % 3600) / 60)).padStart(2, "0");
        let s = String(seconds % 60).padStart(2, "0");

        document.getElementById("timer").innerText = `${h}:${m}:${s}`;
    }, 1000);
});

stopBtn.addEventListener("click", () => {
    clearInterval(timer);
    document.getElementById("focusMode").style.display = "none";
});
