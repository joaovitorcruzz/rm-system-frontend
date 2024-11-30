<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Models\Roomfn;
use App\Models\RoomFnSchedules;
use App\Models\RoomSchedules;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $TheRoomById = Room::on()
            ->where('id', $id)
            ->first();

        $RoomLinks = Roomfn::on()
            ->where('room_id', $TheRoomById->id)
            ->get();

        foreach ($RoomLinks as $RoomLink) {
            $peopleOnTheRoom[] = User::on()
                ->where('id', $RoomLink->user_id)
                ->get();
        }

        $RoomPictures = explode(',', $TheRoomById->roomPictures);
        $RoomUtils = explode(',', $TheRoomById->utils);

        $RoomSchedules = RoomSchedules::on()
            ->where('room_id', $TheRoomById->id)
            ->get();

        $RoomFnSchedules = RoomFnSchedules::on()
            ->where('room_id', $TheRoomById->id)
            ->get();

        $Roomfn = Roomfn::on()
            ->where('room_id', $id)
            ->get();

        return view('room.index', [
            'TheRoomById' => $TheRoomById,
            'peopleOnTheRoom' => $peopleOnTheRoom ?? NULL,
            'RoomPictures' => $RoomPictures,
            'RoomUtils' => $RoomUtils,
            'RoomSchedules' => $RoomSchedules,
            'RoomFnSchedules' => $RoomFnSchedules,
            'Roomfn' => $Roomfn,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function reserve($room_id, $user_id)
    {
        Roomfn::create([
            'room_id' =>$room_id,
            'user_id' =>$user_id,
        ]);
        
        session()->flash('message', 'Reserva realizada com sucesso!');
        session()->flash('alert-class', 'alert-success');

        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function disreserve($id)
    {
        $disReserve = Roomfn::on()
        ->where('id', $id)
        ->delete();
        
        session()->flash('message', 'Você saiu da sala com sucesso!');
        session()->flash('alert-class', 'alert-danger');

        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function reservetask($room_id, $schedule_id, $user_id)
    {
        // dd($room_id,$schedules_id, $user_id);
        RoomFnSchedules::create([
            'room_id' =>$room_id,
            'schedule_id' =>$schedule_id,
            'user_id' =>$user_id,
        ]);
        
        session()->flash('message', 'Agenda marcada!');
        session()->flash('alert-class', 'alert-success');

        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function disreservetask($id)
    {
        $taskDisreserve = RoomFnSchedules::on()
        ->where('id', $id)
        ->delete();
        
        session()->flash('message', 'Você saiu da reuniao!');
        session()->flash('alert-class', 'alert-danger');

        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
