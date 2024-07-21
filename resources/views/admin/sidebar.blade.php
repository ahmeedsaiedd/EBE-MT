<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EBE-MT Sidebar</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .btn-toggle.active {
  color: #4A5568; /* Tailwind's `text-gray-800` */
  background-color: #E2E8F0; /* Tailwind's `bg-gray-100` */
  border-left: 4px solid #4A5568; /* Highlight active button */
}

.dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 90;
      margin-top: 0.5rem;
      background-color: #ffffff;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      border-radius: 0.375rem;
      width: 12rem;
      z-index: 50;
    }

    .dropdown-menu.show {
      display: block;
    }

    .btn-toggle.active {
      color: #4A5568; /* Tailwind's `text-gray-800` */
      background-color: #E2E8F0; /* Tailwind's `bg-gray-100` */
      border-left: 4px solid #4A5568; /* Highlight active button */
    }

    /* Hide modal by default */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
      align-items: center;
      justify-content: center;
    }

    /* Modal content styling */
    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 600px; /* Adjust width as needed */
      height: 600;
    }
  </style>
</head>
<body>
  <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
      <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
        EBE-MT
      </a>
      
      <ul class="mt-6">
        <li class="relative px-6 py-3">
          <button id="create-project-btn" class="btn-toggle inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 focus:outline-none">
            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <path d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span class="ml-4">Create Project</span>
          </button>
        </li>

        <!-- Modal HTML -->
         
        <div id="create-project-modal" class="modal">
          <div class="modal-content">
            <a href="">
            <h2 class="text-lg font-semibold mb-4">Create Project</h2>
          </a>
            <form id="create-project-form">
              <div class="mb-4">
                <label for="project-name" class="block text-sm font-medium text-gray-700">Project Name</label>
                <input type="text" id="project-name" name="project-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
              </div>
              <div class="mb-4">
                <label for="members" class="block text-sm font-medium text-gray-700">Members</label>
                <select id="members" name="members" multiple class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <!-- Options for members (e.g., fetched from a database) -->
                  <option value="member1">Ahmed Saied</option>
                  <option value="member2">Yassmen</option>
                  <option value="member3">Hadeel</option>
                </select>
              </div>
              <div class="mb-4">
                <label for="template" class="block text-sm font-medium text-gray-700">Template</label>
                <select id="template" name="template" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option value="scrum">Scrum</option>
                  <option value="kanban">Kanban</option>
                </select>
              </div>
              <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Submit</button>
                <button type="button" id="close-modal" class="ml-4 px-4 py-2 bg-gray-200 text-gray-800 rounded-md shadow-sm hover:bg-gray-300">Cancel</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Other list items... -->
        <li class="relative px-6 py-3">
  <button id="dropdown-btn" class="btn-toggle inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 focus:outline-none">
    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
      <path d="M3 7h18a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2zm0 0l2-2h6l2 2H3z"></path>
    </svg>
    <span class="ml-4">My Project</span>
  </button>
  <div id="dropdown-menu" class="dropdown-menu absolute mt-2 bg-white shadow-lg rounded-md w-48">
    <ul>
      <li><a href="#" class="project-option block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-project="1">Project 1</a></li>
      <li><a href="#" class="project-option block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-project="2">Project 2</a></li>
      <li><a href="#" class="project-option block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-project="3">Project 3</a></li>
    </ul>
  </div>
</li>

<!-- Modal -->
<div id="project-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-800 bg-opacity-50">
  <div class="bg-white rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Select Options for Project</h2>
    <form id="project-form">
      <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Checkbox 1</label>
        <input type="checkbox" name="option1" value="1" class="mr-2"> Option 1
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Checkbox 2</label>
        <input type="checkbox" name="option2" value="2" class="mr-2"> Option 2
      </div>
      <!-- Add more checkboxes as needed -->
      <div class="flex justify-end">
        <button type="button" id="modal-close-btn" class="px-4 py-2 bg-gray-500 text-white rounded-md">Close</button>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md ml-2">Submit</button>
      </div>
    </form>
  </div>
