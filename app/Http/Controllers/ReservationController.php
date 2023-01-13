<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content.reservation',[
            'appointments' => DB::table('appointments')->simplePaginate(5), #all data on table
            // 'users' => Appointment::where('id', '==', 1)->paginate(1), #selected data on table
        ]);
        // return Appointment::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user_ = Appointment::findOrFail($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // error_log($id);
        
        try {
            // $request->validate([
                //     'name_edit' => 'required|string|max:100',
                //     'email_edit' => 'required|string|email|max:255|unique:users',
                // ]);
                
            $consulta = Appointment::find($id);
            
            $consulta->name = $request->updateName;
            
            // $consulta->email = $request->email_edit;
            
            $consulta->update();
            
            return redirect('reservation');
            
            //return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th; //return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
