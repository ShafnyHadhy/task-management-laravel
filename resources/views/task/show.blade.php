<x-app-layout>
    <div class="max-w-5xl mx-auto px-6 py-10">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-2">Task Details</h2>
            <a href="{{ route('task.index') }}"
               class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-400 transition">
                ← Back to Tasks
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
            <!-- Two-column grid layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Task Name:</h3>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-200">{{ $task->task_name }}</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Category:</h3>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-200">
                        {{ $task->category->category_name ?? 'N/A' }}
                    </p>
                </div>

                <div class="mb-6 md:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Description:</h3>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-200 leading-relaxed">{{ $task->description }}</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Assignment Date:</h3>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-200">{{ $task->assignment_date }}</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Deadline:</h3>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-200">{{ $task->deadline }}</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Status:</h3>
                    <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold
                        @if($task->status === 'completed') bg-green-100 text-green-700
                        @elseif($task->status === 'pending') bg-yellow-100 text-yellow-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ ucfirst($task->status) }}
                    </span>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Assigned User:</h3>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-200">
                        {{ $task->user->name ?? 'Unassigned' }}
                    </p>
                </div>

                <div class="mb-6 md:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">Created At:</h3>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-200">
                        {{ $task->created_at->format('d M, Y') }}
                    </p>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('task.edit', $task) }}"
                   class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-800 focus:ring-2 focus:ring-blue-400 transition">
                    Edit Task
                </a>

                @if(Auth::user()->role === 'admin')
                    <form method="POST" action="{{ route('task.destroy', $task) }}">
                        @csrf
                        @method('delete')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this task?')"
                                class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-red-700 focus:ring-2 focus:ring-red-400 transition">
                            Delete Task
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
