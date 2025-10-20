<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-white">Categories</h2>

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('category.create') }}"
                   class="inline-block px-5 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-800 transition">
                    + New Category
                </a>
            @endif
        </div>

        <div class="bg-white/95 shadow-lg rounded-lg overflow-hidden border border-gray-200">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-700 text-white uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3">No</th>
                        <th class="px-5 py-3">Category Name</th>
                        <th class="px-5 py-3">Description</th>
                        <th class="px-5 py-3">Status</th>
                        @if(Auth::user()->role === 'admin')
                            <th class="px-5 py-3">Created At</th>
                            <th class="px-5 py-3 text-center">Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-white transition duration-200">
                            <td class="px-5 py-3">{{ $category->id }}</td>
                            <td class="px-5 py-3 font-semibold text-gray-900">{{ $category->category_name }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ Str::limit($category->description, 50) }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $category->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($category->status) }}
                                </span>
                            </td>

                            @if(Auth::user()->role === 'admin')
                                <td class="px-5 py-3 text-gray-500">{{ $category->created_at->format("d M, Y") }}</td>

                                <td class="px-5 py-3 flex justify-center space-x-2">
                                    <a href="{{ route('category.show', $category) }}"
                                       class="px-3 py-2 bg-blue-300 text-white text-xs font-semibold rounded-md hover:bg-blue-500 focus:ring focus:ring-blue-200 transition">
                                        👁
                                    </a>

                                    <a href="{{ route('category.edit', $category) }}"
                                       class="px-3 py-2 bg-green-300 text-white text-xs font-semibold rounded-md hover:bg-green-500 focus:ring focus:ring-yellow-200 transition">
                                        ✏️
                                    </a>

                                    <form method="POST" action="{{ route('category.destroy', $category) }}">
                                        @csrf
                                        @method("delete")
                                        <button onclick="return confirm('Are you sure you want to delete this category?')"
                                                class="px-3 py-2 bg-red-300 text-white text-xs font-semibold rounded-md hover:bg-red-500 focus:ring focus:ring-red-200 transition">
                                            🗑
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-500 font-medium">
                                🚫 No categories available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $categories->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>
