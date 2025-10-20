<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-10">

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-white flex items-center gap-2">Tasks</h2>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('task.create') }}"
                   class="px-5 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-800 transition">
                    + New Task
                </a>
            @endif
        </div>

        <form method="GET" action="{{ route('task.index') }}" class="flex flex-col lg:flex-row justify-between items-center mb-6 gap-4">
            <div class="flex flex-row items-center justify-end gap-3 w-full">

                <div class="">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search tasks..."
                        class="py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-200 w-96 text-sm">
                </div>

                <div>
                    <select name="status"
                        class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-200 text-sm">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div>
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition text-sm">
                        Search
                    </button>

                    @if(request('search') || request('status'))
                        <a href="{{ route('task.index') }}" class="text-sm text-gray-100 hover:underline">
                            ✖ Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <div class="bg-white/95 shadow-xl rounded-lg overflow-hidden border border-gray-200">
            <table class="w-full border-collapse">
                <thead class="bg-gray-700 text-white uppercase text-sm font-semibold tracking-wide">
                    <tr>
                        <th class="px-5 py-3 text-left">Task & Description</th>
                        <th class="px-5 py-3 text-left">Category</th>
                        <th class="px-5 py-3 text-left">Assigned Date</th>
                        <th class="px-5 py-3 text-left">Deadline</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        @if(Auth::user()->role === 'admin')
                            <th class="px-5 py-3 text-left">Assigned User</th>
                        @endif
                        <th class="px-5 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-gray-800">
                    @forelse ($tasks as $task)
                        <tr class="hover:bg-white transition">
                            <td class="px-5 py-3">
                                <div class="font-semibold text-gray-900">{{ $task->task_name }}</div>
                                <div class="text-gray-700 text-sm">{{ Str::limit($task->description, 50) }}</div>
                            </td>
                            <td class="px-5 py-3 text-gray-700">{{ $task->category->category_name ?? 'N/A' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $task->assignment_date }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $task->deadline }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($task->status === 'completed') bg-green-100 text-green-700
                                    @elseif($task->status === 'pending') bg-yellow-100 text-yellow-700
                                    @else bg-gray-300 text-gray-700 @endif">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>

                            @if(Auth::user()->role === 'admin')
                                <td class="px-5 py-3 text-gray-700">
                                    {{ $task->user->name ?? 'Unassigned' }}
                                </td>
                            @endif

                            <td class="px-5 py-3 flex justify-center items-center space-x-2">
                                <a href="{{ route('task.show', $task) }}" title="View"
                                   class="px-3 py-2 bg-blue-300 text-white text-xs font-semibold rounded-md shadow hover:bg-blue-500 transition">
                                    👁
                                </a>
                                <a href="{{ route('task.edit', $task) }}" title="Edit"
                                   class="px-3 py-2 bg-green-300 text-white text-xs font-semibold rounded-md shadow hover:bg-green-500 transition">
                                    ✏️
                                </a>
                                @if(Auth::user()->role === 'admin')
                                    <form method="POST" action="{{ route('task.destroy', $task) }}">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Are you sure you want to delete this task?')" title="Delete"
                                                class="px-3 py-2 bg-red-300 text-white text-xs font-semibold rounded-md shadow hover:bg-red-500 transition">
                                            🗑
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-8 text-gray-500 font-semibold">
                                🚫 No tasks found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-center">
            {{ $tasks->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
