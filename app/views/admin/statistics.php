<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard - Pedagogical Monitoring System</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js for sidebar toggle -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>

    <!-- Chart.js (optional, if you need charts) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
<!-- Mobile Header: only visible on small screens -->
<header class="flex items-center justify-between bg-blue-900 text-white px-6 py-4 md:hidden">
    <h2 class="text-2xl font-bold">Admin Panel</h2>
    <button @click="sidebarOpen = !sidebarOpen" aria-label="Toggle Sidebar">
        <!-- Simple Hamburger Icon -->
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
            <path
                    d="M4 6h16M4 12h16M4 18h16"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
            />
        </svg>
    </button>
</header>

<div class="flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar -->
    <aside
            class="w-64 bg-blue-900 text-white p-6 absolute md:static inset-y-0 left-0 transform transition-transform duration-300 ease-in-out z-10 md:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <!-- Sidebar Title: visible on md+ screens -->
        <h2 class="text-2xl font-bold mb-10 hidden md:block">Admin Panel</h2>

        <nav class="space-y-2">
            <!-- Dashboard Link -->
            <a href="#" class="block py-2 px-4 bg-blue-700 rounded text-white flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 19v-6a2 2 0 00-2-2H5
                                 a2 2 0 00-2 2v6a2 2 0
                                 002 2h2a2 2 0 002-2zm0
                                 0V9a2 2 0 012-2h2a2 2
                                 0 012 2v10m-6 0a2 2 0
                                 002 2h2a2 2 0 002-2m0
                                 0V5a2 2 0 012-2h2a2 2
                                 0 012 2v14a2 2 0 01-2
                                 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Dashboard
            </a>

            <!-- Users Link -->
            <a href="users.php" class="block py-2 px-4 hover:bg-blue-700 rounded text-gray-300 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4
                                 0 11-8 0 4 4 0 018 0zM12
                                 14a8 8 0 00-8 8h16a8 8
                                 0 00-8-8z"/>
                </svg>
                Users
            </a>

            <!-- Presentations Link -->
            <a href="#" class="block py-2 px-4 hover:bg-blue-700 rounded text-gray-300 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6.253v13m0-13C
                                 10.832 5.477 9.246 5
                                 7.5 5S4.168 5.477 3
                                 6.253v13C4.168
                                 18.477 5.754 18 7.5
                                 18s3.332.477 4.5
                                 1.253m0-13C13.168 5.477
                                 14.754 5 16.5 5c1.747
                                 0 3.332.477 4.5
                                 1.253v13C19.832 18.477
                                 18.247 18 16.5 18c-1.746
                                 0-3.332.477-4.5
                                 1.253"/>
                </svg>
                Presentations
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
        <!-- Header -->
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Overview</h1>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Welcome, Admin</span>
                <!-- Avatar Placeholder -->
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                    AD
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Total Users</h3>
                        <p class="text-2xl font-bold text-blue-600">1,234</p>
                    </div>
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3
                                     0 00-5.356-1.857M17
                                     20H7m10 0v-2c0-.656-
                                     .126-1.283-.356-
                                     1.857M7 20H2v-2a3 3 0
                                     015.356-1.857M7
                                     20v-2c0-.656.126-
                                     1.283.356-1.857m0
                                     0a5.002 5.002 0
                                     019.288 0M15
                                     7a3 3 0 11-6 0 3 3
                                     0 016 0zm6 3a2
                                     2 0 11-4 0 2
                                     2 0 014 0zM7
                                     10a2 2 0
                                     11-4 0 2
                                     2 0 014 0z"/>
                    </svg>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Presentations</h3>
                        <p class="text-2xl font-bold text-green-600">456</p>
                    </div>
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2
                                     4-4m6 2a9 9 0
                                     11-18 0 9 9
                                     0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Teachers</h3>
                        <p class="text-2xl font-bold text-purple-600">87</p>
                    </div>
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12
                                     6.253v13m0-13C10.832
                                     5.477 9.246 5 7.5 5S4.168
                                     5.477 3 6.253v13C4.168
                                     18.477 5.754 18 7.5
                                     18s3.332.477 4.5
                                     1.253m0-13C13.168 5.477
                                     14.754 5 16.5 5c1.747
                                     0 3.332.477 4.5
                                     1.253v13C19.832 18.477
                                     18.247 18 16.5 18c-1.746
                                     0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Students</h3>
                        <p class="text-2xl font-bold text-red-600">1,147</p>
                    </div>
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12
                                     4.354a4 4 0 110
                                     5.292M15
                                     21H3v-1a6 6 0
                                     0112 0v1zm0
                                     0h6v-1a6 6 0
                                     00-9-5.197M13
                                     7a4 4 0 11-8
                                     0 4 4 0
                                     018 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>