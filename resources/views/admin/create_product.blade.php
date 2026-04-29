<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product - FamilyMart Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 p-6 md:p-12">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-[2rem] shadow-2xl border border-gray-100">
        <h2 class="text-3xl font-black text-gray-800 mb-2">Add New Farm Product</h2>
        <p class="text-gray-500 mb-8 font-medium">Create a new entry for the SLT Fresh Market inventory.</p>
        
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl">
                <ul class="list-disc list-inside text-sm text-red-600 font-bold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Select Category</label>
                <select name="category_id" class="w-full p-4 border-2 border-gray-100 rounded-xl focus:border-green-500 focus:ring-0 transition outline-none appearance-none bg-white" required>
                    <option value="" disabled selected>-- Choose a category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Product Name</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                    class="w-full p-4 border-2 border-gray-100 rounded-xl focus:border-green-500 focus:ring-0 transition outline-none" 
                    placeholder="e.g. Fresh Red Apple" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Price (Rs.)</label>
                <input type="number" name="price" value="{{ old('price') }}" 
                    class="w-full p-4 border-2 border-gray-100 rounded-xl focus:border-green-500 focus:ring-0 transition outline-none font-mono" 
                    placeholder="e.g. 150" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Product Description</label>
                <textarea name="description" rows="3" 
                    class="w-full p-4 border-2 border-gray-100 rounded-xl focus:border-green-500 focus:ring-0 transition outline-none" 
                    placeholder="Brief details about freshness, weight, etc..." required>{{ old('description') }}</textarea>
            </div>

            <div class="bg-green-50/50 p-6 rounded-2xl border-2 border-dashed border-green-200">
                <label class="block text-sm font-bold text-green-700 mb-3 uppercase tracking-widest text-[10px]">Step 2: Upload Image</label>
                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-600 file:text-white hover:file:bg-green-700 transition cursor-pointer" required>
                <p class="mt-2 text-[10px] text-gray-400 italic">Recommended: 800x800px, Max 2MB (JPG/PNG)</p>
            </div>

            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-green-600 text-white py-4 rounded-2xl font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-100 active:scale-95">
                    Save Product
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex-1 bg-gray-100 text-gray-500 text-center py-4 rounded-2xl font-bold hover:bg-gray-200 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</body>
</html>