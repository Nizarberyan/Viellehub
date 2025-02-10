<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Suggestion System</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Remix Icon library -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Alpine.js (for sidebar dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <header class="flex items-center justify-between bg-white shadow-md p-4 md:hidden">

        <img src="../../../public/logo-white.png" alt="Logo" class="h-8 w-auto">
        <button
                class="text-gray-600 focus:outline-none"
                @click="sidebarOpen = !sidebarOpen"
                aria-label="Toggle sidebar"
        >
            <i class="ri-menu-line text-2xl"></i>
        </button>
    </header>
    <!-- Sidebar -->
    <div
            class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-md transform transition-transform duration-200
               md:static md:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="p-6 border-b flex items-center justify-center">
            <!-- Logo instead of "Menu" text -->
            <img src="../../../public/logo-white.png" alt="Logo" class="h-12 w-auto">
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
                <li x-data="{ open: false }" class="relative">
                    <a
                            href="#"
                            @click.prevent="open = !open"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors"
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
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'teacher') : ?>
                            <li>
                                <a
                                        href="list.php"
                                        class="block p-2 text-sm text-gray-600 hover:text-blue-600"
                                >
                                    Subject List
                                </a>
                            </li>
                        <?php endif; ?>
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
    <!-- Hamburger button for mobile -->
    <div class="flex-1 md:ml-64">
        <header class="md:hidden flex items-center bg-white shadow p-4">
            <button
                    class="text-gray-700 focus:outline-none"
                    @click="sidebarOpen = !sidebarOpen"
            >
                <i class="ri-menu-line text-2xl"></i>
            </button>
            <h2 class="ml-4 text-xl font-bold text-blue-600">Subject Suggestion System</h2>
        </header>

        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Student Suggestion Column -->
                <div class="md:col-span-2 bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-blue-600 mb-6">
                        <i class="ri-lightbulb-line mr-2"></i>Subject Suggestion
                    </h2>

                    <!-- Suggestion Form -->
                    <form action="../../controllers/SubjectController.php?method=create" method="POST" id="suggestionForm" class="space-y-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2" for="title">
                                Subject Title
                            </label>
                            <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    required
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Enter a concise subject title"
                            >
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2" for="description">
                                Subject Description
                            </label>
                            <textarea
                                    id="description"
                                    name="description"
                                    rows="4"
                                    required
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Provide a detailed description of the proposed subject"
                            ></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2" for="resources">
                                References/Resources
                            </label>
                            <textarea
                                    id="resources"
                                    name="resources"
                                    rows="3"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Optional: List any relevant books, papers, or resources"
                            ></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button
                                    type="submit"
                                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300 flex items-center"
                            >
                                <i class="ri-send-plane-line mr-2"></i>
                                Submit Suggestion
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Teacher Review Column -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-green-600 mb-6">
                        <i class="ri-clipboard-line mr-2"></i>Pending Suggestions
                    </h2>

                    <!-- Suggestion Cards -->
                    <div id="SubjectsContainer" class="space-y-4">
                    </div>

                    <!-- Assign Students Modal Trigger -->
                    <div class="mt-6">
                        <button
                                id="assignStudentsBtn"
                                class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition"
                        >
                            <i class="ri-group-line mr-2"></i>Assign Students
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assign Students Modal -->
        <div
                id="assignStudentsModal"
                class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50"
        >
            <div class="bg-white rounded-lg p-8 w-96 max-w-full">
                <h3 class="text-xl font-semibold mb-4">Assign Students to Subject</h3>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Selected Subject
                    </label>
                    <input
                            type="text"
                            readonly
                            class="w-full px-3 py-2 border rounded-lg bg-gray-100"
                            value="Machine Learning Ethics"
                    >
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Select Students (Minimum 2)
                    </label>
                    <select
                            multiple
                            class="w-full px-3 py-2 border rounded-lg"
                            size="5"
                    >
                        <option value="student1">John Doe</option>
                        <option value="student2">Jane Smith</option>
                        <option value="student3">Mike Johnson</option>
                        <option value="student4">Sarah Williams</option>
                        <option value="student5">Alex Brown</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2">
                    <button
                            id="cancelAssignBtn"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300"
                    >
                        Cancel
                    </button>
                    <button
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"
                    >
                        Assign
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Suggestion Form Submission
    /*document.getElementById('suggestionForm').addEventListener('submit', function(e) {


        const formData = {
            title: document.getElementById('title').value,
            description: document.getElementById('description').value,
            department: document.getElementById('department').value,
            references: document.getElementById('references').value
        };

        // Simulated AJAX submission
        console.log('Suggestion Submitted:', formData);

        // Reset form
        this.reset();

        // Show success notification
        alert('Subject suggestion submitted successfully!');
    });*/

    // Assign Students Modal Handling
    const assignStudentsBtn = document.getElementById('assignStudentsBtn');
    const assignStudentsModal = document.getElementById('assignStudentsModal');
    const cancelAssignBtn = document.getElementById('cancelAssignBtn');

    assignStudentsBtn.addEventListener('click', () => {
        assignStudentsModal.classList.remove('hidden');
        assignStudentsModal.classList.add('flex');
    });

    cancelAssignBtn.addEventListener('click', () => {
        assignStudentsModal.classList.remove('flex');
        assignStudentsModal.classList.add('hidden');

    });
    document.addEventListener('DOMContentLoaded', function () {
        fetch('../../controllers/SubjectController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({method: 'renderSubjects'})
        })
            .then(response => response.json())
            .then(data => {
                let subjectsGrid = document.getElementById('SubjectsContainer');
                let subjectsToShow = data.slice(-4);

                subjectsToShow.forEach(subject => {
                    let subjectCard = document.createElement('div');

                    subjectCard.classList.add(
                        'border',
                        'rounded-lg',
                        'p-4',
                        'hover:bg-gray-50',
                        'transition'
                    );

                    subjectCard.innerHTML = `
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-800">${subject.title}</h3>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">${subject.status}</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">
                            ${subject.description}
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Suggested by: ${subject.creator_full_name}</span>
                            <div class="space-x-2">
                                <button class="text-green-500 hover:text-green-600" title="Approve">
                                    <i class="ri-check-line"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-600" title="Reject">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    subjectsGrid.appendChild(subjectCard);
                });

                // Add a button to view all subjects
                let viewAllButton = document.createElement('a');
                viewAllButton.href = 'list.php';
                viewAllButton.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-2', 'rounded', 'hover:bg-blue-600', 'transition', 'block', 'text-center', 'mt-4');
                viewAllButton.textContent = 'View All Subjects';
                subjectsGrid.appendChild(viewAllButton);

                console.log(data);
            })
            .catch(error => console.error('Error:', error));
    });
</script>

</body>
</html>