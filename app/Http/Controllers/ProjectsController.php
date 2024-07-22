<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // app/Http/Controllers/ProjectsController.php

// app/Http/Controllers/ProjectsController.php

// app/Http/Controllers/ProjectsController.php

public function index()
{
    $projects = Project::all(); // Fetch all projects
    return view('admin.home', ['projects' => $projects]); // Pass 'projects' to the view
    
}




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'project_name' => 'required|string|max:255',
        'project_type' => [
            'required',
            'string',
            'in:Scrum,Kanban',
        ],
        // Add validation rules for other fields if needed
    ]);

    // Create a new project in the database
    $project = new Project();
    $project->name = $request->input('project_name');
    $project->type = $request->input('project_type');
    // Assign other fields
    $project->save();

    // Return a response (e.g., redirect or JSON response)
    return redirect()->back();
}




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
