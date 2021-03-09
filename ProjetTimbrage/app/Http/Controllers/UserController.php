<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('option') && $request->input('option') == 'without-department'){
            return User::where('department_id', null)->get();
        } elseif ($request->has('option') && $request->input('option') == 'all') {
            return User::all();
        } else {
            return response('Inertia render',200);
        }

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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'sometimes|nullable|exists:departments,id',
        ]);

        if ($validator->fails()) {
            $result = response('Validation fail : ' . $validator->failed(), 500);
        } else {
            try {
                if ($request->has('department_id')) {
                    $departmentToReturn = $request->input('department_id') != null ? $request->input('department_id') : $user->department_id;
                    $user->department_id = $request->input('department_id');
                }
                $user->save();
                $result = User::where('department_id',  $departmentToReturn)->get();
            } catch (Throwable $e) {
                $result = response('error during user update : ' . $e, 500);
            }
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public static function removeMembersFromDepartment(int $id){
        User::where('department_id', $id)->update(['department_id' => null]);
    }

}
