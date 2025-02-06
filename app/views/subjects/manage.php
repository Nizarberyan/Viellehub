<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Subjects Management</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Remix Icon library -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- Alpine.js (required for the dropdown functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-md">
        <div class="p-6 border-b">
            <h2 class="text-2xl font-bold text-blue-600">Menu</h2>
        </div>
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
            <h1 class="text-3xl font-bold text-gray-800">Subjects Management</h1>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input
                            type="text"
                            id="searchSubjects"
                            placeholder="Search subjects..."
                            class="pl-10 pr-4 py-2 rounded-lg border w-64"
                    >
                    <i class="ri-search-line absolute left-3 top-3 text-gray-400"></i>
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center create-subject">
                    <i class="ri-add-line mr-2"></i>
                    Create Subject
                </button>
            </div>
        </div>

        <!-- Subjects Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Total Subjects</h3>
                        <p class="text-3xl font-bold text-blue-600">42</p>
                    </div>
                    <i class="ri-book-open-line text-3xl text-blue-300"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Active Subjects</h3>
                        <p class="text-3xl font-bold text-green-600">35</p>
                    </div>
                    <i class="ri-checkbox-circle-line text-3xl text-green-300"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-500 text-sm">Pending Approval</h3>
                        <p class="text-3xl font-bold text-yellow-600">7</p>
                    </div>
                    <i class="ri-time-line text-3xl text-yellow-300"></i>
                </div>
            </div>
        </div>

        <!-- Subjects List -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Subject List</h2>
                <div class="flex items-center space-x-4">
                    <select class="px-3 py-2 border rounded-lg text-sm">
                        <option>All Departments</option>
                        <option>Computer Science</option>
                        <option>Mathematics</option>
                        <option>Physics</option>
                    </select>
                    <select class="px-3 py-2 border rounded-lg text-sm">
                        <option>Status: All</option>
                        <option>Active</option>
                        <option>Pending</option>
                        <option>Archived</option>
                    </select>
                </div>
            </div>

            <!-- Subjects Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" class="form-checkbox">
                        </th>
                        <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subject Name
                        </th>
                        <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Department
                        </th>
                        <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Students
                        </th>
                        <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="p-4">
                            <input type="checkbox" class="form-checkbox">
                        </td>
                        <td class="p-4">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        Machine Learning Fundamentals
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        ML-101
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                Computer Science
              </span>
                        </td>
                        <td class="p-4 text-sm text-gray-500">
                            <div class="flex -space-x-2">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/men/1.jpg" alt=""/>
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/women/2.jpg" alt=""/>
                                <span class="ml-2 text-gray-500">+3 more</span>
                            </div>
                        </td>
                        <td class="p-4">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                Active
              </span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-500 hover:text-blue-600" title="View Details">
                                    <i class="ri-eye-line"></i>
                                </button>
                                <button class="text-green-500 hover:text-green-600" title="Edit">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-600" title="Archive">
                                    <i class="ri-archive-line"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Additional rows can be added in the same manner. -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 bg-white border-t flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Showing 1-10 of 42 subjects
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border rounded hover:bg-gray-100">
                        Previous
                    </button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-100">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick Actions Modal -->
        <div
                id="quickActionsModal"
                class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50"
        >
            <div class="bg-white rounded-lg p-8 w-96 max-w-full">
                <h3 class="text-xl font-semibold mb-4">Quick Actions</h3>
                <div class="space-y-4">
                    <button class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center justify-center">
                        <i class="ri-add-circle-line mr-2"></i>
                        Create New Subject
                    </button>
                    <button class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center justify-center">
                        <i class="ri-upload-cloud-line mr-2"></i>
                        Import Subjects
                    </button>
                    <button class="w-full bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 flex items-center justify-center">
                        <i class="ri-file-excel-line mr-2"></i>
                        Export Subjects
                    </button>
                </div>
                <div class="mt-6 flex justify-end">
                    <button
                            id="closeQuickActionsModal"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Quick Actions Modal Handling
    const quickActionsBtn = document.querySelector('button[class*="create-subject"]');
    const quickActionsModal = document.getElementById('quickActionsModal');
    const closeQuickActionsModal = document.getElementById('closeQuickActionsModal');

    quickActionsBtn.addEventListener('click', () => {
        quickActionsModal.classList.remove('hidden');
        quickActionsModal.classList.add('flex');
    });

    closeQuickActionsModal.addEventListener('click', () => {
        quickActionsModal.classList.remove('flex');
        quickActionsModal.classList.add('hidden');
    });

    // Search and Filter Functionality
    const searchInput = document.getElementById('searchSubjects');
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        // You can implement proper search/filter logic here
        console.log('Searching for:', searchTerm);
    });
</script>
</body>
</html>