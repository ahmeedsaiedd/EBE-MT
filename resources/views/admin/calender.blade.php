<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EBE-MT</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .calendar-table th, .calendar-table td {
            width: 14%;
            text-align: center;
        }
        .calendar-table td {
            padding: 10px;
        }
    </style>
    @include('admin.css')
</head>
<body :class="{ 'overflow-hidden': isSideMenuOpen }" class="bg-gray-50 dark:bg-gray-900">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('admin.sidebar')
        @include('admin.header')

        <div class="flex-1 overflow-auto p-6">
            <!-- Header -->

            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol id="breadcrumb" class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <!-- Breadcrumb links will be populated by JavaScript -->
                </ol>
            </nav>

            <!-- Calendar Section -->
            <section class="ftco-section">
                <div class="container">
                    <div class="row justify-center">
                        <div class="col-md-6 text-center mb-5">
                            <h2 class="heading-section text-2xl font-bold">Calendar</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="calendar bg-white shadow-md rounded-lg p-4">
                                <!-- Calendar Header -->
                                <div class="header flex justify-between items-center py-2">
                                    <div>
                                        <label for="year-select" class="mr-2">Year:</label>
                                        <select id="year-select" class="border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <!-- Options will be populated by JavaScript -->
                                        </select>
                                    </div>
                                    <div>
                                        <label for="month-select" class="mr-2">Month:</label>
                                        <select id="month-select" class="border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="0">January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                            <option value="4">May</option>
                                            <option value="5">June</option>
                                            <option value="6">July</option>
                                            <option value="7">August</option>
                                            <option value="8">September</option>
                                            <option value="9">October</option>
                                            <option value="10">November</option>
                                            <option value="11">December</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Calendar Table -->
                                <table class="calendar-table min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Sun</th>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Mon</th>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Tue</th>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Wed</th>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Thu</th>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Fri</th>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Sat</th>
                                        </tr>
                                    </thead>
                                    <tbody id="calendar-table-body" class="bg-white divide-y divide-gray-200">
                                        <!-- Calendar days will be populated by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Include FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

    <!-- Include FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const yearSelect = document.getElementById('year-select');
            const monthSelect = document.getElementById('month-select');
            const tableBody = document.getElementById('calendar-table-body');
            const breadcrumb = document.getElementById('breadcrumb');
            const currentYear = new Date().getFullYear();
            
            // Populate year dropdown
            for (let i = currentYear - 10; i <= currentYear + 10; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                if (i === currentYear) option.selected = true;
                yearSelect.appendChild(option);
            }

            // Function to update calendar
            function updateCalendar() {
                const selectedYear = yearSelect.value;
                const selectedMonth = monthSelect.value;
                const firstDay = new Date(selectedYear, selectedMonth, 1);
                const lastDay = new Date(selectedYear, parseInt(selectedMonth) + 1, 0);
                
                const daysInMonth = Array.from({ length: lastDay.getDate() }, (_, i) => i + 1);
                const firstDayOfWeek = firstDay.getDay();
                const totalDays = daysInMonth.length + firstDayOfWeek;

                tableBody.innerHTML = '';

                // Create rows for weeks
                let row = document.createElement('tr');
                for (let i = 0; i < firstDayOfWeek; i++) {
                    row.appendChild(document.createElement('td'));
                }

                daysInMonth.forEach((day, i) => {
                    if ((firstDayOfWeek + i) % 7 === 0 && i > 0) {
                        tableBody.appendChild(row);
                        row = document.createElement('tr');
                    }
                    const cell = document.createElement('td');
                    cell.className = 'border px-2 py-1';
                    cell.textContent = day;
                    row.appendChild(cell);
                });

                // Fill the remaining cells for the last week
                const remainingCells = 7 - (totalDays % 7);
                for (let i = 0; i < remainingCells && remainingCells < 7; i++) {
                    row.appendChild(document.createElement('td'));
                }

                if (row.children.length > 0) {
                    tableBody.appendChild(row);
                }
            }

            // Initialize calendar
            updateCalendar();

            yearSelect.addEventListener('change', updateCalendar);
            monthSelect.addEventListener('change', updateCalendar);

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
