<?php

namespace App\Http\Controllers;

use App\Http\Resources\CalendarResource;
use App\Models\Calendar;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CalendarResource::collection(Calendar::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
//        dd($inputs);
//        print $inputs;
        $calendar = new Calendar([
            'id' => $inputs['id'],
            'user_id' => $inputs['user_id'],
            'title' => $inputs['title'],
            'start' => $inputs['start'],
            'end' => $inputs['end'],
            'start_recur' => $inputs['start_recur'],
            'end_recur' => $inputs['end_recur'],
            'start_time' => $inputs['start_time'],
            'end_time' => $inputs['end_time'],
            'color' => $inputs['color'],
            'overlap' => $inputs['overlap'],
            'editable' => $inputs['editable'],
            'selectable' => $inputs['selectable'],
            'parent_id' => $inputs['parent_id'],
        ]);
        $calendar->save();
        return response()->json([
            'data' => $calendar,
            'message' => 'Successfully added new event!',
            'status' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calendar = Calendar::query()->find($id);
        if (!$calendar) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response($calendar, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $calendar)
    {
        $calendar->update($request->all());
        return response()->json([
            'data' => new CalendarResource($calendar),
            'message' => 'Successfully updated event!',
            'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calendar = Calendar::query()->find($id);
        if (!$calendar) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        $calendar->delete();
        return response('Event removed successfully!', 200);
    }

    public function getCalendarByUserId(int $user_id)
    {
        $data = Calendar::query()
            ->where('user_id',$user_id)
            ->orderBy('id','desc')->get();
        return CalendarResource::collection($data);
    }
}
