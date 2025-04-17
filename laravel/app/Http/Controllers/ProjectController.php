<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:256',
            'description' => 'required|string',
        ]);

        Project::create([
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'description'=>$request->description,
        ]);

        return redirect()->back()->with('success', 'Project created successfully');
    }

    public function destroy(Project $project)
    {
        if ($project->user_id == Auth::id()){
            $project->delete();
            return redirect()->back()->with('success', 'Project deleted successfully');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to delete this project');
        }
    }
}
