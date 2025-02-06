<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Suggestion System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Student Suggestion Column -->
        <div class="md:col-span-2 bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-blue-600 mb-6">
                <i class="ri-lightbulb-line mr-2"></i>Subject Suggestion
            </h2>

            <!-- Suggestion Form -->
            <form id="suggestionForm" class="space-y-6">
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
                    <label class="block text-gray-700 font-semibold mb-2" for="department">
                        Department
                    </label>
                    <select
                        id="department"
                        name="department"
                        required
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">Select Department</option>
                        <option value="computer-science">Computer Science</option>
                        <option value="mathematics">Mathematics</option>
                        <option value="physics">Physics</option>
                        <option value="biology">Biology</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2" for="references">
                        References/Resources
                    </label>
                    <textarea
                        id="references"
                        name="references"
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
            <div class="space-y-4">
                <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-semibold text-gray-800">Machine Learning Ethics</h3>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">
                        An exploration of ethical considerations in AI and machine learning development.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Computer Science</span>
                        <div class="space-x-2">
                            <button class="text-green-500 hover:text-green-600" title="Approve">
                                <i class="ri-check-line"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-600" title="Reject">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-semibold text-gray-800">Quantum Computing Basics</h3>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">
                        Introductory course covering fundamental principles of quantum computing.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Physics</span>
                        <div class="space-x-2">
                            <button class="text-green-500 hover:text-green-600" title="Approve">
                                <i class="ri-check-line"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-600" title="Reject">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
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

<script>
    // Suggestion Form Submission
    document.getElementById('suggestionForm').addEventListener('submit', function(e) {
        e.preventDefault();

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
    });

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
</script>
</body>
</html>