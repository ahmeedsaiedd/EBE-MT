<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  @include('admin.css-script')
  <body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
      @include('admin.sidebar')

      <!-- Mobile sidebar -->
      @include('admin.header')

      <!-- Sidebar -->
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
            <!-- Other menu items -->
          </ul>
        </div>
      </aside>

      <!-- Main content -->
      <div class="flex-1">
        <!-- Content goes here -->
      </div>
    </div>

        <!-- Modal -->
        <div id="create-project-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
          <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-lg font-semibold mb-4">Create Project</h2>
            <form id="create-project-form">
              
              <div class="mb-4">
                
                <label for="project-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Name</label>
                <input type="text" id="project-name" name="project-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
              </div>
              <div class="mb-4">
                <label for="members" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Members</label>
                <select id="members" name="members" multiple class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <!-- Options for members -->
                  <option value="member1">Member 1</option>
                  <option value="member2">Member 2</option>
                  <option value="member3">Member 3</option>
                </select>
              </div>
              <div class="mb-4">
                <label for="template" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Template</label>
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
    </script>
  </body>
</html>
