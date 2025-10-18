<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Page Heading -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Create New Category</h2>
            <a href="{{ route('category.index') }}"
                class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 transition">
                ← Back to Categories
            </a>
        </div>

        <!-- Form Container -->
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto">
            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Category Field -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Category Name:</label>
                    <input type="text" id="title" name="category_name" value=""
                            class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                            placeholder="Enter category name">
                    @error("category_name")
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                    <textarea id="description" name="description" rows="4"
                                class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                placeholder="Enter description"></textarea>
                    @error("description")
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category Status Selection -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                    <select id="status" name="status"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error("status")
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-blue-700 transition">
                        🚀 Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
