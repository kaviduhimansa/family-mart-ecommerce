<h1 class="text-3xl font-bold text-gray-800 underline decoration-green-500 mb-10">Category Management</h1>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="p-4 font-bold text-gray-600">ID</th>
                <th class="p-4 font-bold text-gray-600">Category Name</th>
                <th class="p-4 font-bold text-gray-600">Slug</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($categories as $category)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4 text-gray-600">#{{ $category->id }}</td>
                <td class="p-4 font-medium text-gray-800">{{ $category->name }}</td>
                <td class="p-4 text-green-700 font-bold">{{ $category->slug }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>