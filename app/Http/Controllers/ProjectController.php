<?php

namespace App\Http\Controllers;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
class ProjectController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required',
            'docs' => 'required',
        ]);
        $imagePath = $request->file('image')->store('images', 'public');

$docs = [];

foreach ($request->file('docs') as $file) {

    $docs[] = $file->store('docs', 'public');

}


$project = new Projects();
$project->type = $request->type;
$project->title = $request->title;
$project->description = $request->description;
$project->image = $imagePath;
$project->docs = json_encode($docs); // Store document paths as JSON
$project->user_id = Auth::id();
$project->save();
        return redirect(route('dashboard', absolute: false));
    }
    public function index(Request $request)

{

    $projects = Projects::all(); // Example: Fetch all projects


    return Inertia::render('Dashboard', [

        'projects' => $projects

    ]);

}

}

