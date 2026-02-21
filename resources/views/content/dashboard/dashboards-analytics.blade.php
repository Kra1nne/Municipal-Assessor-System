@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('content')
<div class="row mb-4">
  <div class="col-12">
  <div class="card shadow-sm">
    <div class="card-body p-4">

      <!-- HEADER -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h2>Welcome, {{ Auth::user()->person->firstname }} {{ Auth::user()->person->lastname }}</h2>
          <small id="date" class="text-muted"></small>
          <small id="clock" class="text-muted"></small>
        </div>

        <div class="text-end">
          <i id="weather-icon" class="fs-2"></i>
          <div class="fw-semibold" id="weather-temp">--°C</div>
          <small class="text-muted">Today</small>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@if(Auth::user()->role == "Admin" || Auth::user()->role == "Employee")
<div class="row gy-6">
  <div class="col-xl-3 col-md-6">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Total Users</p>
          <h3 class="fw-bold mb-0">{{ $user->count() }}</h3>
          <small class="text-success">Number of users</small>
        </div>
        <div class="text-primary fs-2">
          <i class="ri-group-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Active Users</p>
          <h3 class="fw-bold mb-0">{{ $activeUsers }}</h3>
          <small class="text-muted">
            @if($user->count() > 0)
              {{ round(($activeUsers / $user->count()) * 100, 1) }}% of total users
            @else
              0% of total users
            @endif
          </small>
        </div>
        <div class="text-success fs-2">
          <i class="ri-pulse-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Inactive Users</p>
          <h3 class="fw-bold mb-0">{{ $inactiveUsers }}</h3>
          <small class="text-muted">
            @if($user->count() > 0)
              {{ round(($inactiveUsers / $user->count()) * 100, 1) }}% of total users
            @else
              0% of total users
            @endif
          </small>
        </div>
        <div class="text-warning fs-2">
          <i class="ri-user-unfollow-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Total Request</p>
          <h3 class="fw-bold mb-0" id="totalRequest">0</h3>
          <small class="text-primary">All request records</small>
        </div>
        <div class="text-primary fs-2">
          <i class="ri-file-line" style="font-size: 2.8rem;"></i>
        </div>  
      </div>
    </div>
  </div>

</div>
@endif
@if(Auth::user()->role == "User")
<div class="row gy-6">
  <div class="col-xl-3 col-md-6">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Own Property</p>
          <h3 class="fw-bold mb-0">{{ $count }}</h3>
          <small class="text-success">Number of property own</small>
        </div>
        <div class="text-primary fs-2">
          <i class="ri-building-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Under Review Request</p>
          <h3 class="fw-bold mb-0" id="reviewRequest">{{ $completepending  }}</h3>
          <small class="text-muted">Under review request</small>
        </div>
        <div class="text-muted fs-2">
          <i class="ri-error-warning-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Request Complete</p>
          <h3 class="fw-bold mb-0" id="completeRequest">{{ $completecount}}</h3>
          <small class="text-success">Request completed</small>
        </div>
        <div class="text-success fs-2">
          <i class="ri-checkbox-circle-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Total Value</p>
          <h3 class="fw-bold text-success mb-0" id="totalValue">{{ $total}}</h3>
          <small class="text-muted">Total Assessed Value</small>
        </div>
        <div class="text-success fs-2">
          <i class="ri-money-dollar-box-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>
  
</div>

@endif
<div class="my-4">
  <div class="row">
    <div class="col-12">
      <div class="card w-100 shadow-sm border-0 text-center p-5">

        <!-- Icon -->
        <div class="mb-4">
          <i class='ri-clipboard-line display-1 text-primary opacity-75'></i>
        </div>

        <!-- Title -->
        <h4 class="fw-bold text-secondary">No Data to Display</h4>

        <!-- Description -->
        <p class="text-muted mb-0">
          There is currently no data available to show.
        </p>

      </div>
    </div>
  </div>
</div>

</div>
@endsection
<script>
function updateClock() {
  const now = new Date();

  document.getElementById("clock").innerHTML =
    now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });

  document.getElementById("date").innerHTML =
    now.toLocaleDateString(undefined, {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });
}

