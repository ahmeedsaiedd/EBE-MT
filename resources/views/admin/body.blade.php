<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Windmill Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>

  </style>
</head>
<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <main class="h-full  w-full">
      <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Dashboard</h2>

        <!-- Cards -->
<div class="grid gap-6 mb-8 grid-cols-1 md:grid-cols-2 xl:grid-cols-4">
  <!-- Card 1 -->
  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 w-full">
    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
      <i class="fas fa-users fa-lg"></i> <!-- Font Awesome Icon for Users -->
    </div>
    <div>
      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
      <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$usersNo}}</p>
    </div>
  </div>
  <!-- Card 2 -->
  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 w-full">
    <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
      <i class="fas fa-project-diagram fa-lg"></i> <!-- Font Awesome Icon for Projects -->
    </div>
    <div>
      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Projects</p>
      <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$projectsNo}}</p>
    </div>
  </div>
  <!-- Card 3 -->
  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 w-full">
    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
      <i class="fas fa-tachometer-alt fa-lg"></i> <!-- Font Awesome Icon for Active Sprints -->
    </div>
    <div>
      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Active Sprints</p>
      <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">5</p>
    </div>
  </div>
  <!-- Card 4 -->
  <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 w-full">
    <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
      <i class="fas fa-exclamation-circle fa-lg"></i> <!-- Font Awesome Icon for Issues -->
    </div>
    <div>
      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Issues</p>
      <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$issueNo}}</p>
    </div>
  </div>
</div>


        <!-- Charts -->
{{-- <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Charts</h2> --}}
<div class="grid gap-6 mb-8 md:grid-cols-1">
  <!-- Users Chart -->
  <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 flex flex-col items-center">
    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Users</h4>
    <div class="flex-grow flex items-center justify-center w-full">
      <canvas id="line" class="w-full h-64"></canvas> <!-- Full width, fixed height -->
    </div>
  </div>
</div>



    </main>
  </div>
  <!-- Scripts -->
  <script src="{{ asset('js/charts-lines.js') }}"></script>
  <script src="{{ asset('js/charts-pie.js') }}"></script>
</body>
</html>
