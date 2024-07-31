<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <title>EBE Projects</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        .custom-spacing {
    margin-left: 8px; /* Adjust this value as needed */
}
.dropdown-menu {
            display: none;
        }

        .dropdown-menu.block {
            display: block;
        }

        #checkbox-form-modal {
            display: none;
        }

    </style>
    @include('admin.css')
    <!-- Add any additional CSS here if needed -->
</head>
<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900">
        @include('admin.sidebar')
        @include('admin.header')
    <main class="p-6">
         <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol id="breadcrumb" class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <!-- Breadcrumb links will be populated by JavaScript -->
        </ol>
    </nav>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects as $project)
                <!-- Card Component -->
                <div class="max-w-sm p-6 bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-700 transition-transform transform hover:scale-105">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white hover:text-blue-500 transition-colors duration-300">
                            {{ $project->name }}
                        </h5>
                    </a>
                    <p class="mb-3 text-gray-600 dark:text-gray-400">
                        {{ $project->description }}
                    </p>
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg hover:from-blue-600 hover:to-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800 transition-colors duration-300">
                        View Project
                        {{-- <svg class="rtl:rotate-180 w-4 h-4 ms-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg> --}}
                    </a>
                    
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-600 dark:text-gray-400">No projects found.</p>
            @endforelse
        </div>
    </main>

    @include('admin.script')
    <!-- Add any additional scripts here if needed -->
</body>
<script>
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
</html>
