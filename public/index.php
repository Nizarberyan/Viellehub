<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 flex items-center justify-center h-screen">
<div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-lg transform transition duration-500 hover:scale-105 text-center">
    <h1 class="text-4xl font-extrabold mb-6 text-center text-gray-800">Welcome!</h1>
    <p class="text-lg text-gray-600 mb-8">This is the home page. Navigate to other pages using the buttons below.</p>
    <div class="flex flex-col space-y-4">
        <a href="../app/views/auth/login.php" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-bold transition duration-300">Login</a>
        <a href="../app/views/auth/register.php" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 font-bold transition duration-300">Register</a>
    </div>
</div>
</body>
</html>