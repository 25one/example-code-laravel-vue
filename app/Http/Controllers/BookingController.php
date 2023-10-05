<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookingRepository;
use App\Http\Requests\CheckVacanciesRequest;
use App\Http\Requests\ReservationRequest;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookingRepository $repository)
    {
        $this->repository = $repository;
    }  

    /**
     * Display a list of auth-reservations.
     *
     * @return \Illuminate\Http\Response
     */
    public function reservations()
    {
        return $this->repository->getReservations();
    }

    /**
     * Display a list of the vacancies.
     *
     * @return \Illuminate\Http\Response
     */
    public function vacancies(CheckVacanciesRequest $request)
    {
        return $this->repository->getVacancies($request);
    }

    /**
     * Display a room information.
     *
     * @return \Illuminate\Http\Response
     */
    public function room(Request $request) 
    {
        return $this->repository->getRoom($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reservation(ReservationRequest $request)
    {
        $task = $this->repository->putReservation($request);
     }

}
