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
        return view('content.reservation', [
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
        try {
            $request->validate([
                'userId' => 'required|max:10',
                'userName' => 'required|max:30',
                'userLastName' => 'required|max:30',
                'userPetName' => 'required|max:30',
                'meetingTime' => 'required',
            ]);

            $consulta = new Appointment();
            $consulta->id_user = $request->userId;
            $consulta->name = $request->userName;
            $consulta->last_name = $request->userLastName;
            $consulta->pet_name = $request->userPetName;
            $consulta->date = $request->meetingTime;
            $consulta->state = 0;
            //return $request;

            $consulta->save();

            return redirect('reservation');
        } catch (\Throwable $th) {
            return redirect('/');
        }
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
            $request->validate([
                'updateUserId' => 'required|string|max:10',
                'updateUserName' => 'required|string|max:30',
                'updateUserLastName' => 'required|string|max:30',
                'updateUserPetName' => 'required|string|max:30',
                'updateMeetingTime' => 'required',
            ]);

            $consulta = Appointment::find($id);
            $consulta->id_user = $request->updateUserId;
            $consulta->name = $request->updateUserName;
            $consulta->last_name = $request->updateUserLastName;
            $consulta->pet_name = $request->updateUserPetName;
            $consulta->date = $request->updateMeetingTime;
            $consulta->state = 0;

            // $consulta->email = $request->email_edit;

            $consulta->update();

            return redirect('reservation');

            //return redirect()->back();
        } catch (\Throwable $th) {
            return redirect('reservation')->with(['updates' => 'Registro NO actualizado.', 'class' => 'text-bg-primary']);
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
