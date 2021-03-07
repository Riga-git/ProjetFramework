<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentDetailResource;
use App\Http\Resources\DepartmentOverviewResource;
use App\Models\Department;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Throwable;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $departments = DepartmentOverviewResource::collection(Department::all());
      return Inertia::render('Department/DepartmentsList', [ 'departments' => $departments]);
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
      $departmentWithDetails = DepartmentDetailResource::collection(Department::where('id', $department->id)->get());

      return Inertia::render('Department/DepartmentDetail', ['departmentDetail' => $departmentWithDetails]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        try {
            $department->user_id = $request->input('leader');
            $department->save();
            $result = DepartmentDetailResource::collection(Department::where('id', $department->id)->get());
        } catch (Throwable $e){
            $result = response('error', 500);
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
