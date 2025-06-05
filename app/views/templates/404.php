<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | <?= SITE_NAME ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
            <p class="text-xl text-gray-600 mb-8">Page Not Found</p>
            <a href="<?= SITE_URL ?>" class="bg-[#00bda4] text-white px-6 py-2 rounded-full hover:bg-[#f34d26] transition-colors">
                Go Back Home
            </a>
        </div>
    </div>
</body>
</html>