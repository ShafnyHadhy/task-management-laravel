<x-app-layout>
    <div class="container mx-auto px-4">
        <!-- Create Task Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">📜 Tasks</h2>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('task.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    ➕ Create New Task
                </a>
            @endif
        </div>

        <!-- Task Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <tr>
                        {{-- <th class="px-4 py-3 text-left">ID</th> --}}
                        <th class="px-4 py-3 text-left">Task</th>
                        <th class="px-4 py-3 text-left">Description</th>
                        <th class="px-4 py-3 text-left">CAT ID</th>
                        <th class="px-4 py-3 text-left">Assig Date</th>
                        <th class="px-4 py-3 text-left">Deadline</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        @if(Auth::user()->role === 'admin')
                            <th class="px-4 py-3 text-left">Assigned User</th>
                        @endif
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($tasks as $task)
                        <tr class="hover:bg-gray-100 transition">
                            {{-- <td class="px-4 py-3">{{ $task->id }}</td> --}}
                            <td class="px-4 py-3 font-semibold text-gray-900">{{ $task->task_name }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ Str::limit($task->description, 50) }}</td>
                            <td class="px-4 py-3 text-gray-800">{{ $task->category_id }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $task->assignment_date }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $task->deadline }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ ucfirst($task->status) }}</td>

                            @if(Auth::user()->role === 'admin')
                                <td class="px-4 py-3 text-gray-800">
                                    {{ $task->user->name ?? 'Unassigned' }}
                                </td>
                            @endif

                            <td class="px-4 py-3 flex justify-center space-x-2">
                                <a href="{{ route('task.show', $task) }}" class="px-2 py-2 text-white text-xs font-semibold rounded shadow-md hover:bg-blue-600 transition">
                                    👁
                                </a>
                                <a href="{{ route('task.edit', $task) }}" class="px-2 py-2 text-white text-xs font-semibold rounded shadow-md hover:bg-yellow-600 transition">
                                    ✏️
                                </a>
                                <form method="POST" action="{{ route('task.destroy', $task) }}">
                                    @csrf
                                    @method("delete")
                                    @if(Auth::user()->role === 'admin')
                                        <button onclick="return confirm('Are you sure you want to delete this task?')"
                                            class="px-2 py-2 bg-white text-white text-xs font-semibold rounded shadow-md hover:bg-red-600 transition">
                                            🗑
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-500 font-semibold">
                                🚫 No tasks assigned yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>
