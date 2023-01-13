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

            $selected_user_time = strtotime($request->meetingTime);
            $current_time = strtotime(date('Y-m-d H:i'));
            $minimum_margin_time = strtotime(date('Y-m-d H:i', strtotime('2 hour')));

            if($selected_user_time < $current_time){
                return redirect('reservation')->with(['savesAlert' => 'Por favor, seleccione una fecha apropiada', 'class' => 'alert-danger']);
            }else if ($selected_user_time < $minimum_margin_time) {
                return redirect('reservation')->with(['savesAlert' => 'Por favor, seleccione una fecha apropiada con un margen de dos horas', 'class' => 'alert-danger']);
            }
            
            $consulta->date = $request->meetingTime;
            $consulta->state = 0;

            $consulta->save();
            return redirect('reservation')->with(['updates' => 'Registro creado correctamente', 'class' => 'alert-success']);
        } catch (\Throwable $th) {
            return redirect('reservation')->with(['updates' => 'Registro NO añadido.', 'class' => 'alert-danger']);
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
            $is = 200/0;
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

            //$consulta->update();
            return redirect('reservation')->with(['updates' => 'Registro actualizado correctamente', 'class' => 'alert-success']);
        } catch (\Throwable $th) {
            return redirect('reservation')->with(['updates' => 'Registro NO actualizado.', 'class' => 'alert-danger']);
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
        try {
            $consulta = Appointment::find($id);
            $consulta->delete();
            return redirect('reservation')->with(['updates' => 'Registro eliminado correctamente', 'class' => 'alert-success']);
        } catch (\Throwable $th) {
            return redirect('reservation')->with(['updates' => 'Registro NO se ha eliminado.', 'class' => 'alert-danger']);
        }
    }
}
