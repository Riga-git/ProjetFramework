<?php

namespace App\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProjectListResource;
use App\Http\Resources\ProjectDetailResource;

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
        return Inertia::render('Project/ProjectsList', [ 'projects' => $projects]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:255',
            'number' => 'required|digits_between:1,15',
        ]);

        if ($validator->fails()) {
            return response('Données invalides', 500);
        }
        try {
            $project = new Project;
            $project->name = $request->input('name');
            $project->number = $request->input('number');
            $project->save();
;           return response(200);
        } catch (Throwable $e) {
            return response("Erreur lors de la création d'un nouveau projet", 500);
        }  
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
        return Inertia::render('Project/ProjectDetail', ['project' => $projectsDetails]);
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:255',
            'number' => 'required|required|digits_between:1,15',
        ]);

        if ($validator->fails()) {
            return response('Données invalides', 500);
        }

        try {
            //$data =  $request->input('name');
            $project->name = $request->input('name');
            $project->number = $request->input('number');
            $project->save();
            $newProj = ProjectDetailResource::collection(Project::where('id', $project->id)->get());
            
;           return response()->json(['newProj' => $newProj], 200);
        } catch (Throwable $e) {
            return response('Erreur lors de la mise à jour du projet', 500);
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
        try{
            $project->delete();
            return response('Erreur lors de la suppression', 500);
        } catch(Throwable $e){
            return response(500);
        }
    }
}
