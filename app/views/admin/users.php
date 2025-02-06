<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
    <!-- Sidebar (Similar to previous admin page) -->
    <div class="w-64 bg-blue-900 text-white p-6">
        <h2 class="text-2xl font-bold mb-10">Admin Panel</h2>
        <nav class="space-y-2">
            <a href="dashboard.php" class="block py-2 px-4 hover:bg-blue-700 rounded text-gray-300 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Dashboard
            </a>
            <a href="#" class="block py-2 px-4 bg-blue-700 rounded text-white flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                User Management
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <!-- Header -->
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
            <div class="flex items-center space-x-4">
                <button id="addUserBtn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add New User
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <select id="roleFilter" class="form-select w-full px-3 py-2 border rounded">
                    <option value="">All Roles</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
                </select>
                <select id="statusFilter" class="form-select w-full px-3 py-2 border rounded">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="suspended">Suspended</option>
                </select>
                <input type="text" id="searchInput" placeholder="Search users..." class="w-full px-3 py-2 border rounded">
                <button id="applyFilters" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- User Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="p-3 text-left">
                            <input type="checkbox" id="selectAllCheckbox" class="form-checkbox">
                        </th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Role</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- User Row Template -->
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">
                            <input type="checkbox" class="form-checkbox user-checkbox">
                        </td>
                        <td class="p-3 flex items-center">
                            <div class="w-10 h-10 rounded-full mr-3 bg-blue-500 flex items-center justify-center text-white">
                                JP
                            </div>
                            <span>John Patel</span>
                        </td>
                        <td class="p-3">john.patel@example.com</td>
                        <td class="p-3">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Teacher</span>
                        </td>
                        <td class="p-3">
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Active</span>
                        </td>
                        <td class="p-3">
                            <div class="flex items-center space-x-2">
                                <button class="edit-user text-blue-500 hover:text-blue-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button class="delete-user text-red-500 hover:text-red-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- More user rows would be dynamically populated -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-between items-center">
            <div class="text-gray-600">
                Showing 1-10 of 125 users
            </div>
            <div class="flex space-x-2">
                <button class="px-4 py-2 border rounded hover:bg-gray-100">Previous</button>
                <button class="px-4 py-2 border rounded hover:bg-gray-100 bg-blue-500 text-white">1</button>
                <button class="px-4 py-2 border rounded hover:bg-gray-100">2</button>
                <button class="px-4 py-2 border rounded hover:bg-gray-100">3</button>
                <button class="px-4 py-2 border rounded hover:bg-gray-100">Next</button>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit User Modal -->
<div id="userModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-lg">
        <h2 id="modalTitle" class="text-2xl font-bold mb-6">Add New User</h2>
        <form id="userForm">
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                    <input type="text" name="first_name" required class="w-full px-3 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                    <input type="text" name="last_name" required class="w-full px-3 py-2 border rounded">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                <select name="role" required class="w-full px-3 py-2 border rounded">
                    <option value="">Select Role</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <select name="status" required class="w-full px-3 py-2 border rounded">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>
            <div class="mt-6 flex justify-end space-x-4">
                <button type="button" id="closeModal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Save User
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md text-center">
        <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <h2 class="text-2xl font-bold mb-4">Are you sure?</h2>
        <p class="mb-6 text-gray-600">Do you really want to delete this user? This process cannot be undone.</p>
        <div class="flex justify-center space-x-4">
            <button id="cancelDelete" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                Cancel
            </button>
            <button id="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Delete
            </button>
        </div>
    </div>
</div>

<script>
    // Modal Interaction
    const addUserBtn = document.getElementById('addUserBtn');
    const userModal = document.getElementById('userModal');
    const closeModal = document.getElementById('closeModal');
    const deleteModal = document.getElementById('deleteModal');

    // Open Add User Modal
    addUserBtn.addEventListener('click', () => {
        document.getElementById('modalTitle').textContent = 'Add New User';
        userModal.classList.remove('hidden');
    });

    // Close User Modal
    closeModal.addEventListener('click', () => {
        userModal.classList.add('hidden');
    });

    // Select All Checkbox
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const userCheckboxes = document.querySelectorAll('.user-checkbox');

    selectAllCheckbox.addEventListener('change', (e) => {
        userCheckboxes.forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
    });

    // Delete User Functionality
    const deleteButtons = document.querySelectorAll('.delete-user');
    const cancelDelete = document.getElementById('cancelDelete');
    const confirmDelete = document.getElementById('confirmDelete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            deleteModal.classList.remove('hidden');
        });
    });

    cancelDelete.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });

    confirmDelete.addEventListener('click', () => {
        // Implement actual delete logic here
        deleteModal.classList.add('hidden');
    });

    // Form Submission
    const userForm = document.getElementById('userForm');
    userForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Implement form submission logic
        userModal.classList.add('hidden');
    });

    // Filtering
    const applyFilters = document.getElementById('applyFilters');
    applyFilters.addEventListener('click', () => {
        const roleFilter = document.getElementById('roleFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;
        const searchInput = document.getElementById('searchInput').value;

        // Implement filtering logic
        console.log('Filters:', { roleFilter, statusFilter, searchInput });
    });
</script>
</body>
</html>