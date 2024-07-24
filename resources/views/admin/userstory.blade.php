<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  @include('admin.css')
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      @include('admin.sidebar')
      <!-- Mobile sidebar -->
      @include('admin.header')
      <div class="flex-1 p-6">
          <!-- Breadcrumb Navigation -->
          <nav class="flex mb-6" aria-label="Breadcrumb">
              <ol id="breadcrumb" class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                  <!-- Breadcrumb items will be added here dynamically -->
                </ol>
            </nav>
            <h1>Timeline</h1>
      </div>
    </div>
    <script>
      @include('admin.script')
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        function updateBreadcrumb() {
          const breadcrumb = document.getElementById('breadcrumb');
          const pathSegments = window.location.pathname.split('/').filter(segment => segment);

          breadcrumb.innerHTML = '';

          if (pathSegments.length === 0) {
            breadcrumb.innerHTML = `
              <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                  <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                  </svg>
                  Home
                </a>
              </li>
            `;
          } else {
            breadcrumb.innerHTML = `
              <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                  <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                  </svg>
                  Home
                </a>
              </li>
            `;
            pathSegments.forEach((segment, index) => {
              const isLastSegment = index === pathSegments.length - 1;
              breadcrumb.innerHTML += `
                <li class="inline-flex items-center">
                  ${index > 0 ? '<svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l8 8-8 8"/></svg>' : ''}
                  <a href="#" class="inline-flex items-center text-sm font-medium ${isLastSegment ? 'text-blue-600 dark:text-white' : 'text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white'}">
                    ${decodeURIComponent(segment)}
                  </a>
                </li>
              `;
            });
          }
        }

        updateBreadcrumb();
      });
      document.getElementById('dropdownButton').addEventListener('click', function () {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const button = document.getElementById('dropdownButton');
            const menu = document.getElementById('dropdownMenu');
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
        
        document.getElementById('openModalButton').addEventListener('click', function() {
        document.getElementById('modal').classList.remove('hidden');
    });

    document.querySelectorAll('#closeModalButton').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });
    });
    </script>
  </body>
</html>
