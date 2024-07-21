<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  @include('admin.css-script')
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      /* Ensure the container for the boxes can scroll horizontally */
      .box-container {
        display: flex;
        overflow-x: auto;
        padding: 1rem; /* Adjust the padding if needed */
        align-items: flex-start; /* Align items at the start vertically */
      }

      /* Ensure each box has a fixed width and margin for spacing */
      .box {
        width: 16rem; /* Adjust as needed */
        height: 9rem;
        margin-right: 1rem; /* Adjust spacing between boxes */
        flex-shrink: 0; /* Prevent boxes from shrinking */
      }

      /* Ensure the boxes don't wrap but align horizontally */
      .box-container::-webkit-scrollbar {
        height: 8px;
      }

      .box-container::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 4px;
      }
      
      /* Make the title editable */
      .editable-title {
        outline: none;
      }
    </style>
  </head>
  <body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
      @include('admin.sidebar')
      @include('admin.header')
      
      <!-- Main Content -->
      <div class="flex-1 p-6">
          <!-- Breadcrumb Navigation -->
          <nav class="flex mb-6" aria-label="Breadcrumb">
              <ol id="breadcrumb" class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                  <!-- Breadcrumb items will be added here dynamically -->
                </ol>
            </nav>
            <h1>Board</h1>

        <!-- Box Container -->
        <div class="box-container">
          <!-- Initial Boxes -->
          <div id="boxToDo" class="box bg-gray-200 border border-gray-300 rounded-md relative flex flex-col overflow-y-auto">
            <h2 id="titleToDo" class="editable-title text-lg font-semibold text-gray-800" contenteditable="true">To Do</h2>
            <button id="createIssueBtnToDo" class="mt-4 px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">+ Create Issue</button>
            <div id="issueInputContainerToDo" class="mt-4 hidden flex-1">
              <textarea id="issueInputToDo" class="w-full p-2 border border-gray-300 rounded-md" rows="4" placeholder="Enter issue details..."></textarea>
              <button id="saveIssueBtnToDo" class="mt-2 px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Save Issue</button>
            </div>
          </div>

          <div id="boxInProgress" class="box bg-yellow-200 border border-yellow-300 rounded-md relative flex flex-col overflow-y-auto">
            <h2 id="titleInProgress" class="editable-title text-lg font-semibold text-gray-800" contenteditable="true">In Progress</h2>
            <button id="createIssueBtnInProgress" class="mt-4 px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">+ Create Issue</button>
            <div id="issueInputContainerInProgress" class="mt-4 hidden flex-1">
              <textarea id="issueInputInProgress" class="w-full p-2 border border-gray-300 rounded-md" rows="4" placeholder="Enter issue details..."></textarea>
              <button id="saveIssueBtnInProgress" class="mt-2 px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Save Issue</button>
            </div>
          </div>

          <div id="boxDone" class="box bg-green-200 border border-green-300 rounded-md relative flex flex-col overflow-y-auto">
            <h2 id="titleDone" class="editable-title text-lg font-semibold text-gray-800" contenteditable="true">Done</h2>
            <button id="createIssueBtnDone" class="mt-4 px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">+ Create Issue</button>
            <div id="issueInputContainerDone" class="mt-4 hidden flex-1">
              <textarea id="issueInputDone" class="w-full p-2 border border-gray-300 rounded-md" rows="4" placeholder="Enter issue details..."></textarea>
              <button id="saveIssueBtnDone" class="mt-2 px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Save Issue</button>
            </div>
          </div>

          <!-- Button to Add New Box -->
          <button id="addNewBoxBtn" class="w-full sm:w-32 h-10 px-2 py-1 text-sm text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">+</button>
        </div>
      </div>
    </div>

    <script>
      // Function to create breadcrumb items based on the URL path
      function updateBreadcrumb() {
        const breadcrumb = document.getElementById('breadcrumb');
        const pathSegments = window.location.pathname.split('/').filter(segment => segment);

        breadcrumb.innerHTML = ''; // Clear existing breadcrumb items

        if (pathSegments.length === 0) {
          // Home breadcrumb
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
          // Home breadcrumb
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
          // Additional breadcrumbs
          pathSegments.forEach((segment, index) => {
            const isLastSegment = index === pathSegments.length - 1;
            breadcrumb.innerHTML += `
              <li class="inline-flex items-center">
                ${index > 0 ? '<svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>' : ''}
                <a href="#" class="text-sm font-medium ${isLastSegment ? 'text-gray-500 dark:text-gray-400' : 'text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white'}">
                  ${isLastSegment ? `<span class="ms-1">${decodeURIComponent(segment)}</span>` : `<span class="ms-1">${decodeURIComponent(segment)}</span>`}
                </a>
              </li>
            `;
          });
        }
      }

      // Initial call to update breadcrumbs on page load
      updateBreadcrumb();

      function toggleIssueInput(containerId, buttonId, inputId) {
        document.getElementById(buttonId).addEventListener('click', function() {
          document.getElementById(containerId).classList.remove('hidden');
        });

        document.getElementById(`saveIssueBtn${inputId}`).addEventListener('click', function() {
          const issueDetails = document.getElementById(`issueInput${inputId}`).value;
          if (issueDetails) {
            const box = document.getElementById(`box${inputId}`);
            const issueElement = document.createElement('p');
            issueElement.textContent = issueDetails;
            issueElement.classList.add('mt-2', 'text-gray-800');
            box.appendChild(issueElement);

            document.getElementById(`issueInput${inputId}`).value = '';
            document.getElementById(containerId).classList.add('hidden');
          } else {
            alert('Please enter issue details.');
          }
        });
      }

      function setupEditableTitles() {
        document.querySelectorAll('.editable-title').forEach(title => {
          title.addEventListener('blur', function() {
            if (this.textContent.trim() === '') {
              alert('Box name cannot be empty.');
              this.textContent = 'Untitled'; // Set default name if empty
            }
          });

          title.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
              event.preventDefault(); // Prevent newline in the contenteditable element
              this.blur(); // Trigger blur event
            }
          });
        });
      }

      toggleIssueInput('issueInputContainerToDo', 'createIssueBtnToDo', 'ToDo');
      toggleIssueInput('issueInputContainerInProgress', 'createIssueBtnInProgress', 'InProgress');
      toggleIssueInput('issueInputContainerDone', 'createIssueBtnDone', 'Done');

      setupEditableTitles();

      document.getElementById('addNewBoxBtn').addEventListener('click', function() {
        const boxContainer = document.querySelector('.box-container');
        const existingBoxes = Array.from(boxContainer.children).filter(child => child.classList.contains('box'));

        if (existingBoxes.length > 0) {
          const boxName = prompt('Enter a name for the new box:');
          if (boxName) {
            const boxToDuplicate = existingBoxes[0]; // Duplicate the first existing box
            const newBoxIndex = boxContainer.children.length - 1; // Exclude the "Add New Box" button

            const newBox = document.createElement('div');
            newBox.className = 'box bg-gray-200 border border-gray-300 rounded-md relative flex flex-col overflow-y-auto';
            newBox.id = `boxNew${newBoxIndex + 1}`;
            newBox.innerHTML = `
              <h2 id="titleNew${newBoxIndex + 1}" class="editable-title text-lg font-semibold text-gray-800" contenteditable="true">${boxName}</h2>
              <button id="createIssueBtnNew${newBoxIndex + 1}" class="mt-4 px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">+ Create Issue</button>
              <div id="issueInputContainerNew${newBoxIndex + 1}" class="mt-4 hidden flex-1">
                <textarea id="issueInputNew${newBoxIndex + 1}" class="w-full p-2 border border-gray-300 rounded-md" rows="4" placeholder="Enter issue details..."></textarea>
                <button id="saveIssueBtnNew${newBoxIndex + 1}" class="mt-2 px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Save Issue</button>
              </div>
            `;
            boxContainer.insertBefore(newBox, document.getElementById('addNewBoxBtn'));

            toggleIssueInput(`issueInputContainerNew${newBoxIndex + 1}`, `createIssueBtnNew${newBoxIndex + 1}`, `New${newBoxIndex + 1}`);
            setupEditableTitles();
          } else {
            alert('Box name is required.');
          }
        } else {
          alert('No existing boxes to duplicate.');
        }
      });
    </script>
  </body>
</html>
