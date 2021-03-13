<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Clocking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClockingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'timestamp' => 'required|string|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return response('Données invalides', 500);
        }
        try {
            $clocking = new Clocking;
            $clocking->clocking = $request->input('timestamp');
            $clocking->save();
;           return response(200);
        } catch (Throwable $e) {
            return response("Erreur lors de la création d'un nouveau projet", 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clocking  $clocking
     * @return \Illuminate\Http\Response
     */
    public function show(Clocking $clocking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clocking  $clocking
     * @return \Illuminate\Http\Response
     */
    public function edit(Clocking $clocking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clocking  $clocking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clocking $clocking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clocking  $clocking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clocking $clocking)
    {
        //
    }
}
