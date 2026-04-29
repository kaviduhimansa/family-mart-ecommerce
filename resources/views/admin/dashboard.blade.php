<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FamilyMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex">

    <aside class="w-64 bg-green-800 min-h-screen text-white p-6 hidden md:block shadow-xl">
        <div class="mb-10 text-center">
            <h2 class="text-2xl font-black tracking-tighter italic">FamilyMart</h2>
            <p class="text-[10px] uppercase tracking-[3px] opacity-60">Control Panel</p>
        </div>

        <nav class="space-y-2">
            <p class="text-xs font-bold text-green-400 uppercase tracking-widest mb-4 opacity-50">Menu</p>
            
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center space-x-3 p-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 border border-white/20 font-bold' : 'hover:bg-green-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center space-x-3 p-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 border border-white/20 font-bold' : 'hover:bg-green-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5"></path></svg>
                <span>Manage Products</span>
            </a>

            <a href="#" class="flex items-center space-x-3 p-3 rounded-xl transition opacity-40 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"></path></svg>
                <span>Categories</span>
            </a>

            <div class="pt-10">
                <a href="/" class="flex items-center space-x-3 p-3 text-sm opacity-70 hover:opacity-100 transition border-t border-green-700 pt-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span>Back to Website</span>
                </a>
            </div>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-800 tracking-tight">Product Inventory</h1>
                <p class="text-gray-500 font-medium">Manage your FamilyMart stock levels and pricing.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="bg-green-600 text-white px-8 py-3 rounded-2xl font-bold hover:bg-green-700 shadow-lg shadow-green-200 transition-all active:scale-95">
                + Add New Product
            </a>
        </header>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded-r-xl shadow-sm">
                <p class="text-green-700 font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="p-6 font-bold text-gray-400 uppercase text-[10px] tracking-widest">Item</th>
                        <th class="p-6 font-bold text-gray-400 uppercase text-[10px] tracking-widest">Name</th>
                        <th class="p-6 font-bold text-gray-400 uppercase text-[10px] tracking-widest">Price</th>
                        <th class="p-6 font-bold text-gray-400 uppercase text-[10px] tracking-widest text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($products as $product)
                    <tr class="hover:bg-green-50/30 transition-colors">
                        <td class="p-6">
                            <img src="{{ asset($product->image) }}" class="w-14 h-14 rounded-2xl object-cover shadow-sm ring-2 ring-white">
                        </td>
                        <td class="p-6">
                            <span class="font-bold text-gray-800 block">{{ $product->name }}</span>
                            <span class="text-xs text-gray-400">SKU: FM-{{ 1000 + $product->id }}</span>
                        </td>
                        <td class="p-6">
                            <span class="text-green-600 font-black text-lg">Rs. {{ number_format($product->price, 0) }}</span>
                        </td>
                        <td class="p-6 text-center">
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700 font-bold text-sm bg-blue-50 px-3 py-1 rounded-lg transition">Edit</a>
                                
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Wait! Are you sure you want to delete this?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 font-bold text-sm bg-red-50 px-3 py-1 rounded-lg transition">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>