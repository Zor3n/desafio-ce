<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function get_data()
    {
        try {
            $data = DB::table('appointments')->select(['name', 'pet_name', 'date'])
                ->where('state', '=', 0)
                ->get();

            $calendar_data = [];

            //[{"date":"va"}, {"date":"va"}, {"date":"va"}]
            foreach ($data as $value) {
                $object = (object) [
                    'title' => $value->name.' - '.$value->pet_name,
                    'start' => $value->date,
                ];
                array_push($calendar_data, $object);
            }

            return view('content.calendar', ['data' => $calendar_data]);
        } catch (\Throwable $th) {
            return view('content.calendar');
        }
    }
}
