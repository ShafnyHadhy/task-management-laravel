<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between bg-gray-900 py-4 px-6">
            <h4 class="text-white text-lg font-semibold">{{ __("Welcome, " . Auth::user()->name . "! Here's your dashboard.") }}</h4>
            <span class="text-sm text-gray-300">
                {{ now()->format('d M, Y') }}
            </span>
        </div>
    </x-slot>

    <div class="pb-12">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gray-800 border border-red-200 rounded-xl shadow-lg p-8 flex flex-row items-center justify-center gap-10 hover:shadow-xl transition-shadow duration-300">
                <x-heroicon-s-arrow-right-circle class="w-14 h-14 text-white mb-4"/>
                <div class="flex flex-col items-center gap-2">
                    <span class="text-white text-2xl font-semibold">Pending Tasks</span>
                    <span class="text-3xl font-bold text-red-500 mt-2">{{ "0".$pending }}</span>
                </div>
            </div>

            <div class="bg-gray-800 border border-blue-200 rounded-xl shadow-lg p-8 flex flex-row items-center justify-center gap-5 hover:shadow-xl transition-shadow duration-300">
                <x-heroicon-s-bolt class="w-14 h-14 text-white mb-4"/>
                <div class="flex flex-col items-center gap-2">
                    <span class="text-white text-2xl font-semibold">Tasks In Progress </span>
                    <span class="text-3xl font-bold text-blue-500 mt-2">{{ "0".$inProgress }}</span>
                </div>
            </div>

            <div class="bg-gray-800 border border-green-200 rounded-xl shadow-lg p-8 flex flex-row items-center justify-center gap-5 hover:shadow-xl transition-shadow duration-300">
                <x-heroicon-s-check-circle class="w-14 h-14 text-white mb-4"/>
                <div class="flex flex-col items-center gap-2">
                    <span class="text-white text-2xl font-semibold">Completed Tasks</span>
                    <span class="text-3xl font-bold text-green-500 mt-2">{{ "0".$completed }}</span>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-6 rounded-lg mt-6 border">
                <span class="font-bold text-lg mb-6 block text-white">{{ __("Upcoming Deadlines") }}</span>

                @forelse ($toComplete as $task)
                    <div class="flex flex-col mt-4 p-4 bg-gray-200 rounded-lg hover:bg-gray-300 transition max-w-5xl mx-auto">

                        <div class="flex justify-between items-center w-full">
                            <div class="font-semibold text-gray-800">
                                {{ $task->task_name }}
                            </div>

                            <div class="text-right text-sm font-semibold">
                                @if($task->days_left > 3)
                                    <span class="text-green-600">{{ $task->days_left }} day{{ $task->days_left > 1 ? 's' : '' }} left</span>
                                @elseif($task->days_left > 0)
                                    <span class="text-orange-600">{{ $task->days_left }} day{{ $task->days_left > 1 ? 's' : '' }} left</span>
                                @elseif($task->days_left == 0)
                                    <span class="text-red-600">Due today</span>
                                @else
                                    <span class="text-red-500">{{ abs($task->days_left) }} day{{ abs($task->days_left) > 1 ? 's' : '' }} overdue</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex justify-between items-center w-full mt-2">
                            <div class="text-gray-800 text-sm">
                                {{ $task->description }}
                            </div>

                            <div>
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($task->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($task->status === 'in-progress') bg-blue-100 text-blue-700
                                    @endif">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500 font-semibold">
                        All tasks are completed 🎉
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
