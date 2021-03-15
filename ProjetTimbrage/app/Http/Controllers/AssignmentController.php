<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssignmentResource;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Project;
use App\Traits\AuthTrait;
use App\Models\Assignment;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AssignmentController extends Controller
{


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    try{
      if ($request->has('month') && intval($request->input('month')) >= 1 && intval($request->input('month')) <= 12
          && $request->has('year') && intval($request->input('year')) >= 2021 && intval($request->input('year')) <= 3000){

            /* Force to the 1st of the selected month to avoid overflow (i.e : we are 31 of mach and try to show february => will return a date in march) */
            $now = Carbon::createFromDate(intval($request->input('year')), intval($request->input('month')), 1);
            $start = Carbon::createFromDate(intval($request->input('year')), intval($request->input('month')), 1)->firstOfMonth();
            $stop = Carbon::createFromDate(intval($request->input('year')), intval($request->input('month')), 1)->lastOfMonth();

            $workingTime = $this->getWorkingTimePerDay($start, $stop);
      }
      else {
        $now = Carbon::now();
        $start = Carbon::now()->firstOfMonth();
        $stop = Carbon::now()->lastOfMonth()->hour(23)->minute(59)->second(59);

        $workingTime = $this->getWorkingTimePerDay($start, $stop);
      }

      return Inertia::render('Assignments/Assignments',['actualMonth' => $now->month,
                                                        'actualYear' => $now->year,
                                                        'workingTimeForMonth' => $workingTime,]);
    }
    catch (Throwable $e){
      return response('Error during assignment rendering : ' . $e, 500);
    }
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

  public function getAssigmentsForDate(Request $request){
    $validator = Validator::make($request->all(), [
      'day' => 'required|min:1|max:31',
      'month' => 'required|min:1|max:12',
      'year' => 'required|min:0|max:3000',
    ]);

    if ($validator->fails()) {
      return response('Validation fail :' . implode("\n", $validator->failed()), 500);
    }
    else {
      try{
        $start = Carbon::create($request->input('year'), $request->input('month'), $request->input('day'), 0, 0, 0)->toDateString();

        $assignments = AssignmentResource::collection(Assignment::where([['date', $start],
                                                                        ['user_id', Auth::user()->id]])->get());

        return ['projectsList' => Project::all(),
                'assigments' => $assignments];
      }
      catch (Throwable $e) {
        return response('Error during assignment listing', 500);
      }
    }
  }

  private function getWorkingTimePerDay(Carbon $start, Carbon $stop){
    $clockingsForThisMonth = ClockingController::getClockingsForUserByPeriode(Auth::user()->id, $start, $stop);

    $workingTime = array_fill($start->day, $stop->day, 0); // 31 Days maximum
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

    return $workingTime;
  }
}
