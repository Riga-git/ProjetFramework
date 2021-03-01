<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\Assignment;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'name' => $this->name,
            'assignments' => $this->assignment()->with('user')->get(),
            'totalHours' => CarbonInterval::seconds($this->assignment()->sum(DB::raw('TIME_TO_SEC(`duration`)')))->cascade()->format('%H:%I:%S')
          ];
    }
}
