<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 flex items-center justify-center h-screen">
<div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-sm transform transition duration-500 hover:scale-105">
    <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-800">Register</h2>
    <form action="../../controllers/AuthController.php" method="POST">
        <div class="mb-5">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>
        <div class="mb-5">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-bold transition duration-300">Register</button>
    </form>
    <p class="mt-8 text-center text-gray-600">Already have an account? <a href="./login.php" class="text-blue-600 hover:underline">Login</a></p>
</div>
</body>
</html>