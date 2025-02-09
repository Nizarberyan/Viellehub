<?php
// Set the HTTP response code to 403
http_response_code(403);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>403 Forbidden</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-xl text-center">
        <h1 class="text-6xl font-extrabold text-red-600">403</h1>
        <p class="mt-4 text-xl text-gray-700">
            Forbidden: You do not have permission to access this resource.
        </p>
    </div>
    </body>
    </html>
<?php
// Stop further execution
exit;
?>