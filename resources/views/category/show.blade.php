<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-10">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-white flex items-center gap-2">Category Details</h2>
            <a href="{{ route('category.index') }}"
               class="px-5 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-300 transition">
                ← Back to Categories
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Category Name:</h3>
                <p class="text-gray-900 bg-gray-100 p-4 rounded-lg shadow-sm">
                    {{ $category->category_name }}
                </p>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Description:</h3>
                <p class="text-gray-900 bg-gray-100 p-4 rounded-lg shadow-sm">
                    {{ $category->description ?: 'No description available.' }}
                </p>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Status:</h3>
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold
                    {{ $category->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($category->status) }}
                </span>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Created At:</h3>
                <p class="text-gray-900 bg-gray-100 p-4 rounded-lg shadow-sm">
                    {{ $category->created_at->format("d M, Y") }}
                </p>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('category.edit', $category) }}"
                   class="px-5 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 transition">
                    Edit Category
                </a>

                <form action="{{ route('category.destroy', $category) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-5 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-red-700 focus:ring-2 focus:ring-red-300 transition">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
