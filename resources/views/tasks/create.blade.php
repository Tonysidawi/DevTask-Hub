@extends('layouts.project')

@section('title', 'Add Task - DevTask Hub')

@section('content')
    <div class="max-w-xl mx-auto mt-12 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Add a Task</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/tasks" method="POST" class="space-y-4">
            @csrf

            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Project</p>
                <p class="text-lg font-bold text-gray-900">{{ $project->name }}</p>
                <input type="hidden" name="project_id" value="{{ $project->id }}">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="title">Title</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" class="w-full border-gray-300 rounded-md shadow-sm border p-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="description">Description</label>
                <textarea id="description" name="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm border p-2">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="user_id">Assign to</label>
                <select id="user_id" name="user_id" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring focus:ring-blue-200" required>
                    <option value="">Select a person</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id', auth()->id()) == $user->id)>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="priority">Priority</label>
                <select id="priority" name="priority" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring focus:ring-blue-200">
                    @foreach (['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('priority', 'medium') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="status">Status</label>
                <select id="status" name="status" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring focus:ring-blue-200">
                    @foreach (['todo' => 'To do', 'in_progress' => 'In progress', 'completed' => 'Completed'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', 'todo') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="due_date">Due date</label>
                <input id="due_date" type="date" name="due_date" value="{{ old('due_date') }}" class="w-full border-gray-300 rounded-md shadow-sm border p-2">
            </div>

            <fieldset>
                <legend class="block text-gray-700 font-semibold mb-1">Tags</legend>
                <div class="flex flex-wrap gap-3">
                    @forelse ($tags as $tag)
                        <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', [])))>
                            {{ $tag->name }}
                        </label>
                    @empty
                        <p class="text-sm text-gray-500">No tags yet.</p>
                    @endforelse
                </div>
            </fieldset>

            <div class="flex justify-between items-center mt-6">
                <a href="/projects/{{ $project->id }}" class="text-gray-600 hover:underline">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 font-semibold">Save Task</button>
            </div>
        </form>
    </div>
@endsection
