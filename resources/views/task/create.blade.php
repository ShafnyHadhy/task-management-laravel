<x-app-layout>
    <div class="max-w-5xl mx-auto px-6 py-10">

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-white flex items-center gap-2">Create New Task</h2>
            <a href="{{ route('task.index') }}"
               class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-400 transition">
                ← Back to Tasks
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
            <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="task_name" class="block text-sm font-semibold text-gray-700 mb-1">Task Name:</label>
                        <input type="text" id="task_name" name="task_name" value=""
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400"
                            placeholder="Enter task name">
                        @error('task_name')
                            <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description:</label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400"
                            placeholder="Enter task details"></textarea>
                        @error('description')
                            <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1">Select Category:</label>
                        <select id="category_id" name="category_id"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        @php $today = date('Y-m-d'); @endphp
                        <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-1">Deadline:</label>
                        <input type="date" id="deadline" name="deadline" min="{{ $today }}"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                        @error('deadline')
                            <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Task Status:</label>
                        <select id="status" name="status"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                            <option value="pending">Pending</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-1">Assign To:</label>
                        <select id="user_id" name="user_id"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                            <option value="">-- Select User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit"
                        class="w-full bg-gray-600 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-gray-800 focus:ring-2 focus:ring-blue-400 transition">
                        🚀 Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
