<x-app-layout>
    <div class="max-w-5xl mx-auto px-6 py-10">

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-2">Update Task</h2>
            <a href="{{ route('task.index') }}"
               class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-400 transition">
                ← Back to Tasks
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
            <form action="{{ route('task.update', $task) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="mb-6">
                    <label for="task_name" class="block text-sm font-semibold text-gray-700 mb-1">Task Name:</label>
                    <input type="text" id="task_name" name="task_name" value="{{ $task->task_name }}"
                        class="w-full p-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 shadow-sm focus:ring focus:ring-blue-200"
                        placeholder="Enter task name"
                        @if(Auth::user()->role !== 'admin') readonly class="bg-gray-100 cursor-not-allowed" @endif>
                    @error('task_name')
                        <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description:</label>
                    <textarea readonly id="description" name="description" rows="4"
                        class="w-full p-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 shadow-sm focus:ring focus:ring-blue-200"
                        placeholder="Enter description"
                        @if(Auth::user()->role !== 'admin') readonly class="bg-gray-100 cursor-not-allowed" @endif>{{ $task->description }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if(Auth::user()->role === 'admin')
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1">Select Category:</label>
                        <select id="category_id" name="category_id"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300">
                            <option value="{{ $task->category_id }}">
                                {{ $task->category->category_name ?? 'Select Category' }}
                            </option>
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
                @endif


                @php
                    $today = date('Y-m-d');
                @endphp

                @if(Auth::user()->role === 'admin')
                    <div class="mb-6">
                        <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-1">Deadline:</label>
                        <input type="date" id="deadline" name="deadline" min="{{ $today }}"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300">
                        @error('deadline')
                            <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <div class="mb-6">
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Task Status:</label>
                    <select id="status" name="status"
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300">
                        <option value="">{{ ucfirst($task->status) }}</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if(Auth::user()->role === 'admin')
                    <div class="mb-6">
                        <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-1">Assign To (User):</label>
                        <select id="user_id" name="user_id"
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300">
                            <option value="{{ $task->user_id }}">
                                {{ $task->user->name ?? 'Select User' }}
                            </option>
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
                @endif

                <div class="mt-8">
                    <button type="submit"
                        class="w-full bg-gray-600 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-gray-800 focus:ring-2 focus:ring-green-400 transition">
                        ✅ Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
