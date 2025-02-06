<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Pedagogical Monitoring System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-blue-300 to-blue-500 min-h-screen flex items-center justify-center py-8">
<div class="container mx-auto px-4">
    <div class="max-w-md mx-auto bg-white shadow-2xl rounded-2xl overflow-hidden">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-6">
                Reset Password
            </h2>

            <div id="resetInstructions" class="text-center text-gray-600 mb-6">
                <p>Enter the email address associated with your account. We'll send you a link to reset your password.</p>
            </div>

            <form action="#" method="POST" class="space-y-4" id="resetPasswordForm">
                <div>
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.323l7.997-3.439A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 3.429-8-3.429V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter your email address"
                        >
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-bold"
                    >
                        Send Password Reset Link
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Remember your password?
                    <a href="login.php" class="text-blue-600 hover:text-blue-800 font-semibold">
                        Back to Login
                    </a>
                </p>
            </div>

            <!-- Optional: New Password Reset Section (hidden by default) -->
            <div id="newPasswordSection" class="hidden">
                <h3 class="text-2xl font-bold text-center text-blue-900 mb-6">
                    Create New Password
                </h3>

                <form action="#" method="POST" class="space-y-4" id="newPasswordForm">
                    <div>
                        <label for="newPassword" class="block text-gray-700 text-sm font-bold mb-2">
                            New Password
                        </label>
                        <input
                            type="password"
                            id="newPassword"
                            name="new_password"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter new password"
                        >
                    </div>

                    <div>
                        <label for="confirmNewPassword" class="block text-gray-700 text-sm font-bold mb-2">
                            Confirm New Password
                        </label>
                        <input
                            type="password"
                            id="confirmNewPassword"
                            name="confirm_new_password"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Confirm new password"
                        >
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition duration-300 font-bold"
                        >
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Message Modal (hidden by default) -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50