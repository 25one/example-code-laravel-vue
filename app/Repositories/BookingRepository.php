<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\Reservation;

class BookingRepository
{

    /**
     * The Model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelRoom;  
    protected $modelReservation; 

    /**
     * Create a new TaskRepository instance.
     *
     * @param  \App\Models\Room $model      
     */
    public function __construct(Room $room, Reservation $reservation)
    {
        $this->modelRoom = $room;
        $this->modelReservation = $reservation;
    } 

    /**
     * Display a listing of auth-reservations.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReservations()
    {
        return $this->modelReservation
                    ->userReservations()
                    ->with('room')
                    ->get();
    }    

    /**
     * Display a listing of all items.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getVacancies($request)
    {
        $rooms = $this->modelRoom
                   ->with('reservations')
                   ->get();
        
        $vacancies = [];  
        
        if (count($rooms)) {
            foreach ($rooms as $room) {
            $notVacancies = false;  
            foreach ($room->reservations as $reservation) {  
                if (strtotime($reservation->date_start) < strtotime($request->dateEnd) 
                    && strtotime($reservation->date_end) > strtotime($request->dateStart)) {
                    $notVacancies = true;
                    break;
                }   
            } 
            if (! $notVacancies) {
                $vacancies[] = $room;
            }        
            }  
        }  
        
        return $vacancies;     
    }

    public function getRoom($request)
    {
        $room = $this->modelRoom->find($request->id);

        return $room;
    }    

    /**
     * Store new item.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function putReservation($request)
    {
        $this->modelReservation->user_id = \Auth::guard('api')->user()->id;
        $this->modelReservation->room_id = $request->room_id;
        $this->modelReservation->date_start = $request->date_start;
        $this->modelReservation->date_end = $request->date_end;
        $this->modelReservation->save();       
    }

}
