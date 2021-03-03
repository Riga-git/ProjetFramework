<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\ProjectListResource;
use App\Http\Resources\ProjectDetailResource;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = ProjectListResource::collection(Project::all());
        return Inertia::render('ProjectsList', [ 'projects' => $projects]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $projectsDetails = ProjectDetailResource::collection(Project::where('id', $project->id)->get());
        return Inertia::render('ProjectDetail', ['project' => $projectsDetails]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        try {
            $data =  $request->input('newValues');
            $project->name = $data[0]['name'];
            $project->number = $data[0]['number'];
            $project->save();
            $newProj = Project::findOrFail($project->id);
            
;           return response()->json(['newProj' => $newProj], 200);
        } catch (Throwable $e) {
            return response('Error',500);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
