<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Organisation;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $projects = Project::where('organization_id', Auth::user()->organisation->id)->with(['tasks.tags'])->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $organizations = Organisation::all();

        return view('projects.create', compact('organizations'));
    }

    public function store(StoreProjectRequest $request, ProjectService $projectService)
    {
        $projectService->createProject($request->validated());

        return redirect('projects')->with('success', 'Project created successfully!');
    }

    public function show(Project $project)
    {
        Gate::authorize('view', $project);

        $project->load(['organisation', 'tasks.tags', 'tasks.user']);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        Gate::authorize('update', $project);

        $organizations = Organisation::all();

        return view('projects.edit', compact('project', 'organizations'));
    }

    public function update(StoreProjectRequest $request, Project $project)
    {
        Gate::authorize('update', $project);

        $project->update($request->validated());

        return redirect('/projects/'.$project->id)->with('success', 'Project updated successfully!');
    }
}
