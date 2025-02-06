<?php
require_once '../../models/Student.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Passwords do not match";
    } else {
       try {
           $student = new Student();
           $result = $student->CreateUser($email, $password, $first_name, $last_name, $role, 'pending');
           echo "User created successfully";
       } catch (PDOException $e) {
           echo $e->getMessage();
       }
       if ($result === true) {
           header('Location: login.php');
       }
       else {
           echo "An error occurred";
       }

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pedagogical Monitoring System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-blue-300 to-blue-500 min-h-screen flex items-center justify-center py-8">
<div class="container mx-auto px-4">
    <div class="max-w-lg mx-auto bg-white shadow-2xl rounded-2xl overflow-hidden">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-6">
                Create Your Account
            </h2>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="space-y-4">
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="firstName" class="block text-gray-700 text-sm font-bold mb-2">
                            First Name
                        </label>
                        <input
                                type="text"
                                id="firstName"
                                name="first_name"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Enter your first name"
                        >
                    </div>
                    <div>
                        <label for="lastName" class="block text-gray-700 text-sm font-bold mb-2">
                            Last Name
                        </label>
                        <input
                                type="text"
                                id="lastName"
                                name="last_name"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Enter your last name"
                        >
                    </div>
                </div>

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
                    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">
                        Select Your Role
                    </label>
                    <select
                            id="role"
                            name="role"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >

                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
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
                                placeholder="Create a password"
                        >
                    </div>
                    <div>
                        <label for="confirmPassword" class="block text-gray-700 text-sm font-bold mb-2">
                            Confirm Password
                        </label>
                        <input
                                type="password"
                                id="confirmPassword"
                                name="confirm_password"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Confirm your password"
                        >
                    </div>
                </div>

                <div>
                    <div class="flex items-center">
                        <input
                                type="checkbox"
                                id="terms"
                                name="terms"
                                required
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="terms" class="ml-2 block text-sm text-gray-900">
                            I agree to the Terms and Conditions
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button
                            type="submit"
                            class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                    >
                        Create Account
                    </button>
                </div>
            </form>
