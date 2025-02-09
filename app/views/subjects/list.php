<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <!-- Ensure the viewport is configured for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Selection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Alpine.js for Dropdown + Sidebar Toggle -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">

<!-- Mobile Header (hamburger menu button) -->
<header class="bg-white shadow p-4 flex items-center justify-between md:hidden">
    <div class="text-xl font-bold">Subject Selection</div>
    <button
            @click="sidebarOpen = !sidebarOpen"
            class="text-gray-600 focus:outline-none"
            aria-label="Toggle Sidebar"
    >
        <i class="ri-menu-line text-2xl"></i>
    </button>
</header>

<!-- Main Wrapper: stacks for small screens, side-by-side for md+ screens -->
<div class="flex min-h-screen flex-col md:flex-row">

    <!-- Sidebar -->
    <div
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="transform md:transform-none duration-300 fixed md:static w-64 bg-white shadow-md left-0 top-0 bottom-0 overflow-y-auto z-50"
    >
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
    <!-- Add top padding (pt-16) on small screens to avoid content being hidden behind the mobile header.
         Remove left margin (ml-64) for small screens; keep it for md+ screens. -->
    <div class="flex-1 p-8 pt-16 md:pt-8">
        <div class="container mx-auto">
            <div class="flex flex-wrap items-center gap-4 mb-8">
                <!-- Title -->
                <h1 class="text-3xl font-bold text-gray-800 flex items-center mb-4 sm:mb-0">
                    <i class="ri-book-line mr-3 text-blue-600"></i>
                    Available Subjects
                </h1>

                <!-- Right Section: Search and Department Filter -->
                <div class="flex flex-wrap sm:flex-nowrap items-center gap-4">
                    <!-- Search box -->
                    <div class="relative w-full sm:w-auto">
                        <input
                                type="text"
                                id="searchSubjects"
                                placeholder="Search subjects..."
                                aria-label="Search subjects"
                                class="w-full pl-10 pr-4 py-2 rounded-lg border"
                        >
                        <i class="ri-search-line absolute left-3 top-3 text-gray-400"></i>
                    </div>

                </div>
            </div>

            <!-- Grid of subjects -->
            <div id="subjectsGrid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Dynamically populated subject cards will go here -->

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

<!-- JavaScript for Subject Selection -->
<script>
    // Utility Functions
    function debounce(func, delay) {
        let timeoutId;
        return function () {
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

    // Simulate team members (in real app, this might come from a backend)
    const teamMembers = [
        {id: 1, name: 'John Doe'},
        {id: 2, name: 'Alice Smith'},
        {id: 3, name: 'Bob Johnson'},
        {id: 4, name: 'Emma Brown'}
    ];

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

    // Show modal
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

    // Hide modal (cancel)
    cancelSelectionBtn.addEventListener('click', () => {
        selectionModal.classList.remove('flex');
        selectionModal.classList.add('hidden');
    });

    // Submit subject selection
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
            teamName,
            members: memberNames
        };

        try {
            // In a real app, you'd likely send this to the server via fetch/axios/etc.
            console.log('Submission Data:', submissionData);
            alert('Subject submission sent for teacher approval!');

            // Close modal
            selectionModal.classList.remove('flex');
            selectionModal.classList.add('hidden');
        } catch (error) {
            console.error('Submission error:', error);
            alert('Failed to submit. Please try again.');
        }
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
                let subjectsGrid = document.getElementById('subjectsGrid');
                data.forEach(subject => {
                    let subjectCard = document.createElement('div');

                    subjectCard.classList.add(
                        'subject-card',
                        'p-6',
                        'bg-white',
                        'rounded-xl',
                        'shadow-lg',
                        'hover:shadow-xl',
                        'transition',
                        'duration-300',
                        'ease-in-out'
                    );

                    let approvalInfo = subject.approved_by
                        ? `Approved by: ${subject.creator_full_name}`
                        : 'Not approved yet';

                    subjectCard.innerHTML = `
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">${subject.title}</h2>
                    <p class="text-gray-700 mb-2">${subject.description}</p>
                    <p class="text-gray-600 mb-2"><strong>Status:</strong> ${subject.status}</p>
                    <p class="text-gray-600 mb-4"><strong>Approval:</strong> ${approvalInfo}</p>
                    <button class="select-subject-btn bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 rounded-xl w-full">
                        Select Subject
                    </button>
                `;
                    subjectsGrid.appendChild(subjectCard);
                });
                console.log(data);
            })
            .catch(error => console.error('Error:', error));
    });

    // Search + Filter
    const searchInput = document.getElementById('searchSubjects');

    function filterSubjects() {
        const searchTerm = searchInput.value.toLowerCase();

        const subjectCards = document.querySelectorAll('.subject-card');

        subjectCards.forEach(card => {
            const subjectName = card.querySelector('h2').textContent.toLowerCase();

            const matchesSearch = subjectName.includes(searchTerm);

            card.style.display =
                matchesSearch ? 'block' : 'none';
        });
    }

    const debouncedFilterSubjects = debounce(filterSubjects, 300);
    searchInput.addEventListener('input', debouncedFilterSubjects);


</script>
</body>
</html>