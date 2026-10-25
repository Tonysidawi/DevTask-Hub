@extends('layouts.project')

@section('title', 'Edit '.$project->name.' - DevTask Hub')

@section('content')
    <div class="max-w-xl mx-auto mt-12 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Project</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/projects/{{ $project->id }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="organization_id">Organization</label>
                <select id="organization_id" name="organization_id" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring focus:ring-blue-200">
                    @foreach ($organizations as $org)
                        <option value="{{ $org->id }}" @selected(old('organization_id', $project->organization_id) == $org->id)>
                            {{ $org->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="name">Project Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', $project->name) }}" class="w-full border-gray-300 rounded-md shadow-sm border p-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="description">Description</label>
                <textarea id="description" name="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm border p-2">{{ old('description', $project->description) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="status">Status</label>
                <select id="status" name="status" class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                    <option value="active" @selected(old('status', $project->status) === 'active')>Active</option>
                    <option value="archived" @selected(old('status', $project->status) === 'archived')>Archived</option>
                </select>
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="/projects/{{ $project->id }}" class="text-gray-600 hover:underline">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 font-semibold">Update Project</button>
            </div>
        </form>
    </div>
@endsection
