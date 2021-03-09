<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentDetailResource;
use App\Http\Resources\DepartmentOverviewResource;
use App\Models\Department;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:255',
            'leader' => 'sometimes|nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            $result = response('Validation fail : ' . $validator->failed(), 500);
        } else {
            try {
                $department = new Department;
                if ($request->has('leader')) {
                    $department->user_id = $request->input('leader');
                }
                $department->name = $request->input('name');
                $department->save();
                $result = DepartmentOverviewResource::collection(Department::all());
            }
            catch (Throwable $e){
                $result = response('Error during department creation', 500);
            }

            return $result;
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), [
            'leader' => 'sometimes|nullable|exists:users,id',
            'name' => 'sometimes|required|min:1|max:255'
        ]);

        if ($validator->fails()) {
            $result = response('Validation fail : ' . $validator->failed(), 500);
        } else {
            try {
                if ($request->has('leader')) {
                    $department->user_id = $request->input('leader');
                }
                if ($request->has('name')) {
                    $department->name = $request->input('name');
                }
                $department->save();
                $result = DepartmentDetailResource::collection(Department::where('id', $department->id)->get());
            } catch (Throwable $e) {
                $result = response('Error during department update', 500);
            }
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
