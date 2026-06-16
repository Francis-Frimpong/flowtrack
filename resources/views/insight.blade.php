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
          <h4>12h 30m</h4>
        </div>

        <div class="cardx">
          <p class="muted mb-2">By Task</p>

          <div class="d-flex justify-content-between">
            <span>Learn Laravel</span>
            <strong>8h 20m</strong>
          </div>

          <div class="d-flex justify-content-between mt-2">
            <span>DSA Practice</span>
            <strong>3h 10m</strong>
          </div>

          <div class="d-flex justify-content-between mt-2">
            <span>Portfolio</span>
            <strong>1h 00m</strong>
          </div>
        </div>
      </div>
</x-frame>