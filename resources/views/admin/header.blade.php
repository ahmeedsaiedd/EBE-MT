<!-- Backdrop -->

<head>
    <html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .dropdown-menu {
            display: none;
        }

        .dropdown-menu.block {
            display: block;
        }

        #checkbox-form-modal {
            display: none;
        }

        .spinner {
            border-top-color: transparent;
            border-radius: 50%;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #3490dc;
            /* Blue color */
            width: 3rem;
            height: 3rem;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Loader container */
        .loader-container {
            position: fixed;
            /* Ensure it covers the viewport */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            /* Slight white overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Ensure it is on top of other content */
        }

        /* Hide overflow on body when loader is visible */
        body.loader-active {
            overflow: hidden;
        }
    </style>

</head>
{{-- <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-0 flex items-end bg-black bg-opacity-0 sm:items- sm:justify-center"></div> --}}
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500 dark:text-gray-400">



        <div class="px-6 my-6">

        </div>
    </div>
</aside>

<div class="flex flex-col flex-1 w-full">

    <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">


        <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">

            <!-- Search input -->
            <div class="flex justify-center flex-1 lg:mr-32">
                <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                    <ul
                        class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-4 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 items-center justify-center">

                        <li class="relative">
                            <button
                                class="dropdown-toggle flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                                Your Work
                                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div
                                class="dropdown-menu absolute mt-2 bg-white shadow-lg rounded-md w-44 max-h-60 overflow-y-auto z-10 hidden">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                    <li><a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Work
                                            Item 1</a></li>
                                    <li><a href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Work
                                            Item 2</a></li>
                                    <!-- More items here -->
                                </ul>
                            </div>
                        </li>

                        <div class="relative inline-block text-left">
                            <button id="dropdownButton"
                                class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                                Projects
                                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div id="dropdownMenu"
                                class="absolute left-0 mt-2 bg-white shadow-lg rounded-md w-44 max-h-60 overflow-y-auto z-10 hidden">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                    @forelse($projects->take(5) as $project)
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-project="{{ $project->id }}">
                                                {{ $project->name }}
                                            </a>
                                        </li>
                                    @empty
                                        <li>
                                            <span class="block px-4 py-2 text-sm text-gray-700">
                                                No projects available
                                            </span>
                                        </li>
                                    @endforelse
                                </ul>

                                @if ($projects->count() > 5)
                                    <div class="px-4 py-2">
                                        <a href="{{ route('admin.projects') }}"
                                            class="text-blue-500 hover:underline text-sm">
                                            See More
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>



                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                                Filters
                                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                        </li>

                        {{-- <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                                Dashboards
                                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                        </li> --}}

                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                                Teams
                                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                        </li>

                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                                Apps
                                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                        </li>

                        <li>
                            <a href="#" id="openModalButton"
                                class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Create
                            </a>
                        </li>


                    </ul>


                </div>
            </div>
            <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto  w-full hidden">
                <div class="relative mx-auto p-4 w-full max-w-md">
                    <div class="bg-white shadow-lg rounded-md p-4 max-h-[100vh] overflow-auto">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Create Issue</h3>
                            <button id="closeModalButton" class="text-gray-600 hover:text-gray-900">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form id="issueForm" action="{{ route('issue.store') }}" method="POST"
                            enctype="multipart/form-data" class="mt-4">

                            @csrf
                            <!-- Project Dropdown -->
                            <div class="mb-4">
                                <label for="project" class="block text-sm font-medium text-gray-700">Select
                                    Project</label>
                                <select name="project_id" id="project_id"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status Dropdown -->
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status_id" id="status_id"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Summary Input -->
                            <div class="mb-4">
                                <label for="summary" class="block text-sm font-medium text-gray-700">Summary</label>
                                <input type="text" name="summary" id="summary"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            </div>

                            <!-- Description Textarea -->
                            <div class="mb-4">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"></textarea>
                            </div>

                            <!-- Attachment Upload -->
                            <div class="mb-4">
                                <label for="attachment"
                                    class="block text-sm font-medium text-gray-700">Attachment</label>
                                <input type="file" name="attachments" id="attachments"
                                    class="mt-1 block w-full text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            </div>

                            <!-- Assignee Dropdown -->
                            <div class="mb-4">
                                <label for="assignee" class="block text-sm font-medium text-gray-700">Assignee</label>
                                <select name="assignee_id" id="assignee"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    @foreach ($users as $user)
                                        @if ($user->user_type != 1)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-2">
                                <button type="button" id="closeModalButton"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Create
                                </button>
                                
                        </form>
                    </div>
                </div>
            </div>




            <ul class="flex items-center flex-shrink-0 space-x-6">
                <!-- Theme toggler -->
                <li class="flex">
                    <button class="rounded-md focus:outline-none focus:shadow-outline-purple" @click="toggleTheme"
                        aria-label="Toggle color mode">
                        <template x-if="!dark">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                        </template>
                        <template x-if="dark">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </template>
                    </button>
                </li>
                <!-- Notifications menu -->
                <li class="relative">
                    <button class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                        @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                        aria-label="Notifications" aria-haspopup="true">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                            </path>
                        </svg>
                        <!-- Notification badge -->
                        <span aria-hidden="true"
                            class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                    </button>
                    <template x-if="isNotificationsMenuOpen">

                        <ul x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            @click.away="closeNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                            class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700">
                            <li class="flex">
                                <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="#">
                                    <span>Messages</span>
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                        13
                                    </span>
                                </a>
                            </li>
                            <li class="flex">
                                <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="#">
                                    <span>Sales</span>
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                        2
                                    </span>
                                </a>
                            </li>
                            <li class="flex">
                            </li>
                        </ul>
                    </template>
                </li>
                <!-- Profile menu -->

                <li class="relative">

                    <template x-if="isProfileMenuOpen">

                </li>

                </template>
            </ul>
        </div>
        <div class="relative inline-block text-left">


        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('createButton').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default form submission or link action

                // Show the loading indicator
                document.getElementById('loading').classList.remove('hidden');

                // Delay the redirection to allow the loading indicator to be visible
                setTimeout(function() {
                    window.location.href = "{{ route('issue') }}";
                }, 500); // Adjust the delay as needed
            });
        });
        document.getElementById('issueForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Show the loading indicator
            document.getElementById('loading').classList.remove('hidden');

            // Create a FormData object to handle file uploads
            var formData = new FormData(this);

            // Send the form data using fetch API
            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                }).then(response => response.json())
                .then(data => {
                    // Hide the loading indicator
                    document.getElementById('loading').classList.add('hidden');

                    // Redirect to the desired route
                    window.location.href = '{{ route('admin.userstory') }}';
                }).catch(error => {
                    // Handle errors
                    console.error('Error:', error);
                    // Hide the loading indicator
                    document.getElementById('loading').classList.add('hidden');
                });
            // JavaScript to handle modal visibility
            document.getElementById('openModalButton').addEventListener('click', function() {
                document.getElementById('modal').classList.remove('hidden');
            });

            document.getElementById('closeModalButton').addEventListener('click', function() {
                document.getElementById('modal').classList.add('hidden');
            });

            document.addEventListener('click', function(event) {
                if (event.target === document.getElementById('modal')) {
                    document.getElementById('modal').classList.add('hidden');
                }
            });

            // JavaScript to handle form submission and redirection
            document.getElementById('issueForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                const formData = new FormData(this);
                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = "{{ route('admin.userstory') }}";
                        } else {
                            // Handle errors or display error messages
                            console.error('Error:', data);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
        @include('admin.script')
    </script>
