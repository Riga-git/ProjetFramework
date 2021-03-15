<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Traits\AuthTrait;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AssignmentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $now = Carbon::now();
      $start = Carbon::now()->firstOfMonth();
      $stop = Carbon::now()->lastOfMonth()->hour(23)->minute(59)->second(59);
      $clockingsForThisMonth = ClockingController::getClockingsForUserByPeriode(Auth::user()->id, $start, $stop);

      $workingTime = [1 => 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 31 Days maximum
      $currentFilledDay = 0;
      $currentDailyWorkingTime = CarbonInterval::hour(0);
      $clockingOdd = null;
      $clockingEven = null;

      foreach ($clockingsForThisMonth as $entry) {
        $entryCarbon = Carbon::parse($entry->clocking);
        $newDay = $entryCarbon->day;

        if ($newDay !== $currentFilledDay){
          $clockingOdd = $entryCarbon;
          $clockingEven = null;
          if ($currentFilledDay !== 0){
            $workingTime[$currentFilledDay] = $currentDailyWorkingTime;
            $currentDailyWorkingTime = CarbonInterval::hour(0);
          }
          $currentFilledDay = $newDay;
        }
        else {
          if (is_null($clockingOdd)){
          $clockingOdd = $entryCarbon;
        }
          else {
            $clockingEven = $entryCarbon;
            $diff = $clockingEven->diffAsCarbonInterval($clockingOdd);
            $currentDailyWorkingTime->add($diff);
            $clockingOdd = null;
            $clockingEven = null;
          }

        }
      }

      if ($currentDailyWorkingTime->greaterThanOrEqualTo(CarbonInterval::minute())){
        $workingTime[$currentFilledDay] = $currentDailyWorkingTime->toArray();
      }


      return Inertia::render('Assignments/Assignments',['actualMonth' => $now->month,
                                                        'actualYear' => $now->year,
                                                        'assigmentsForBaseMonth' => $workingTime]);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
