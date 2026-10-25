<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('DevTask Hub Dashboard') }}
            </h2>
            <a href="/projects/create" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 font-semibold text-sm shadow">
                + New Project
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Quick Link / Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Manage Your Projects</h3>
                    <p class="text-sm text-gray-600">View all active projects, track tasks, and check team assignments.</p>
                </div>
                <a href="/projects" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 font-semibold text-sm">
                    View All Projects &rarr;
                </a>
            </div>
        </div>
    </div>
</x-app-layout>