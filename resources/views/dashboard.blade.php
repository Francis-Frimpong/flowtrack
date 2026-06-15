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
       <div id="taskContainer">

            @if ($tasks->isEmpty())
                <div class="text-center text-muted py-4">
                    No tasks found.
                </div>
            @else

                @foreach ($tasks as $task)
                    <div class="cardx mb-2">
                        <div class="task">

                            <div class="task-title">
                                {{ $task->title }}
                            </div>

                            <button class="btn btn-success btn-sm startBtn"
                                data-task-id="{{ $task->id }}"
                                data-task-title="{{ $task->title }}">
                                Start
                            </button>

                        </div>
                    </div>
                @endforeach

            @endif

        </div>

      </div>
</x-frame>