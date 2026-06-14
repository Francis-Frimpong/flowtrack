<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Flow Track</title>

    
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    />
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    rel="stylesheet"
    />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  </head>

  <body>
    <!-- NAV -->
    <nav class="navbar px-3 py-2">
      <div class="container d-flex justify-content-between align-items-center">
        <div class="brand">🧠 FlowTrack</div>

        <div class="d-flex gap-2">
          <button  class="btn btn-soft btn-sm ">
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
          </button>
          <button class="btn btn-soft btn-sm">
            <a  href="{{ route('insight') }}" class="nav-link" >Insights</a>
          </button>
        </div>
      </div>
    </nav>

    <div class="app">
     {{ $slot }}
    </div>

    <!-- ================= FOCUS MODE ================= -->
    <div class="focus-mode" id="focusMode">
      <h4 id="taskName">Task</h4>

      <div class="timer" id="timer">00:00:00</div>

      <p class="text-secondary">Stay focused. No distractions.</p>

      <button class="btn btn-danger btn-lg mt-3" id="stopBtn">
        Stop Focus
      </button>
    </div>

    <!-- ================= MODAL ================= -->
    <div class="modal fade" id="taskModal">
      <div class="modal-dialog">
        <div class="modal-content p-3">
          <h5>Add Task</h5>
         <form id="taskForm">
            <input class="form-control mt-2" placeholder="Task name" id="title" type="text" />

            <button class="btn btn-primary mt-3" type="submit">
                Create
            </button>
        </form>
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
