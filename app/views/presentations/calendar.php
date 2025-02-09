<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false, subjectOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentation Calendar</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100">


<!-- Main Container: Sidebar + Content -->
<div class="flex">
    <!-- Sidebar -->
    <div
            class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-md transform transition-transform duration-300 md:relative md:w-64"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-x-full"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-full"
    >
        <!-- Sidebar Close Button for Mobile -->
        <button @click="sidebarOpen = false"
                class="md:hidden absolute top-4 right-4 text-gray-600">
            <i class="ri-close-line text-2xl"></i>
        </button>

        <!-- Logo and Branding -->
        <div class="p-6 border-b flex items-center justify-center">
            <img src="../../../public/logo-white.png" alt="School Logo" class="h-12 w-auto">
        </div>

        <!-- Navigation Menu -->
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="dashboard.php"
                       class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <i class="ri-dashboard-line mr-3 text-xl"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>
                <li>
                <?php if ($_SESSION['user_role'] == 'teacher') {
                    echo '<li>
                    <a href="https://www.instagram.com"
                       class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <i class="ri-dashboard-line mr-3 text-xl"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>';
                }?>
                <li>
                    <a href="../presentations/calendar.php"
                       class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                        <i class="ri-calendar-2-line mr-3 text-xl"></i>
                        <span class="font-medium">Calendar</span>
                    </a>
                </li>
                <!-- Subjects Dropdown -->
                <li x-data="{ open: true }" class="relative">
                    <a href="#"
                       @click.prevent="open = !open"
                       class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors bg-blue-50 text-blue-600">
                        <i class="ri-book-open-line mr-3 text-xl"></i>
                        <span class="font-medium">Subjects</span>
                        <i :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'" class="ml-auto text-xl"></i>
                    </a>
                    <ul x-show="open"
                        x-transition
                        class="pl-6 space-y-2 mt-2 border-l-2 border-gray-100">
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'teacher') : ?>
                            <li>
                                <a
                                        href="../subjects/list.php"
                                        class="block p-2 text-sm text-gray-600 hover:text-blue-600"
                                >
                                    Subject List
                                </a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="../subjects/manage.php"
                               class="block p-2 text-sm text-gray-600 hover:text-blue-600">
                                Manage Subjects
                            </a>
                        </li>
                        <li>
                            <a href="../subjects/suggest.php"
                               class="block p-2 text-sm text-gray-600 hover:text-blue-600">
                                Suggest Subject
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-0 md:ml-64">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Filters -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <select id="departmentFilter" class="form-select w-full px-3 py-2 border rounded">
                        <option value="">All Departments</option>
                        <option value="computer-science">Computer Science</option>
                        <option value="mathematics">Mathematics</option>
                        <option value="physics">Physics</option>
                        <option value="biology">Biology</option>
                    </select>
                    <select id="weekFilter" class="form-select w-full px-3 py-2 border rounded">
                        <option value="">All Weeks</option>
                        <option value="next-week">Next Week</option>
                        <option value="this-week">This Week</option>
                    </select>
                    <input type="text" id="searchInput" placeholder="Search presentations..."
                           class="w-full px-3 py-2 border rounded">
                    <button id="applyFilters"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Apply Filters
                    </button>
                </div>
            </div>

            <!-- Calendar Container -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8 flex justify-center">
                <div id="calendar" class="w-full md:w-auto"></div>
            </div>

            <!-- Upcoming Presentations -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Upcoming Presentations</h3>
                <div class="divide-y">
                    <!-- Presentation List Item 1 -->
                    <div class="py-4 flex justify-between items-center hover:bg-gray-50 px-4 rounded">
                        <div>
                            <p class="font-semibold text-gray-800">Machine Learning Fundamentals</p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Presenter:</span> Dr. John Patel |
                                <span class="font-medium">Department:</span> Computer Science
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-700">June 15, 2024 | 10:00 AM</p>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    Upcoming
                                </span>
                        </div>
                    </div>
                    <!-- Presentation List Item 2 -->
                    <div class="py-4 flex justify-between items-center hover:bg-gray-50 px-4 rounded">
                        <div>
                            <p class="font-semibold text-gray-800">Advanced Data Visualization</p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Presenter:</span> Prof. Sarah Miller |
                                <span class="font-medium">Department:</span> Statistics
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-700">June 22, 2024 | 2:00 PM</p>
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                    Confirmed
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Main Content -->
</div><!-- End Main Container -->

<!-- Footer -->
<footer class="bg-white shadow-md mt-8">
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <p class="text-gray-500 text-sm">&copy; 2024 University Presentations. All rights reserved.</p>
            <div class="flex space-x-4">
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12S0 5.373 0 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47H13.87v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Twitter</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 14.002-7.496 14.002-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Initialize FullCalendar
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                {
                    title: 'Machine Learning Fundamentals',
                    start: '2024-06-15T10:00:00',
                    end: '2024-06-15T11:30:00',
                    extendedProps: {
                        department: 'Computer Science',
                        presenter: 'Dr. John Patel'
                    }
                },
                {
                    title: 'Advanced Data Visualization',
                    start: '2024-06-22T14:00:00',
                    end: '2024-06-22T15:30:00',
                    extendedProps: {
                        department: 'Statistics',
                        presenter: 'Prof. Sarah Miller'
                    }
                }
            ],
            eventClick: function (info) {
                alert(
                    'Presentation: ' + info.event.title + '\n' +
                    'Presenter: ' + info.event.extendedProps.presenter + '\n' +
                    'Department: ' + info.event.extendedProps.department
                );
            }
        });
        calendar.render();
    });

    // Filter Logic (example)
    const applyFiltersBtn = document.getElementById('applyFilters');
    applyFiltersBtn.addEventListener('click', () => {
        const departmentFilter = document.getElementById('departmentFilter').value;
        const weekFilter = document.getElementById('weekFilter').value;
        const searchInput = document.getElementById('searchInput').value;

        console.log('Filters Applied:', {
            department: departmentFilter,
            week: weekFilter,
            search: searchInput
        });

        // Update your presentation data here and re-render calendar if needed
    });
</script>

</body>
</html>