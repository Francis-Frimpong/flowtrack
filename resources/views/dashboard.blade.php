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
        @if ($tasks->isEmpty())
          <div class="text-center text-muted py-5">
                <h5>No task has been created.</h5>
          </div>
        @else
          @foreach ($tasks as $task)
            
          <div class="cardx">
            <div class="task">
              <div class="task-title">{{$task->task}}</div>
                <button
                  class="btn btn-success btn-sm" id="startBtn"
                >
                  Start
                </button>
            </div>
  
          </div>
          @endforeach
        @endif
      </div>
</x-frame>