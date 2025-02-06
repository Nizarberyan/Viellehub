<!DOCTYPE html>
<html lang="en" x-data="{
    sidebarOpen: false,
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
    },
    modalOpen: false
}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentations Dashboard</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Mobile Header -->
    <div class="md:hidden flex justify-between items-center p-4 bg-white shadow-md">
        <h2 class="text-2xl font-bold text-blue-600">Presentations</h2>
        <button @click="toggleSidebar()" class="text-2xl">
            <i class="ri-menu-line"></i>
        </button>
    </div>

    <!-- Sidebar -->
    <div
            class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-md transform transition-transform duration-300
           md:relative md:w-64"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-x-full"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-full"
    >
        <!-- Sidebar Close Button for Mobile -->
        <button
                @click="sidebarOpen = false"
                class="md:hidden absolute top-4 right-4 text-gray-600"
        >
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
                                :class="open ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'"
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
                                    href="../subjects/list.php"
                                    class="block p-2 text-sm text-gray-600 hover:text-blue-600"
                            >
                                Subject List
                            </a>
                        </li>
                        <li>
                            <a
                                    href="../subjects/manage.php"
                                    class="block p-2 text-sm text-gray-600 hover:text-blue-600"
                            >
                                Manage Subjects
                            </a>
                        </li>
                        <li>
                            <a
                                    href="../subjects/suggest.php"
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
    <div class="flex-1 p-4 md:p-10 overflow-x-hidden">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Presentations Dashboard</h1>
            <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-4 w-full md:w-auto">
                <!-- Button that triggers the modal -->
                <button
                        @click="modalOpen = true"
                        class="w-full md:w-auto bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center justify-center"
                >
                    <i class="ri-add-line mr-2"></i>
                    New Presentation
                </button>
                <div class="relative w-full md:w-64">
                    <input
                            type="text"
                            placeholder="Search presentations..."
                            class="w-full pl-10 pr-4 py-2 rounded-lg border"
                    >
                    <i class="ri-search-line absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
            <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Total Presentations</h3>
                        <p class="text-2xl md:text-3xl font-bold text-blue-600">42</p>
                    </div>
                    <i class="ri-presentation-line text-2xl md:text-3xl text-blue-300"></i>
                </div>
            </div>
            <!-- Additional stat cards can go here -->
        </div>

        <!-- Presentations by Department (Dummy Data) -->
        <div class="bg-white p-4 md:p-6 rounded-lg shadow-md mt-8 max-w-screen-lg mx-auto">
            <!-- Headline -->
            <h3 class="text-xl font-semibold mb-4">Presentations by Department</h3>

            <!-- Responsive Table -->
            <table class="table-fixed w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium w-1/4">Department</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium w-1/4">Presenter</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium w-1/3">Title</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium w-1/6">Date</th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b">
                    <td class="px-4 py-2">Computer Science</td>
                    <td class="px-4 py-2">Alice Johnson</td>
                    <td class="px-4 py-2">Intro to AI</td>
                    <td class="px-4 py-2 whitespace-nowrap">May 12</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Statistics</td>
                    <td class="px-4 py-2">Bob Brown</td>
                    <td class="px-4 py-2">Data Analysis 101</td>
                    <td class="px-4 py-2 whitespace-nowrap">May 15</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Physics</td>
                    <td class="px-4 py-2">Carol White</td>
                    <td class="px-4 py-2">Quantum Mechanics</td>
                    <td class="px-4 py-2 whitespace-nowrap">May 18</td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Presentation Timeline (Dummy Data) -->
        <div class="bg-white p-4 md:p-6 rounded-lg shadow-md mt-8">
            <h3 class="text-xl font-semibold mb-6">Upcoming Presentation Timeline</h3>
            <div class="space-y-4">
                <div class="flex items-center">
                    <div class="bg-blue-500 h-6 w-6 rounded-full mr-4"></div>
                    <div>
                        <p class="font-semibold">May 12 - Intro to AI</p>
                        <p class="text-sm text-gray-600">Alice Johnson, Computer Science</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="bg-blue-500 h-6 w-6 rounded-full mr-4"></div>
                    <div>
                        <p class="font-semibold">May 15 - Data Analysis 101</p>
                        <p class="text-sm text-gray-600">Bob Brown, Statistics</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="bg-blue-500 h-6 w-6 rounded-full mr-4"></div>
                    <div>
                        <p class="font-semibold">May 18 - Quantum Mechanics</p>
                        <p class="text-sm text-gray-600">Carol White, Physics</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Creating New Presentation -->
<div
        class="fixed inset-0 flex items-center justify-center z-50"
        x-show="modalOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
>
    <!-- Overlay -->
    <div
            class="absolute inset-0 bg-black bg-opacity-50"
            @click="modalOpen = false"
    ></div>

    <!-- Modal Content -->
    <div
            class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 p-6 relative z-10"
            @click.stop
    >
        <h2 class="text-xl font-semibold mb-4">Create New Presentation</h2>

        <!-- Simple Form -->
        <form action="#" method="POST" class="space-y-4">
            <div>
                <label for="presentationTitle" class="block font-medium mb-1">Title:</label>
                <input
                        type="text"
                        id="presentationTitle"
                        name="presentationTitle"
                        class="w-full px-3 py-2 border rounded"
                        placeholder="Enter presentation title..."
                />
            </div>

            <div>
                <label for="department" class="block font-medium mb-1">Department:</label>
                <input
                        type="text"
                        id="department"
                        name="department"
                        class="w-full px-3 py-2 border rounded"
                        placeholder="Enter department..."
                />
            </div>

            <div>
                <label for="presenter" class="block font-medium mb-1">Presenter:</label>
                <input
                        type="text"
                        id="presenter"
                        name="presenter"
                        class="w-full px-3 py-2 border rounded"
                        placeholder="Enter presenter name..."
                />
            </div>

            <div>
                <label for="presentationDate" class="block font-medium mb-1">Date:</label>
                <input
                        type="date"
                        id="presentationDate"
                        name="presentationDate"
                        class="w-full px-3 py-2 border rounded"
                />
            </div>

            <div class="flex justify-end space-x-2">
                <button
                        type="button"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300"
                        @click="modalOpen = false"
                >
                    Cancel
                </button>
                <button
                        type="submit"
                        class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>