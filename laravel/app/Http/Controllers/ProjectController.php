<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pet_name' => 'string|max:255',
            'sex' => 'in:Male,Female',
            'age' => 'integer|min:0',
            'breed' => 'nullable|string',
            'contact_person' => 'string|max:255',
            'contact_number' => 'string|max:20',
            'pet_description' => 'string',
            'reward' => 'nullable|numeric|min:0',
            'pet_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;

        // Handle image upload
        if ($request->hasFile('pet_photo')) {
            $image = $request->file('pet_photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/pets', $imageName);  // Save the image
        }

        // Create the project with the uploaded photo
        $project = Project::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'pet_name' => $request->pet_name,
            'sex' => $request->sex,
            'age' => $request->age,
            'breed' => $request->breed,
            'contact_person' => $request->contact_person,
            'contact_number' => $request->contact_number,
            'pet_description' => $request->pet_description,
            'reward' => $request->reward,
            'pet_photo' => $imageName,  // Save the image name in the database
        ]);

        return redirect()->route('project.editor', $project->id);
    }


    public function update(Request $request, Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pet_name' => 'nullable|string|max:255',
            'sex' => 'nullable|in:Male,Female',
            'age' => 'nullable|integer|min:0',
            'breed' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'pet_description' => 'nullable|string',
            'reward' => 'nullable|numeric|min:0',
            'pet_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make sure to use 'pet_photo' here
        ]);

        //pet photo
        if ($request->hasFile('pet_photo')) {
            // Delete old image if it exists and the file is found
            if ($project->pet_photo && file_exists(storage_path('app/public/pets/' . $project->pet_photo))) {
                unlink(storage_path('app/public/pets/' . $project->pet_photo));
            }

            // Store new image in 'pets' directory under 'public' disk
            $petPhoto = $request->file('pet_photo');
            $imagePath = $petPhoto->store('pets', 'public');

            // Save the relative path to database
            $project->pet_photo = $imagePath;
        }

        // Update other fields
        $project->update($request->only([
            'title', 'description', 'pet_name', 'sex', 'age', 'breed',
            'contact_person', 'contact_number', 'pet_description', 'reward'
        ]));

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


    public function changeTemplate(Request $request, Project $project)
    {
        $validated = $request->validate([
            'template_id' => 'required|string'
        ]);

        $project->template_id = $validated['template_id'];
        $project->save();

        return response()->json(['status' => 'success']);
    }

    public function uploadThumbnail(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'thumbnail' => 'required|image|mimes:png,jpeg,webp|max:2048',
        ]);

        $project = Project::findOrFail($request->project_id);

        $filename = 'thumb_' . time() . '_' . uniqid() . '.png';
        $path = 'images/project-thumbnails/' . $filename;

        $request->file('thumbnail')->move(public_path('images/project-thumbnails'), $filename);

        $project->thumbnail_path = $path;
        $project->save();

        return response()->json(['success' => true, 'path' => asset($path)]);
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('editor', compact('project'));
    }
}
