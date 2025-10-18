<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Page Heading -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">✏️ Update Task</h2>
            <a href="{{ route('task.index') }}"
                class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 transition">
                ← Back to Tasks
            </a>
        </div>

        <!-- Form Container -->
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto">
            <form action="{{ route('task.update', $task) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method("put")
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="task_name" class="block text-sm font-medium text-gray-700">Task Name:</label>
                    <input disabled type="text" id="task_name" name="task_name" value="{{ $task->task_name }}"
                        class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                        placeholder="Enter task name">
                    @error("task_name")
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                    <textarea disabled id="description" name="description" rows="4"
                                class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                placeholder="Enter description">{{ $task->description }}</textarea>
                    @error("description")
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category Selection -->
                @if(Auth::user()->role === 'admin')
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Select Category:</label>
                        <select id="category_id" name="category_id"
                                class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300">
                            <option value="">{{ $task->category_id }}</option>
                            <option value="1">Finance</option>
                            <option value="2">Marketing</option>
                            <option value="3">Development</option>
                            <option value="4">Design</option>
                        </select>
                        @error("category_id")
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <!-- Deadline -->
                @if(Auth::user()->role === 'admin')
                    <div class="mb-4">
                        <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline:</label>
                        <input type="date" id="deadline" name="deadline"
                            class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300">
                        @error("deadline")
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Task Status:</label>
                    <select id="status" name="status"
                            class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300">
                        <option value="">{{ $task->status }}</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    @error("status")
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Assigned User (static for now) -->
                @if(Auth::user()->role === 'admin')
                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Assign To (User):</label>
                        <select id="user_id" name="user_id"
                                class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300">
                            <option value="">{{ $task->user_id }}</option>
                            <option value="1">Admin</option>
                            <option value="2">John Doe</option>
                            <option value="3">Jane Smith</option>
                        </select>
                        @error("user_id")
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                            class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-green-700 transition">
                        ✅ Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
