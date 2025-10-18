<x-app-layout>
    <div class="container mx-auto px-4">
        <!-- Create Category Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">📜 Categories</h2>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('category.create')}}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    ➕ Create New Category
                </a>
            @endif
        </div>

        <!-- Category Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Category Name</th>
                        <th class="px-4 py-3 text-left">Description</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        @if(Auth::user()->role === 'admin')
                            <th class="px-4 py-3 text-left">Created At</th>
                            <th class="px-4 py-3 text-center">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                    @foreach ($categories as $category)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-4 py-3">{{ $category->id }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-900">{{ $category->category_name }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ Str::limit($category->description, 50) }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $category->status}}</td>
                            @if(Auth::user()->role === 'admin')
                                <td class="px-4 py-3 text-gray-600">{{ $category->created_at->format("d M, Y") }}</td>
                                <td class="px-4 py-3 flex justify-center space-x-2">
                                    <a href="{{ route('category.show', $category) }}" class="px-3 py-2 text-white text-xs font-semibold rounded shadow-md hover:bg-blue-600 transition">
                                        👁
                                    </a>
                                    <a href="{{ route('category.edit', $category) }}" class="px-3 py-2 text-white text-xs font-semibold rounded shadow-md hover:bg-yellow-600 transition">
                                        ✏️
                                    </a>
                                    <form method="POST" action="{{ route('category.destroy', $category) }}">
                                        @csrf
                                        @method("delete")
                                        <button onclick="return confirm('Are you sure you want to delete this category?')"
                                            class="px-3 py-2 bg-white text-white text-xs font-semibold rounded shadow-md hover:bg-red-600 transition">
                                            🗑
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
