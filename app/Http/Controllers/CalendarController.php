<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    /**
     * This method is used to get the data from de db for the calendar.
     * This method change the object from the db to an array that the Full Calendar API can read and use
     * to create events.
     * 
     * @return \Illuminate\Http\Response
     */
    public function get_data()
    {
        try {
            $data = DB::table('appointments')
                ->select(['id_user', 'name', 'last_name', 'pet_name', 'date'])
                ->where('state', '=', 0)
                ->get();
            $calendar_data = [];

            foreach ($data as $value) {
                $object = (object) [
                    'title' => 'Cita: #' . $value->id_user,
                    'owner_name' => $value->name . ' ' . $value->last_name,
                    'pet_name' => $value->pet_name,
                    'start' => $value->date,
                    'date_app' => date('Y-m-d', strtotime($value->date)),
                    'hour' => date('H:i', strtotime($value->date)),
                ];
                array_push($calendar_data, $object);
            }
            return view('content.calendar')->with('data', $calendar_data);
        } catch (\Throwable $th) {
            return view('content.calendar')->with('data', []);
        }
    }
}
