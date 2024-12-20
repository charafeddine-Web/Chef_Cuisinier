<?php
http_response_code(404)
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Page Not Found</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
  <div class="text-center">
    <h1 class="text-9xl font-extrabold text-red-600">404</h1>
    <p class="text-2xl md:text-3xl font-light mb-4">
      Oops! It looks like you're lost.
    </p>
    <p class="text-lg mb-8">
      The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
    </p>
    <div>
      <a href="/CHEF_CUISINIER/Client/index.php" class="px-6 py-3 text-lg font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
        Go Back Home
      </a>
    </div>
    <div class="mt-8">
      <p class="text-sm text-gray-400">
        Need help? Contact the <span class="text-green-500">admin</span>.
      </p>
    </div>
  </div>
</body>
</html>
