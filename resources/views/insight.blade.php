<x-frame>

    <div id="insights">
        <div class="cardx mb-3">
          <h5>Insights</h5>
          <small class="muted">Your deep work progress over time</small>
        </div>

        <div class="cardx mb-3">
          <p class="muted mb-1">Today</p>
          <h3>{{$hours}}h {{$minutes}}m</h3>
        </div>

        <div class="cardx mb-3">
          <p class="muted mb-1">This Week</p>
          <h4>{{$hoursPerWeek}}h {{$minutesPerWeek}}m</h4>
        </div>

        <div class="cardx">
          <p class="muted mb-2">By Task</p>

          @foreach ($tasks as $task )
            <div class="d-flex justify-content-between">
              <span>{{ $task->title }}</span>
              <strong>{{floor($task->today_seconds / 3600)}}h {{floor(($task->today_seconds % 3600) / 60)}}m</strong>
            </div>
            
          @endforeach

        </div>
      </div>
</x-frame>