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

        $project = Project::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'pet_name' => 'Pet name',
            'sex' => 'Male',
            'age' => 1,
            'breed' => 'Breed',
            'contact_person' => 'John Doe',
            'contact_number' => '1234-567-890',
            'pet_description' => 'Some description about my pet.',
            'reward' => 1000,
        ]);

        return redirect()->route('project.editor', $project->id);
    }


    public function update(Request $request, Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'pet_name' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'age' => 'required|integer|min:0',
            'breed' => 'nullable|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'pet_description' => 'required|string',
            'reward' => 'nullable|numeric|min:0',
        ]);

        $project->update($request->only([
            'pet_name', 'sex', 'age', 'breed',
            'contact_person', 'contact_number',
            'pet_description', 'reward'
        ]));

        if ($request->ajax()) {
            return response()->json(['message' => 'Saved']);
        }

        return redirect()->route('project.editor', $project->id)
            ->with('success', 'Project updated successfully.');
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

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('editor', compact('project'));
    }
}
