<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<html lang="en" x-data="{ dark: false, isSideMenuOpen: false }" :class="{ 'theme-dark': dark }">

<head>
    <title>EBE Issues</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EBE Timeline</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/flowbite@1.6.1/dist/flowbite.min.css" rel="stylesheet">
    @include('admin.css')
    <style>
        .spinner {
            border-top-color: transparent;
            border-radius: 50%;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #3490dc; /* Blue color */
            width: 3rem;
            height: 3rem;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Loader container */
        .loader-container {
            position: fixed; /* Ensure it covers the viewport */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8); /* Slight white overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Ensure it is on top of other content */
        }

        /* Hide overflow on body when loader is visible */
        body.loader-active {
            overflow: hidden;
        }
        .popover {
    display: none; /* Hide by default */
    position: absolute;
    top: 0%; /* Position below the button */
    left: 0;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    min-width: 200px; /* Ensure dropdown has a minimum width */
    z-index: 10; /* Ensure it is on top of other content */
}


        /* Show popover */
        .popover.show {
            display: block;
        }
        /* Dropdown styles */
        .dropdown-menu {
            display: none; /* Hide by default */
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            min-width: 200px; /* Ensure dropdown has a minimum width */
        }

        /* Show dropdown */
        .dropdown-menu.show {
            display: block;
        }

        .modal {
            position: fixed;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5); /* Overlay */
            z-index: 9999; /* Ensure it is on top of other content */
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        /* Button styles for different states */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary {
            background-color: #3490dc;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2779bd;
        }

        .btn-secondary {
            background-color: #38c172;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #2f9e3e;
        }

        .btn-tertiary {
            background-color: #e2e8f0;
            color: #4a5568;
        }

        .btn-tertiary:hover {
            background-color: #cbd5e0;
        }

        .btn-danger {
            background-color: #e53e3e;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c53030;
        }

        .btn-success {
            background-color: #48bb78;
            color: white;
        }

        .btn-success:hover {
            background-color: #38a169;
        }

        /* Form and input styles */
        .form-input {
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-input:focus {
            border-color: #3490dc;
            box-shadow: 0 0 0 1px #3490dc;
            outline: none;
        }

        .form-textarea {
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-textarea:focus {
            border-color: #3490dc;
            box-shadow: 0 0 0 1px #3490dc;
            outline: none;
        }

        /* Additional layout and styling */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }


    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <div class="flex h-screen">
        @include('admin.sidebar')
        @include('admin.header')
        <div class="flex-1 p-6">
             <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol id="breadcrumb" class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <!-- Breadcrumb links will be populated by JavaScript -->
        </ol>
    </nav>
            <!-- Breadcrumb Navigation -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol id="breadcrumb" class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <!-- Breadcrumb items will be added here dynamically -->
                </ol>
            </nav>

            <!-- Loader -->
            <div id="loader" class="loader-container hidden">
                <div class="flex flex-col items-center space-y-4">
                    <div role="status" class="flex items-center">
                        <div class="spinner"></div>
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="text-gray-600">Preparing your issue</p>
                </div>
            </div>

            <!-- Content -->
            <div id="content" class="hidden space-y-8">
                <div class="flex justify-end gap-4 mb-6">
                    <!-- Steps Button -->
                    <button id="stepsBtn" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Steps
                    </button>
                    <!-- Pre-condition Button -->
                    <button id="preconditionBtn" class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                        Pre-condition
                    </button>
                </div>

                <!-- Popovers -->
                <div id="stepsPopover" class="popover absolute z-10 bg-white border border-gray-200 rounded-lg shadow-lg p-4">
                    <ul class="space-y-2">
                        <li><a href="#" id="addStepsBtn" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Add Steps</a></li>
                        
                        <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Call Steps</a></li>
                    </ul>
                </div>
                <div id="preconditionPopover" class="popover absolute z-10 bg-white border border-gray-200 rounded-lg shadow-lg p-4">
                    <ul class="space-y-2">
                        <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Add Pre-condition</a></li>
                        <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Call Pre-condition</a></li>
                    </ul>
                </div>

                <form id="form" action="{{ route('issue.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <div id="stepsTable" class="overflow-x-auto hidden">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                            <thead class="bg-gray-100 border-b border-gray-200">
                                <tr>
                                    <th class="py-2 px-4 text-left text-gray-600">Test Step*</th>
                                    <th class="py-2 px-4 text-left text-gray-600">Test Data</th>
                                    <th class="py-2 px-4 text-left text-gray-600">Expected Result*</th>
                                    <th>
                                        <button id="addRowBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            +
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td class="py-4 px-4 border-b border-gray-200">
                                        <textarea name="test_step[]" class="w-full p-2 border border-gray-300 rounded-lg resize-none" rows="2" placeholder="Describe the action..."></textarea>
                                    </td>
                                    <td class="py-4 px-4 border-b border-gray-200">
                                        <textarea name="test_data[]" class="w-full p-2 border border-gray-300 rounded-lg resize-none" rows="2" placeholder="Enter the data..."></textarea>
                                    </td>
                                    <td class="py-4 px-4 border-b border-gray-200">
                                        <textarea name="expected_result[]" class="w-full p-2 border border-gray-300 rounded-lg resize-none" rows="2" placeholder="Describe the expected outcome..."></textarea>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                            Save
                        </button>
                    </div>
                </form>

        <!-- Modal -->
        <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <button id="closeModalButton" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <h2 class="text-xl font-semibold mb-4">Modal Title</h2>
                <form>
                    <div class="mb-4">
                        <label for="project" class="block text-gray-700">Project</label>
                        <select id="project" class="w-full p-2 border border-gray-300 rounded-lg">
                            <!-- Options will be added here -->
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700">Status</label>
                        <select id="status" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="summary" class="block text-gray-700">Summary</label>
                        <input type="text" id="summary" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea id="description" class="w-full p-2 border border-gray-300 rounded-lg" rows="4"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="attachment" class="block text-gray-700">Attachment</label>
                        <input type="file" id="attachment" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="flex justify-end gap-4">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Create
                        </button>
                        <button type="button" id="cancelButton" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg shadow-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    @include('admin.script')
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    // Toggle loader visibility
    function toggleLoader(show) {
        document.getElementById('loader').classList.toggle('hidden', !show);
        document.body.classList.toggle('loader-active', show);
    }

    // Show loader when the page is loading
    toggleLoader(true);

    // Hide loader after content has loaded
    window.addEventListener('load', function () {
        toggleLoader(false);
        document.getElementById('content').classList.remove('hidden');
    });

    // Handle steps button click
    document.getElementById('stepsBtn').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default action
        const popover = document.getElementById('stepsPopover');
        popover.classList.toggle('show');
        // Position popover directly below the button
        const rect = this.getBoundingClientRect();
        popover.style.top = `${rect.bottom}px`;
        popover.style.left = `${rect.left}px`;
    });

    // Handle pre-condition button click
    document.getElementById('preconditionBtn').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default action
        const popover = document.getElementById('preconditionPopover');
        popover.classList.toggle('show');
        // Position popover directly below the button
        const rect = this.getBoundingClientRect();
        popover.style.top = `${rect.bottom}px`;
        popover.style.left = `${rect.left}px`;
    });

    // Handle add row button click
    document.getElementById('addRowBtn').addEventListener('click', function (e) {
        e.preventDefault();
        const tableBody = document.querySelector('tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td class="py-4 px-4 border-b border-gray-200">
                <textarea name="test_step[]" class="w-full p-2 border border-gray-300 rounded-lg resize-none" rows="2" placeholder="Describe the action..."></textarea>
            </td>
            <td class="py-4 px-4 border-b border-gray-200">
                <textarea name="test_data[]" class="w-full p-2 border border-gray-300 rounded-lg resize-none" rows="2" placeholder="Enter the data..."></textarea>
            </td>
            <td class="py-4 px-4 border-b border-gray-200">
                <textarea name="expected_result[]" class="w-full p-2 border border-gray-300 rounded-lg resize-none" rows="2" placeholder="Describe the expected outcome..."></textarea>
            </td>
        `;
        tableBody.appendChild(newRow);
    });

    // Handle modal open/close
    document.querySelectorAll('[data-modal-target]').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById(this.dataset.modalTarget).classList.remove('hidden');
        });
    });

    document.querySelectorAll('[data-modal-close]').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('.modal').classList.add('hidden');
        });
    });

    document.getElementById('openModalButton').addEventListener('click', function() {
        document.getElementById('modal').classList.remove('hidden');
    });

    document.querySelectorAll('#closeModalButton').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });
    });
    document.getElementById('addStepsBtn').addEventListener('click', function() {
        var table = document.getElementById('stepsTable');
        if (table.classList.contains('hidden')) {
            table.classList.remove('hidden');
        } else {
            table.classList.add('hidden');
        }
    });
    document.addEventListener('DOMContentLoaded', function () {
    const addStepsBtn = document.getElementById('addStepsBtn');
    const popover = document.querySelector('.popover');

    // Show the popover
    addStepsBtn.addEventListener('click', function () {
      popover.style.display = 'block';
    });

    // Hide the popover when clicking outside
    document.addEventListener('click', function (event) {
      if (!popover.contains(event.target) && event.target !== addStepsBtn) {
        popover.style.display = 'none';
      }
    });

    // Hide the popover when an option is selected
    document.querySelectorAll('.popover-option').forEach(function (option) {
      option.addEventListener('click', function () {
        // Perform the action associated with the option
        console.log('Option selected:', option.textContent);

        // Hide the popover
        popover.style.display = 'none';
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

    });
  });
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
});

    </script>
</body>
</html>
