<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'AllRooms' => Room::all()
        ]);
    }

    public function filter(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
        ]);
    
        $date = $request->date;
        $startTime = $request->start_time ?? '00:00';
        $endTime = $request->end_time ?? '23:59';
    
        $startDateTime = new \DateTime("{$date} {$startTime}:00");
        $endDateTime = new \DateTime("{$date} {$endTime}:59");
    
        $startDateTimeFormatted = $startDateTime->format('Y-m-d H:i:s');
        $endDateTimeFormatted = $endDateTime->format('Y-m-d H:i:s');
    
        $AllRooms = Room::where(function ($query) use ($startDateTimeFormatted, $endDateTimeFormatted) {
            $query->whereBetween('dateStart', [$startDateTimeFormatted, $endDateTimeFormatted])
                  ->orWhereBetween('dateEnd', [$startDateTimeFormatted, $endDateTimeFormatted])
                  ->orWhere(function ($q) use ($startDateTimeFormatted, $endDateTimeFormatted) {
                    
                      $q->where('dateStart', '<=', $startDateTimeFormatted)
                        ->where('dateEnd', '>=', $endDateTimeFormatted);
                  });
        })->get();
    
        return view('home', compact('AllRooms', 'startDateTimeFormatted', 'endDateTimeFormatted'));
    }
    
    
}
