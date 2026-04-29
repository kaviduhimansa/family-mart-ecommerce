<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SLT Fresh Market</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Welcome to SLT Fresh Market</h2>
        <p class="text-gray-600 mb-8">Please login to continue your shopping.</p>

        <a href="{{ route('google.login') }}" class="flex items-center justify-center bg-white border border-gray-300 rounded-lg shadow-sm px-6 py-3 text-sm font-medium text-gray-800 hover:bg-gray-50 transition duration-150 w-full">
            <img class="w-5 h-5 mr-3" src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo">
            <span>Sign in with Google</span>
        </a>

        <div class="mt-6">
            <a href="/" class="text-green-600 hover:underline text-sm">← Back to Store</a>
        </div>
    </div>
</body>
</html>