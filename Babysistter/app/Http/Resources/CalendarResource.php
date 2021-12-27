<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
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
            'title' => $this->title,
            'start' => $this->start,
            'end' => $this->end,
            'startRecur' =>$this->start_recur,
            'endRecur'=>$this->end_recur,
            'startTime' =>$this->start_time,
            'endTime'=>$this->end_time,
            'user_id' =>$this->user_id,
            'status' =>$this->status,
            'color' =>$this->color,
            'editable' =>$this->editable,
            'selectable' =>$this->selectable,
        ];
    }
}
