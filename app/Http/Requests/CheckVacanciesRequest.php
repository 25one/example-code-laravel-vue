<?php

namespace App\Http\Requests;

class CheckVacanciesRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'dateStart' => 'required|date|after:tomorrow',
            'dateEnd' => 'required|date|after:dateStart',             
        ];
    }
}