</div>


        <li class="relative px-6 py-3">
          <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
          <button class="inline-flex items-center w-full text-sm font-semibold text-gray-800 dark:text-gray-200 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" @click="togglePagesMenu" aria-haspopup="true" aria-current="page">
            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <path d="M8 7V3M16 7V3M3 9h18M4 9V21h16V9M10 13h4M10 17h4" />
            </svg>
            <span class="ml-4">Planning</span>
            <svg class="w-4 h-4 ml-auto transform rotate-180" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </button>
          <template x-if="isPagesMenuOpen">
            <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:bg-gray-900" aria-label="submenu">
              <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <a class="flex items-center w-full" href="{{url('view_userstory')}}">
                  <svg width="24" height="24" viewBox="0 0 24 24" role="presentation">
                    <path d="M6 2h10a3 3 0 010 6H6a3 3 0 110-6zm0 2a1 1 0 100 2h10a1 1 0 000-2H6zm4 5h8a3 3 0 010 6h-8a3 3 0 010-6zm0 2a1 1 0 000 2h8a1 1 0 000-2h-8zm-4 5h6a3 3 0 010 6H6a3 3 0 010-6zm0 2a1 1 0 000 2h6a1 1 0 000-2H6z" fill="currentColor" fill-rule="evenodd"></path>
                  </svg>
                  Timeline
                </a>
              </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <a class="flex items-center w-full" href="{{url('view_board')}}">
                    <svg width="24" height="24" viewBox="0 0 24 24" role="presentation">
                        <g fill="currentColor">
                            <path d="M4 18h16.008C20 18 20 6 20 6H3.992C4 6 4 18 4 18zM2 5.994C2 4.893 2.898 4 3.99 4h16.02C21.108 4 22 4.895 22 5.994v12.012A1.997 1.997 0 0120.01 20H3.99A1.994 1.994 0 012 18.006V5.994z"></path>
                            <path d="M8 6v12h2V6zm6 0v12h2V6z"></path>
                        </g>
                    </svg>
                    Board
                </a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <a class="flex items-center w-full" href="{{url('view_calender')}}">
                    <span aria-hidden="true" class="css-snhnyn" style="--icon-primary-color: currentColor; --icon-secondary-color: var(--ds-surface, #FFFFFF);">
                        <svg width="24" height="24" viewBox="0 0 24 24" role="presentation">
                            <path d="M4.995 5h14.01C20.107 5 21 5.895 21 6.994v12.012A1.994 1.994 0 0119.005 21H4.995A1.995 1.995 0 013 19.006V6.994C3 5.893 3.892 5 4.995 5zM5 9v9a1 1 0 001 1h12a1 1 0 001-1V9H5zm1-5a1 1 0 012 0v1H6V4zm10 0a1 1 0 012 0v1h-2V4zm-9 9v-2.001h2V13H7zm8 0v-2.001h2V13h-2zm-4 0v-2.001h2.001V13H11zm-4 4v-2h2v2H7zm4 0v-2h2.001v2H11zm4 0v-2h2v2h-2z" fill="currentColor" fill-rule="evenodd"></path>
                        </svg>
                    </span>
                    Calendar
                </a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <a class="flex items-center w-full" href="pages/404.html">
                    <span aria-hidden="true" class="css-snhnyn" style="--icon-primary-color: currentColor; --icon-secondary-color: var(--ds-surface, #FFFFFF);">
                        <svg width="24" height="24" viewBox="0 0 24 24" role="presentation">
                            <g fill="currentColor" fill-rule="evenodd">
                                <rect x="10" y="15" width="8" height="2" rx="1"></rect>
                                <rect x="6" y="15" width="2" height="2" rx="1"></rect>
                                <rect x="10" y="11" width="8" height="2" rx="1"></rect>
                                <rect x="6" y="11" width="2" height="2" rx="1"></rect>
                                <rect x="10" y="7" width="8" height="2" rx="1"></rect>
                                <rect x="6" y="7" width="2" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                    List
                </a>
            </li>
            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                <a class="flex items-center w-full" href="forms.html">
                    <span aria-hidden="true" class="css-snhnyn" style="--icon-primary-color: currentColor; --icon-secondary-color: var(--ds-surface, #FFFFFF);">
                        <svg width="24" height="24" viewBox="0 0 24 24" role="presentation">
                            <g fill="currentColor" fill-rule="evenodd">
                                <path d="M5 12.991c0 .007 14.005.009 14.005.009C18.999 13 19 5.009 19 5.009 19 5.002 4.995 5 4.995 5 5.001 5 5 12.991 5 12.991zM3 5.01C3 3.899 3.893 3 4.995 3h14.01C20.107 3 21 3.902 21 5.009v7.982c0 1.11-.893 2.009-1.995 2.009H4.995A2.004 2.004 0 013 12.991V5.01zM19 19c-.005 1.105-.9 2-2.006 2H7.006A2.009 2.009 0 015 19h14zm1-3a2.002 2.002 0 01-1.994 2H5.994A2.003 2.003 0 014 16h16z" fill-rule="nonzero"></path>
                                <path d="M10.674 11.331c.36.36.941.36 1.3 0l2.758-2.763a.92.92 0 00-1.301-1.298l-2.108 2.11-.755-.754a.92.92 0 00-1.3 1.3l1.406 1.405z"></path>
                            </g>
                        </svg>
                    </span>
                    Issues
                </a>
            </li>
        </ul>
    </template>
</li>



      <li class="relative px-6 py-3">
        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="cards.html">
          <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
          </svg>
          <span class="ml-4">Components</span>
        </a>
      </li>
    </ul>
  </div>
</aside>

  <script>
    document.getElementById('create-project-btn').addEventListener('click', function() {
      document.getElementById('create-project-modal').style.display = 'flex';
    });

    document.getElementById('close-modal').addEventListener('click', function() {
      document.getElementById('create-project-modal').style.display = 'none';
    });

    // Optional: Close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
      if (event.target === document.getElementById('create-project-modal')) {
        document.getElementById('create-project-modal').style.display = 'none';
      }
    });
    // Toggle Dropdown Menu
    document.getElementById('dropdown-btn').addEventListener('click', function() {
      document.getElementById('dropdown-menu').classList.toggle('show');
    });

    // Close Dropdown Menu when clicking outside
    window.addEventListener('click', function(event) {
      if (!event.target.closest('#dropdown-btn') && !event.target.closest('#dropdown-menu')) {
        document.getElementById('dropdown-menu').classList.remove('show');
      }
    }); 
  </script>
</body>
</html>

