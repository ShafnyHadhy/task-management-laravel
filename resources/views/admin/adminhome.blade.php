<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center bg-gray-900 py-4 px-6">
            <h4 class="text-white text-lg font-semibold">
                Welcome, {{ Auth::user()->name }} — Manage Your System Efficiently
            </h4>
            <span class="text-sm text-gray-300">
                Admin Dashboard • {{ now()->format('d M, Y') }}
            </span>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-6 pb-12">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <div class="bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition border">
                <h3 class="text-white font-semibold text-lg mb-2">Total Categories</h3>
                <p class="text-3xl font-bold text-blue-400">{{ $cateCount }}</p>
                <a href="{{ route('category.index') }}" class="mt-3 inline-block text-blue-100 text-sm font-medium hover:underline">
                    View Categories →
                </a>
            </div>

            <div class="bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition border">
                <h3 class="text-white font-semibold text-lg mb-2">Total Tasks</h3>
                <p class="text-3xl font-bold text-green-400">{{ $taskCount }}</p>
                <a href="{{ route('task.index') }}" class="mt-3 inline-block text-green-100 text-sm font-medium hover:underline">
                    Manage Tasks →
                </a>
            </div>

            <div class="bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition border">
                <h3 class="text-white font-semibold text-lg mb-2">Registered Users</h3>
                <p class="text-3xl font-bold text-yellow-400">{{ $usersCount }}</p>
                <a href="#" class="mt-3 inline-block text-yellow-100 text-sm font-medium hover:underline">
                    View Users →
                </a>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl shadow p-6 mb-10 border">
            <div class="flex flex-row gap-3">
                <h2 class="text-xl font-bold text-white mb-6">Quick Actions</h2>
                <x-heroicon-s-forward class="w-8 h-8 text-gray-200"/>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('category.create') }}" class="px-5 py-3 border bg-gray-900 text-gray-100 text-sm rounded-md shadow hover:bg-gray-700 transition">
                    Create Category
                </a>
                <a href="{{ route('task.create') }}" class="px-5 py-3 border bg-gray-900 text-gray-100 text-sm rounded-md shadow hover:bg-gray-700 transition">
                    Create Task
                </a>
                <a href="{{ route('task.index') }}" class="px-5 py-3 border bg-gray-900 text-gray-100 text-sm rounded-md shadow hover:bg-gray-700 transition">
                    View All Tasks
                </a>
            </div>
        </div>

        <div class="bg-gray-800 rounded-xl shadow p-6 border">
            <h2 class="text-xl font-bold text-white mb-4">Task Assignment Overview</h2>

            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-700 text-gray-100 uppercase text-sm">
                        <th class="px-4 py-3 border-b">Task</th>
                        <th class="px-4 py-3 border-b">Assigned User</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b">Deadline</th>
                    </tr>
                </thead>

                @foreach ($tasks as $task)

                    <tbody class="divide-y divide-gray-200 text-white bg-gray-900">
                        <tr>
                            <td class="px-4 py-3">{{ $task->task_name }}</td>
                            <td class="px-4 py-3">{{ $task->user->name ?? 'Unassigned' }}</td>
                            <td class="px-4 py-3 text-yellow-500 font-medium">{{ $task->status }}</td>
                            <td class="px-4 py-3">{{ $task->deadline }}</td>
                        </tr>
                    </tbody>

                @endforeach

            </table>
        </div>
    </div>
</x-app-layout>
