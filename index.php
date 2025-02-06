<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedagogical Monitoring System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-blue-300 to-blue-500 min-h-screen flex items-center justify-center">
<div class="container mx-auto px-4">
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden max-w-4xl mx-auto">
        <div class="grid md:grid-cols-2">
            <!-- Left Side: Welcome Section -->
            <div class="p-8 bg-blue-50 flex flex-col justify-center">
                <h1 class="text-4xl font-bold text-blue-900 mb-4">
                    Pedagogical Monitoring System
                </h1>
                <p class="text-gray-600 mb-6">
                    Optimize daily educational rituals and streamline technical subject presentations for students and teachers.
                </p>
                <div class="flex flex-col space-y-4 max-w-xs">
                    <a
                            href="app/views/auth/login.php"
                            class="w-full inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded text-center"
                    >
                        Login
                    </a>
                    <a
                            href="app/views/auth/register.php"
                            class="w-full inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded text-center"
                    >
                        Register
                    </a>
                </div>


            </div>

            <!-- Right Side: Feature Highlights -->
            <div class="p-8 bg-white">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Key Features</h2>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <svg class="w-6 h-6 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        <span class="text-gray-700">Presentation Calendar</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="text-gray-700">User Role Management</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-6 h-6 text-purple-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="text-gray-700">Secure Authentication</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>