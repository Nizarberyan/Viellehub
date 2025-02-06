<!DOCTYPE html>
<html lang="en" x-data="{}"> <!-- Add x-data on the html tag or a parent element for Alpine.js -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentations Dashboard</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js (required for the dropdown) -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-md">
        <div class="p-6 border-b">
            <h2 class="text-2xl font-bold text-blue-600">Presentations</h2>
        </div>
        <!-- New Sidebar Code -->
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a
                            href="../presentations/dashboard.php"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors"
                    >
                        <i class="ri-dashboard-line mr-3 text-xl"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a
                            href="../presentations/calendar.php"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors"
                    >
                        <i class="ri-calendar-2-line mr-3 text-xl"></i>
                        <span class="font-medium">Calendar</span>
                    </a>
                </li>

                <!-- Subjects Dropdown -->
                <li x-data="{ open: true }" class="relative">
                    <a
                            href="#"
                            @click.prevent="open = !open"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors bg-blue-50 text-blue-600"
                    >
                        <i class="ri-book-open-line mr-3 text-xl"></i>
                        <span class="font-medium">Subjects</span>
                        <i
                                x-bind:class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'"
                                class="ml-auto text-xl"
                        ></i>
                    </a>

                    <ul
                            x-show="open"
                            x-transition
                            class="pl-6 space-y-2 mt-2 border-l-2 border-gray-100"
                    >
                        <li>
                            <a
                                    href="list.php"
                                    class="block p-2 text-sm text-gray-600 hover:text-blue-600"
                            >
                                Subject List
                            </a>
                        </li>
                        <li>
                            <a
                                    href="manage.php"
                                    class="block p-2 text-sm text-gray-600 hover:text-blue-600"
                            >
                                Manage Subjects
                            </a>
                        </li>
                        <li>
                            <a
                                    href="suggest.php"
                                    class="block p-2 text-sm text-gray-600 hover:text-blue-600"
                            >
                                Suggest Subject
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Presentations Dashboard</h1>
            <div class="flex items-center space-x-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
                    <i class="ri-add-line mr-2"></i>
                    New Presentation
                </button>
                <div class="relative">
                    <input type="text" placeholder="Search presentations..." class="pl-10 pr-4 py-2 rounded-lg border w-64">
                    <i class="ri-search-line absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Total Presentations</h3>
                        <p class="text-3xl font-bold text-blue-600">42</p>
                    </div>
                    <i class="ri-presentation-line text-3xl text-blue-300"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Upcoming</h3>
                        <p class="text-3xl font-bold text-green-600">12</p>
                    </div>
                    <i class="ri-calendar-todo-line text-3xl text-green-300"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Completed</h3>
                        <p class="text-3xl font-bold text-purple-600">28</p>
                    </div>
                    <i class="ri-check-double-line text-3xl text-purple-300"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Cancelled</h3>
                        <p class="text-3xl font-bold text-red-600">2</p>
                    </div>
                    <i class="ri-close-circle-line text-3xl text-red-300"></i>
                </div>
            </div>
        </div>

        <!-- Charts and Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Presentations by Department -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Presentations by Department</h3>
                <canvas id="departmentChart"></canvas>
            </div>

            <!-- Recent Presentations -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">Recent Presentations</h3>
                    <a href="my-presentations.php" class="text-blue-500 hover:underline">View All</a>
                </div>
                <div class="divide-y">
                    <div class="py-3 flex justify-between items-center">
                        <div>
                            <p class="font-semibold">Machine Learning Basics</p>
                            <p class="text-sm text-gray-500">Computer Science Dept.</p>
                        </div>
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Completed</span>
                    </div>
                    <div class="py-3 flex justify-between items-center">
                        <div>
                            <p class="font-semibold">Data Visualization Techniques</p>
                            <p class="text-sm text-gray-500">Statistics Dept.</p>
                        </div>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Upcoming</span>
                    </div>
                    <div class="py-3 flex justify-between items-center">
                        <div>
                            <p class="font-semibold">Advanced Cryptography</p>
                            <p class="text-sm text-gray-500">Cybersecurity Dept.</p>
                        </div>
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">In Progress</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Presentation Timeline -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-8">
            <h3 class="text-xl font-semibold mb-6">Upcoming Presentation Timeline</h3>
            <div class="space-y-4">
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-4"></div>
                    <div class="flex-1 flex justify-between items-center">
                        <div>
                            <p class="font-semibold">AI Ethics Seminar</p>
                            <p class="text-sm text-gray-500">June 15, 2024 | 10:00 AM</p>
                        </div>
                        <span class="text-sm text-gray-600">Computer Science</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-4"></div>
                    <div class="flex-1 flex justify-between items-center">
                        <div>
                            <p class="font-semibold">Quantum Computing Workshop</p>
                            <p class="text-sm text-gray-500">June 22, 2024 | 2:00 PM</p>
                        </div>
                        <span class="text-sm text-gray-600">Physics Department</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Department Chart
    const ctx = document.getElementById('departmentChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Computer Science', 'Statistics', 'Physics', 'Biology'],
            datasets: [{
                data: [12, 8, 6, 4],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
</body>
</html>