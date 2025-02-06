<?php
require_once '../../models/Student.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pedagogical Monitoring System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-blue-300 to-blue-500 min-h-screen flex items-center justify-center">
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white shadow-2xl rounded-2xl overflow-hidden">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-6">
                Login
            </h2>

            <form action="" method="POST" class="space-y-4">
                <div>
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                        Email Address
                    </label>
                    <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter your email"
                    >
                </div>

                <div>
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                        Password
                    </label>
                    <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter your password"
                    >
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                                type="checkbox"
                                id="remember"
                                name="remember"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div>
                        <a href="reset-password.php" class="text-sm text-blue-600 hover:text-blue-800">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <div>
                    <button
                            type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-bold"
                    >
                        Login
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="register.php" class="text-blue-600 hover:text-blue-800 font-semibold">
                        Register here
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Optional: Social Login Section -->
    <div class="max-w-md mx-auto mt-4 text-center">
        <div class="flex items-center justify-center space-x-4">
            <hr class="w-full border-gray-300">
            <span class="text-gray-500">or</span>
            <hr class="w-full border-gray-300">
        </div>

        <div class="mt-4 space-y-3">
            <button class="w-full flex items-center justify-center bg-white border border-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-50 transition duration-300">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.5 10.05c0-.57-.05-1.14-.15-1.7h-9.89v3.45h5.84c-.25 1.36-1 2.56-2.13 3.34v2.45h3.57c2.05-1.89 3.26-4.67 3.26-7.54z" fill="#4285F4"/>
                    <path d="M10.46 20c2.93 0 5.38-1 7.18-2.64l-3.57-2.45c-.99.66-2.26 1.04-3.61 1.04-2.79 0-5.15-1.88-6-4.41H.86v2.52C2.66 17.66 6.33 20 10.46 20z" fill="#34A853"/>
                    <path d="M4.46 11.54c-.25-.74-.38-1.53-.38-2.34s.13-1.6.38-2.34V4.34H.86A9.987 9.987 0 000 10c0 1.61.39 3.14 1.06 4.46l3.4-2.92z" fill="#FBBC05"/>
                    <path d="M10.46 3.95c1.63 0 3.09.56 4.23 1.66l3.18-3.18C15.84.99 13.39 0 10.46 0 6.33 0 2.66 2.34.86 5.66l3.6 2.92c.85-2.53 3.21-4.41 6-4.41z" fill="#EA4335"/>
                </svg>
                Login with Google
            </button>
        </div>
    </div>
</div>

<script>
    // Optional: Simple client-side validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const email = document.getElementById('email');
        const password = document.getElementById('password');

        if (!email.value || !password.value) {
            e.preventDefault();
            alert('Please fill in all fields');
        }
    });
</script>
</body>
</html>