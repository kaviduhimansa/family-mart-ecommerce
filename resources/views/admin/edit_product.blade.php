<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - FamilyMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 p-6 md:p-12">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl shadow-2xl border border-gray-100">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Edit Product</h2>
                <p class="text-sm text-gray-500">Update item details for your inventory.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition">
                ← Back
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl shadow-sm">
                <ul class="list-disc list-inside text-sm text-red-600 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <input type="hidden" name="category_id" value="{{ $product->category_id }}">

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                    class="w-full p-4 border-2 border-gray-100 rounded-xl focus:border-green-500 focus:ring-0 transition outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Price (Rs.)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" 
                    class="w-full p-4 border-2 border-gray-100 rounded-xl focus:border-green-500 focus:ring-0 transition outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" 
                    class="w-full p-4 border-2 border-gray-100 rounded-xl focus:border-green-500 focus:ring-0 transition outline-none" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="bg-gray-50 p-6 rounded-2xl border-2 border-dashed border-gray-200">
                <label class="block text-sm font-bold text-gray-700 mb-3">Product Image (SRS 3.6)</label>
                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                    <div class="relative group">
                        <img src="{{ asset($product->image) }}" class="w-28 h-28 rounded-2xl object-cover shadow-lg border-4 border-white">
                        <span class="absolute -top-2 -right-2 bg-green-500 text-white text-[10px] px-2 py-1 rounded-full font-bold shadow-sm">Current</span>
                    </div>

                    <div class="flex-1">
                        <input type="file" name="image" class="text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-green-600 file:text-white hover:file:bg-green-700 transition">
                        <p class="text-xs text-gray-400 mt-3 italic leading-relaxed">
                            💡 Tip: Leave empty if you don't want to change the image. New uploads will automatically replace the old file.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-green-600 text-white py-4 rounded-2xl font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-100 active:scale-95">
                    Save Updated Details
                </button>
            </div>
        </form>
    </div>

</body>
</html>