<?php

namespace App\Http\Controllers;

use App\Events\TaskAssigned;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\TaskIndexRequest;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskIndexRequest $request)
    {
        $tasks = Project::find($request->validated('project_id'))->tasks;

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $organizationId = Auth::user()->organization_id;

        return view('tasks.create', [
            'project' => $project,
            'users' => User::query()
                ->when($organizationId, fn ($query) => $query->where('organization_id', $organizationId))
                ->orderBy('name')
                ->get(),
            'tags' => Tag::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->safe()->except('tags'));

        $task->tags()->sync($request->validated('tags') ?? []);

        event(new TaskAssigned($task));

        return redirect()->route('projects.show', $task->project_id)
            ->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update t e specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