setInterval(updateClock, 1000);
updateClock();
</script>
<script>
navigator.geolocation.getCurrentPosition(pos => {
  const { latitude, longitude } = pos.coords;

  fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current_weather=true&daily=temperature_2m_max&timezone=auto`)
    .then(res => res.json())
    .then(data => {

      document.getElementById("weather-temp").innerHTML =
        data.current_weather.temperature + "°C";

      const days = data.daily.time;
      const temps = data.daily.temperature_2m_max;

      for (let i = 1; i <= 6; i++) {
        const date = new Date(days[i]);
        document.getElementById(`day${i}-name`).innerHTML =
          date.toLocaleDateString(undefined, { weekday: 'short' });
        document.getElementById(`day${i}-temp`).innerHTML =
          temps[i] + "°C";
      }
    });
});
</script>
<script>
navigator.geolocation.getCurrentPosition(pos => {
  const { latitude, longitude } = pos.coords;

  fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current_weather=true&daily=temperature_2m_max&timezone=auto`)
    .then(res => res.json())
    .then(data => {

      // Temperature
      document.getElementById("weather-temp").innerHTML =
        data.current_weather.temperature + "°C";

      // Weather code
      const code = data.current_weather.weathercode;
      const icon = document.getElementById("weather-icon");

      // Default
      icon.className = "ri-sun-line fs-2 text-warning";

      // Weather code mapping
      if ([1, 2].includes(code)) {
        icon.className = "ri-cloudy-line fs-2 text-secondary"; // Partly cloudy
      } else if (code === 3) {
        icon.className = "ri-cloud-line fs-2 text-secondary"; // Cloudy
      } else if ([45, 48].includes(code)) {
        icon.className = "ri-mist-line fs-2 text-muted"; // Fog
      } else if ([51, 53, 55, 61, 63, 65].includes(code)) {
        icon.className = "ri-rainy-line fs-2 text-primary"; // Rain
      } else if ([71, 73, 75].includes(code)) {
        icon.className = "ri-snowy-line fs-2 text-info"; // Snow
      } else if ([95, 96, 99].includes(code)) {
        icon.className = "ri-thunderstorms-line fs-2 text-danger"; // Thunderstorm
      }
    });
});
</script>
<script>
navigator.geolocation.getCurrentPosition(pos => {
  const { latitude, longitude } = pos.coords;

  fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current_weather=true&daily=temperature_2m_max,weathercode&timezone=auto`)
    .then(res => res.json())
    .then(data => {

      // Current day
      document.getElementById("weather-temp").innerHTML =
        data.current_weather.temperature + "°C";

      const days = data.daily.time;
      const temps = data.daily.temperature_2m_max;
      const codes = data.daily.weathercode;

      function getWeatherIcon(code) {
        if ([0].includes(code)) return "ri-sun-line text-warning"; // Sunny
        if ([1,2].includes(code)) return "ri-cloudy-line text-secondary"; // Partly cloudy
        if (code === 3) return "ri-cloud-line text-secondary"; // Cloudy
        if ([45,48].includes(code)) return "ri-mist-line text-muted"; // Fog
        if ([51,53,55,61,63,65].includes(code)) return "ri-rainy-line text-primary"; // Rain
        if ([71,73,75].includes(code)) return "ri-snowy-line text-info"; // Snow
        if ([95,96,99].includes(code)) return "ri-thunderstorms-line text-danger"; // Thunderstorm
        return "ri-sun-line text-warning"; // Default
      }

      for (let i = 1; i <= 6; i++) {
        const date = new Date(days[i]);
        document.getElementById(`day${i}-name`).innerHTML =
          date.toLocaleDateString(undefined, { weekday: 'short' });
        document.getElementById(`day${i}-temp`).innerHTML =
          temps[i] + "°C";

        const iconEl = document.getElementById(`day${i}-icon`);
        iconEl.className = `fs-5 ${getWeatherIcon(codes[i])}`;
      }
    });
});
</script>