<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Page Heading -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">📋 Task Details</h2>
            <a href="{{ route('task.index')}}"
            class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 transition">
                ← Back to Tasks
            </a>
        </div>

        <!-- Task Details Card -->
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto">
            <!-- Task Name -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Task Name:</h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">{{ $task->task_name }}</p>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Description:</h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">{{ $task->description }}</p>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Category:</h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">{{ $task->category_id }}</p>
            </div>

            <!-- Assignment Date -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Assignment Date:</h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">{{ $task->assignment_date }}</p>
            </div>

            <!-- Deadline -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Deadline:</h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">{{ $task->deadline }}</p>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Status:</h3>
                <p class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">{{ $task->status }}</p>
            </div>

            <!-- Assigned User -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Assigned User:</h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">{{ $task->user_id }}</p>
            </div>

            <!-- Created At -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Created At:</h3>
                <p class="text-gray-900 bg-gray-100 p-3 rounded-lg shadow-sm">{{ $task->created_at->format("d M, Y") }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('task.edit', $task) }}"
                class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    ✏️ Edit Task
                </a>
                <button type="button"
                        onclick="alert('Task deleted successfully!')"
                        class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-red-700 transition">
                    🗑 Delete
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
