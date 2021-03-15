<?php

namespace App\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use App\Models\Clocking;
use App\Traits\AuthTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClockingController extends Controller
{
    use AuthTrait, AuthorizesRequests;
    private $notAllowed = 'You don\'t have the rights to perform this action';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* Check the user rights according to related policies, if not return a brutal 403 error */
        try {
            $this->authorize('viewAny', [Clocking::class, $this->userGrade()]);
        }catch (Throwable $e){
            return response($e, 403);
        }
  
        /* Show all */
        return Inertia::render('Clockings/Clockings');
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
        /* Check the user rights according to related policies, if not return a brutal 403 error */
        try {
            $this->authorize('create', [Clocking::class, $this->userGrade()]);
        } catch (Throwable $e){
            return response($this->notAllowed, 403);
        }

        /* Validator */
        $validator = Validator::make($request->all(), [
            'timeStamp' => 'required',
        ]);

        /* Store */
        if ($validator->fails()) {
            return response('Données invalides', 500);
        }
        try {
            $user = auth()->user();
            $clocking = new Clocking;
            $clocking->user_id = $user->id;
            $clocking->clocking = $request->input('timeStamp');
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
    public function show(Request $request)
    {
        try {
            $this->authorize('viewAny', [Clocking::class, $this->userGrade()]);
        }catch (Throwable $e){
            return response($this->notAllowed, 403);
        }

        /* Validation */
        $validator = Validator::make($request->all(), [
            'date' => 'required|string'
        ]);


        if ($validator->fails()) {
            return response('Données invalides', 500);
        }

        /* Store */
        try{
            $user = auth()->user();
            $date = $request->query('date');
            $nextDay = date('Y-m-d', strtotime($date . ' +1 day'));
            $clocking = new Clocking;
            $dayClockings = $clocking->select('clocking')
                                        ->where('user_id', $user->id)
                                        ->where('clocking', '>=', $date)
                                        ->where('clocking', '<', $nextDay)
                                        ->get();
            $clockingsList = [];
            foreach ($dayClockings as $dayClocking) {
                array_push($clockingsList, substr($dayClocking['clocking'],10));
            }
            return response()->json(['date' =>$date, 'clockingsList' => $clockingsList], 200);
        } catch(Throwable $e) {
                return response('Impossible récupérér les pointages', 500);
        }
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
