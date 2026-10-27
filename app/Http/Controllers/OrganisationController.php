<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class OrganisationController extends Controller
{
    public function index()
    {
        $organisation = Auth::user()->organisation;

        if ($organisation) {
            $organisation->load(['projects' => function ($query) {
                $query->withCount('tasks')->latest();
            }]);
        }

        return view('organisations.index', compact('organisation'));
    }
}
