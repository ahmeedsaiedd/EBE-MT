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
  
    <main class="h-full  w-full">
      
      <div class="container px-6 mx-auto grid">
         
        <br>
        <nav class="flex mb-6" aria-label="Breadcrumb">
          <ol id="breadcrumb" class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
              <!-- Breadcrumb links will be populated by JavaScript -->
          </ol>
        </nav>
          
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Dashboard</h2>
        
<!-- Breadcrumb -->

        <!-- Cards -->
        <div class="grid gap-6 mb-8 grid-cols-1 md:grid-cols-2 xl:grid-cols-4">
          <!-- Card 1: Total Users -->
          <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 w-full">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
              <i class="fas fa-users fa-lg"></i> <!-- Font Awesome Icon for Users -->
            </div>
            <div>
              <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
              <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$usersNo}}</p>
            </div>
          </div>
        
          <!-- Card 2: Projects -->
          <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 w-full">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
              <i class="fas fa-project-diagram fa-lg"></i> <!-- Font Awesome Icon for Projects -->
            </div>
            <div>
              <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Projects</p>
              <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{$projectsNo}}</p>
            </div>
          </div>
        
          <!-- Card 3: Active Sprints -->
          <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 w-full">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
              <i class="fas fa-running fa-lg"></i> <!-- Font Awesome Icon for Active Sprints -->
            </div>
            <div>
              <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Active Sprints</p>
              <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">5</p>
            </div>
          </div>
        
          <!-- Card 4: Issues -->
          <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 w-full">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
              <i class="fas fa-exclamation-triangle fa-lg"></i> <!-- Font Awesome Icon for Issues -->
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
  <script>
     const breadcrumb = document.getElementById('breadcrumb');
 // Function to build breadcrumbs
 function buildBreadcrumbs() {
                const path = window.location.pathname.split('/').filter(p => p);
                let breadcrumbHTML = '<li class="inline-flex items-center"><a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"><svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/></svg>Home</a></li>';

                path.forEach((segment, index) => {
                    const isLast = index === path.length - 1;
                    const segmentTitle = segment.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    breadcrumbHTML += `<li class="inline-flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                        <a href="${path.slice(0, index + 1).join('/')}">${segmentTitle}</a>
                    </li>`;
                });

                breadcrumb.innerHTML = breadcrumbHTML;
            }

            // Build breadcrumbs on page load
            buildBreadcrumbs();

  </script>
</body>
</html>
