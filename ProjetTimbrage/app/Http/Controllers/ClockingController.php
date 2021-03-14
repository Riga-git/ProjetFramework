<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Clocking;
use Carbon\Carbon;
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
        $clockings = Clocking::all();
        foreach ($clockings as $clocking) {
          echo $clocking->clocking;
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
        $validator = Validator::make($request->all(), [
            'timestamp' => 'required',
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
            return response("Erreur lors de la création d'un nouveau pointage", 500);
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

    public static function getClockingsForUserByPeriode(int $id, Carbon $start, Carbon $stop){
      return Clocking::where([['clocking', '>=', $start],
                              ['clocking', '<=', $stop],
                              ['user_id', $id]])->orderBy('clocking')->get();
    }
}
