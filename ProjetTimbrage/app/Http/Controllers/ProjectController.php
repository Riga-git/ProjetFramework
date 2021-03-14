<?php

namespace App\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProjectListResource;
use App\Http\Resources\ProjectDetailResource;
use App\Traits\AuthTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{

  use AuthTrait, AuthorizesRequests;

  private $notAllowed = 'You don\'t have the rights to perform this action';

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    /* Check the user rights according to related policies, if not return a brutal 403 error */
    try {
      $this->authorize('viewAny', [Project::class, $this->userGrade()]);
    }
    catch (Throwable $e){
      return response($e, 403);
    }

    /* Show all */
    $projects = ProjectListResource::collection(Project::all());
    return Inertia::render('Project/ProjectsList', [ 'projects' => $projects]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    /* Check the user rights according to related policies, if not return a brutal 403 error */
    try {
      $this->authorize('create', [Project::class, $this->userGrade()]);
    }
    catch (Throwable $e){
      return response($this->notAllowed, 403);
    }

    /* Validation */
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|min:1|max:255',
        'number' => 'required|digits_between:1,15',
    ]);

    /* Store */
    if ($validator->fails()) {
        return response('Données invalides', 500);
    }
    try {
        $project = new Project;
        $project->name = $request->input('name');
        $project->number = $request->input('number');
        $project->save();
        return response(200);
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
    /* Check the user rights according to related policies, if not return a brutal 403 error */
    try {
      $this->authorize('view', [Project::class, $this->userGrade()]);
    }
    catch (Throwable $e){
      return response($this->notAllowed, 403);
    }

    /* Show */
    $projectsDetails = ProjectDetailResource::collection(Project::where('id', $project->id)->get());
    return Inertia::render('Project/ProjectDetail', ['project' => $projectsDetails]);
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
    /* Check the user rights according to related policies, if not return a brutal 403 error */
    try {
      $this->authorize('update', [Project::class, $this->userGrade()]);
    }
    catch (Throwable $e){
      return response($this->notAllowed, 403);
    }

    /* Validator */
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:1|max:255',
      'number' => 'required|required|digits_between:1,15',
    ]);

    if ($validator->fails()) {
      return response('Données invalides', 500);
    }

    /* Update */
    try {
      $project->name = $request->input('name');
      $project->number = $request->input('number');
      $project->save();
      $newProj = ProjectDetailResource::collection(Project::where('id', $project->id)->get());
      return response()->json(['newProj' => $newProj], 200);
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
    /* Check the user rights according to related policies, if not return a brutal 403 error */
    try {
      $this->authorize('delete', [Project::class, $this->userGrade()]);
    }
    catch (Throwable $e){
      return response($this->notAllowed, 403);
    }

    try{
      $project->delete();
      return response('OK', 200);
    } catch(Throwable $e){
      return response('Erreur lors de la suppression', 500);
    }
  }
}
