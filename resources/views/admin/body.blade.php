<main class="h-full overflow-y-auto">
  <div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      User Stories
    </h2>

    <!-- User Story Form -->
    <div class="mb-4">
      <form action="{{ url('/UserStory') }}" method="POST" id="userStoryForm" class="space-y-4">
        @csrf
        <!-- User Story Name -->
        <div class="user-story-section">
          <label for="userStoryName" class="font-semibold text-gray-700 dark:text-gray-300">User Story Name</label>
          <input type="text" name="userStoryName[]" placeholder="Enter user story name..." class="block w-full px-3 py-2 border rounded-md focus:outline-none focus:border-purple-600 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 text-sm">
        </div>
        <div class="flex flex-col space-y-4">
          <!-- As -->
          <div class="flex flex-col">
            <label for="asField" class="font-semibold text-gray-700 dark:text-gray-300 mb-1">As</label>
            <input type="text" name="asField[]" placeholder="Describe who will benefit from this feature..." class="block w-full px-3 py-2 border rounded-md focus:outline-none focus:border-purple-600 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 text-sm">
          </div>

          <!-- I want -->
          <div>
            <label for="iWantField" class="font-semibold text-gray-700 dark:text-gray-300">I want</label>
            <input type="text" name="iWantField[]" placeholder="Specify what the feature should do..." class="block w-full px-3 py-2 border rounded-md focus:outline-none focus:border-purple-600 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 text-sm">
          </div>

          <!-- So that -->
          <div>
            <label for="soThatField" class="font-semibold text-gray-700 dark:text-gray-300">So that</label>
            <input type="text" name="soThatField[]" placeholder="Explain why the feature is needed..." class="block w-full px-3 py-2 border rounded-md focus:outline-none focus:border-purple-600 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 text-sm">
          </div>
        </div>

        <!-- Add and Remove Buttons -->
        <div class="flex items-center justify-between mt-4">
          <div>
            <button type="button" class="add-section bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition duration-300 text-sm">+ Create new</button>
          </div>
          <button type="submit" class="add-user-story bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 focus:outline-none focus:bg-purple-700 transition duration-300 text-sm">Submit User Story</button>
        </div>
      </form>
    </div>

    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
      <!-- Cards content here -->
    </div>

    <!-- User Story Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
              <th class="px-4 py-3">Test Scenario</th>
              <th class="px-4 py-3">Test ID</th>
              <th class="px-4 py-3">Test Title</th>
              <th class="px-4 py-3">Precondition</th>
              <th class="px-4 py-3">Test Steps</th>
              <th class="px-4 py-3">Expected Result</th>
              <th class="px-4 py-3">Actual Result</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Test Type</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            <!-- Example row, replace with dynamic content -->
            <tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3 text-sm">Scenario 1</td>
              <td class="px-4 py-3 text-sm">TS001</td>
              <td class="px-4 py-3 text-sm">Login Test</td>
              <td class="px-4 py-3 text-sm">
                <div class="flex items-center">
                  <span>Precondition text here</span>
                  <button class="ml-2 copy-button bg-blue-500 text-white px-2 py-1 rounded-md text-xs" data-copy-text="Precondition text here">Copy</button>
                </div>
              </td>
              <td class="px-4 py-3 text-sm">
                <div class="flex items-center">
                  <span>Test steps text here</span>
                  <button class="ml-2 copy-button bg-blue-500 text-white px-2 py-1 rounded-md text-xs" data-copy-text="Test steps text here">Copy</button>
                </div>
              </td>
              <td class="px-4 py-3 text-sm">Expected result text here</td>
              <td class="px-4 py-3 text-sm">Actual result text here</td>
              <td class="px-4 py-3 text-xs">
                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                  Passed
                </span>
              </td>
              <td class="px-4 py-3 text-sm">Functional</td>
            </tr>
            <!-- Example row ends -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('userStoryForm');
    const addButtons = form.querySelectorAll('.add-section');
    const removeButtons = form.querySelectorAll('.remove-section');

    // Function to clone user story section
    function cloneUserStorySection(button) {
      const template = form.querySelector('.user-story-section-template').cloneNode(true);
      template.classList.remove('hidden');
      template.querySelector('input[name="userStoryName[]"]').value = ''; // Clear user story name input
      template.querySelector('input[name="asField[]"]').value = ''; // Clear As input
      template.querySelector('input[name="iWantField[]"]').value = ''; // Clear I Want input
      template.querySelector('input[name="soThatField[]"]').value = ''; // Clear So That input

      // Add event listener for Add button in cloned section
      template.querySelector('.add-section').addEventListener('click', function() {
        cloneUserStorySection(this);
      });

      // Add event listener for Remove button in cloned section
      template.querySelector('.remove-section').addEventListener('click', function() {
        template.remove();
      });

      form.insertBefore(template, form.querySelector('.user-story-section-template'));
    }

    // Add button event listeners
    addButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        cloneUserStorySection(button);
      });
    });

    // Remove button event listeners
    removeButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        button.closest('.user-story-section-template').remove();
      });
    });
  });
</script>
