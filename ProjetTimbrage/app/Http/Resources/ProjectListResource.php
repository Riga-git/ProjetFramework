<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectListResource extends JsonResource
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
            'totalHours' => CarbonInterval::seconds($this->assignment()->sum(DB::raw('TIME_TO_SEC(`duration`)')))->cascade()->format('%H:%I:%S')
          ];
    }
}