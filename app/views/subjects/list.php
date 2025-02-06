<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Subject Selection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-md fixed left-0 top-0 bottom-0 overflow-y-auto">
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

    <!-- Main Content Area -->
    <div class="ml-64 flex-1 p-8">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="ri-book-line mr-3 text-blue-600"></i>
                    Available Subjects
                </h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input
                                type="text"
                                id="searchSubjects"
                                placeholder="Search subjects..."
                                aria-label="Search subjects"
                                class="pl-10 pr-4 py-2 rounded-lg border w-64"
                        >
                        <i class="ri-search-line absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <select
                            id="departmentFilter"
                            aria-label="Filter subjects by department"
                            class="px-3 py-2 border rounded-lg"
                    >
                        <option value="">All Departments</option>
                        <option value="computer-science">Computer Science</option>
                        <option value="mathematics">Mathematics</option>
                        <option value="physics">Physics</option>
                        <option value="biology">Biology</option>
                    </select>
                </div>
            </div>

            <!-- Grid of subjects -->
            <div id="subjectsGrid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Dynamically populated subject cards will go here -->
                <div class="subject-card bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-2">Software Engineering</h2>
                    <span class="text-sm text-gray-500">Computer Science</span>
                    <button
                            class="select-subject-btn mt-4 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
                            data-subject-name="Software Engineering"
                    >
                        Select Subject
                    </button>
                </div>
                <!-- Add more subject cards as needed -->
            </div>

            <!-- Subject Selection Modal -->
            <div
                    id="selectionModal"
                    class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 items-center justify-center z-50"
                    role="dialog"
                    aria-labelledby="selectionModalTitle"
            >
                <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
                    <h2 id="selectionModalTitle" class="text-xl font-bold mb-4">
                        Confirm Selection
                    </h2>
                    <p class="mb-4">
                        Subject:
                        <span id="selectedSubjectTitle" class="font-semibold"></span>
                    </p>
                    <p class="mb-4">
                        Department:
                        <span id="selectedSubjectDepartment" class="font-semibold"></span>
                    </p>

                    <!-- Team name input -->
                    <div class="mb-4">
                        <label for="teamNameInput" class="block font-medium mb-1">
                            Team Name:
                        </label>
                        <input
                                type="text"
                                id="teamNameInput"
                                class="w-full px-3 py-2 border rounded"
                                placeholder="Enter your team name"
                                required
                        />
                    </div>

                    <!-- Team Member Selection -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">
                            Select Team Members:
                        </label>
                        <div id="teamMembersContainer">
                            <!-- Team members will be dynamically populated -->
                        </div>
                    </div>

                    <!-- Modal Buttons -->
                    <div class="flex justify-end space-x-2">
                        <button
                                id="cancelSelectionBtn"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                        >
                            Cancel
                        </button>
                        <button
                                id="submitSelectionBtn"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alpine.js for Dropdown Functionality -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- JavaScript for Subject Selection -->
<script>
    // Utility Functions
    function debounce(func, delay) {
        let timeoutId;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func.apply(context, args), delay);
        };
    }

    // DOM Elements
    const selectSubjectBtns = document.querySelectorAll('.select-subject-btn');
    const selectionModal = document.getElementById('selectionModal');
    const cancelSelectionBtn = document.getElementById('cancelSelectionBtn');
    const submitSelectionBtn = document.getElementById('submitSelectionBtn');
    const selectedSubjectTitle = document.getElementById('selectedSubjectTitle');
    const selectedSubjectDepartment = document.getElementById('selectedSubjectDepartment');
    const teamNameInput = document.getElementById('teamNameInput');
    const teamMembersContainer = document.getElementById('teamMembersContainer');

    // Simulate team members (in real app, this would come from backend)
    const teamMembers = [
        { id: 1, name: 'John Doe' },
        { id: 2, name: 'Alice Smith' },
        { id: 3, name: 'Bob Johnson' },
        { id: 4, name: 'Emma Brown' }
    ];

    // Populate Team Members
    function populateTeamMembers() {
        teamMembersContainer.innerHTML = teamMembers.map(member => `
            <div class="flex items-center mb-2">
                <input
                    type="checkbox"
                    id="member-${member.id}"
                    class="team-member-checkbox mr-2"
                    data-name="${member.name}"
                    value="${member.id}"
                >
                <label for="member-${member.id}">${member.name}</label>
            </div>
        `).join('');
    }

    // Event Listeners
    selectSubjectBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const subjectName = btn.dataset.subjectName;
            const departmentName = btn.closest('.subject-card').querySelector('span').textContent;

            selectedSubjectTitle.textContent = subjectName;
            selectedSubjectDepartment.textContent = departmentName;

            populateTeamMembers();

            selectionModal.classList.remove('hidden');
            selectionModal.classList.add('flex');
        });
    });

    cancelSelectionBtn.addEventListener('click', () => {
        selectionModal.classList.remove('flex');
        selectionModal.classList.add('hidden');
    });

    submitSelectionBtn.addEventListener('click', () => {
        const selectedMembers = document.querySelectorAll('.team-member-checkbox:checked');
        const teamName = teamNameInput.value.trim();

        if (selectedMembers.length < 2) {
            alert('You need at least 2 team members to form a team.');
            return;
        }

        if (!teamName) {
            alert('Please provide a unique team name.');
            return;
        }

        const memberNames = Array.from(selectedMembers).map(member => member.dataset.name);

        const submissionData = {
            subjectName: selectedSubjectTitle.textContent,
            teamName: teamName,
            members: memberNames
        };

        // Simulated submission with better error handling
        try {
            console.log('Submission Data:', submissionData);
            alert('Subject submission sent for teacher approval!');

            selectionModal.classList.remove('flex');
            selectionModal.classList.add('hidden');
        } catch (error) {
            console.error('Submission error:', error);
            alert('Failed to submit. Please try again.');
        }
    });

    // Search and Filter Functionality
    const searchInput = document.getElementById('searchSubjects');
    const departmentFilter = document.getElementById('departmentFilter');

    function filterSubjects() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedDepartment = departmentFilter.value.toLowerCase();
        const subjectCards = document.querySelectorAll('.subject-card');

        subjectCards.forEach(card => {
            const subjectName = card.querySelector('h2').textContent.toLowerCase();
            const departmentTag = card.querySelector('span').textContent.toLowerCase();

            const matchesSearch = subjectName.includes(searchTerm);
            const matchesDepartment = !selectedDepartment || departmentTag.includes(selectedDepartment);

            card.style.display = (matchesSearch && matchesDepartment) ? 'block' : 'none';
        });
    }

    const debouncedFilterSubjects = debounce(filterSubjects, 300);

    searchInput.addEventListener('input', debouncedFilterSubjects);
    departmentFilter.addEventListener('change', filterSubjects);
</script>
</body>
</html>