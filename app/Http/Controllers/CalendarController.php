<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Event;
class CalendarController extends Controller
{
    public function index() {
        $events = Event::all();
        return view('pages.calendar', compact('events'));
    }
    public function getEvent(){
        if(request()->ajax()){
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $events = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)
                    ->get(['id','title','start', 'end']);
            return response()->json($events);
        }
        return view('pages.calendar');

    }

    public function createEvent(Request $request)
    {
        $event = new Event;
        $event->title = $request->title;
        $event->start = $request->start; 
        $event->end = $request->end;
        $event->save();

        return response()->json($event);
    }


    public function deleteEvent(Request $request){
        $event = Event::find($request->id);
        return $event->delete();
    }
    public function updateEvent(Request $request, $id)
{
    $event = Event::find($id);
    $event->title = $request->title;
    $event->start = $request->start;
    $event->end = $request->end;
    $event->save();

    return response()->json($event);
}

}