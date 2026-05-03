<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SLT Fresh Market</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md flex flex-col items-center">
        <img src="https://img.icons8.com/color/96/000000/shopping-cart.png" alt="Logo" class="w-16 h-16 mb-4">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-2">SLT Fresh Market</h2>
        <p class="text-gray-500 mb-6">Sign in to your account</p>

        <form method="POST" action="{{ route('login') }}" class="w-full text-left space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" type="email" name="email" required autofocus class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" placeholder="you@email.com">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" placeholder="••••••••">
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-600">Remember me</label>
                </div>
                <a href="#" class="text-sm text-green-600 hover:underline">Forgot password?</a>
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition">Sign In</button>
        </form>

        <div class="flex items-center my-6 w-full">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="mx-4 text-gray-400">or</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <a href="{{ route('google.login') }}" class="flex items-center justify-center bg-white border border-gray-300 rounded-lg shadow px-6 py-3 text-sm font-medium text-gray-800 hover:bg-gray-50 transition duration-150 w-full mb-2">
            <img class="w-5 h-5 mr-3" src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo">
            <span>Sign in with Google</span>
        </a>

        <div class="mt-4 w-full text-center">
            <a href="/" class="text-green-600 hover:underline text-sm">← Back to Store</a>
        </div>
    </div>
</body>
</html>