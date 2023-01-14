<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        try {
            $request->validate([
                'searchDate' => 'required',
            ]);

            $date_to_search = date('Y-m-d', strtotime($request->searchDate));
            $dates = Appointment::where('date', 'like', '%'. $date_to_search .'%')->get();
            
            if ($dates -> count() > 0) {
                return redirect('search')->with(['table' => $dates]);
            } else {
                return redirect('search')->with(['results' => 'No se encontraron citas', 'class' => 'alert-warning']);
            }
            
        } catch (\Throwable $th) {
            return redirect('search')->with(['error' => 'Hubo un error interno', 'class' => 'alert-danger']);
        }   
    }
}
