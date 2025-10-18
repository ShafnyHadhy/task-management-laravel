<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-10">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-2">Create New Category</h2>
            <a href="{{ route('category.index') }}"
               class="px-5 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-300 transition">
                ← Back to Categories
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200 max-w-2xl mx-auto">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Category Name</label>
                    <input type="text" id="title" name="category_name"
                           value="{{ old('category_name') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:border-blue-400 placeholder-gray-400"
                           placeholder="Enter category name">
                    @error('category_name')
                        <p class="text-red-600 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:border-blue-400 placeholder-gray-400"
                              placeholder="Enter description">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select id="status" name="status"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:border-blue-400">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 transition">
                        🚀 Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
