<x-frame>


      <div id="dashboard" class="page active">
        <div class="cardx mb-3">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-1">Your Tasks</h5>
              <small class="muted">Start a session and enter deep focus</small>
            </div>

            <button
              class="btn btn-primary btn-sm"
              data-bs-toggle="modal"
              data-bs-target="#taskModal"
            >
              + Add Task
            </button>
          </div>
        </div>

        <div class="cardx">
          <div class="task">
            <div class="task-title">Learn Laravel</div>
            <button
              class="btn btn-success btn-sm" id="startBtn"
            >
              Start
            </button>
          </div>

        </div>
      </div>
</x-frame>