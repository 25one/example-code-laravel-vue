<?php

namespace App\Http\Requests;

class ReservationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'room_id' => 'required|integer',
            'date_start' => 'required|date|after:tomorrow',
            'date_end' => 'required|date|after:dateStart',             
        ];
    }
}
