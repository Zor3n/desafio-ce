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
            'appointments' => DB::table('appointments')->simplePaginate(5), 
        ]);
    }

    public function search(Request $request)
    {
        try {
            $request->validate([
                'searchDate' => 'required',
            ]);

            $date_to_search = date('Y-m-d', strtotime($request->searchDate));
            $dates = DB::table('appointments')
                ->where('date', 'like', '%' . $date_to_search . '%')
                ->get();

            if ($dates->count() > 0) {
                return view('content.reservation', [
                    'appointments' => $dates,
                ]);
            } else {
                return redirect('reservation')->with(['updates' => 'No se encontraron citas', 'class' => 'alert-warning']);
            }
        } catch (\Throwable $th) {
            return redirect('reservation')->with(['updates' => 'Hubo un error interno', 'class' => 'alert-danger']);
        }
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
                'meetingTime' => 'required|date_format:Y-m-d\TH:i',
            ]);

            $consulta = new Appointment();
            $consulta->id_user = $request->userId;
            $consulta->name = $request->userName;
            $consulta->last_name = $request->userLastName;
            $consulta->pet_name = $request->userPetName;

            $selected_user_time = strtotime($request->meetingTime);
            $minimum_margin_time = strtotime(date('Y-m-d H:i', strtotime('2 hour')));

            if ($selected_user_time < $minimum_margin_time) {
                return redirect('reservation')->with(['updates' => 'Por favor, seleccione una fecha apropiada con un margen de dos horas', 'class' => 'alert-danger']);
            }

            if ($this->checkAppointmentDate($request->meetingTime) == false) {
                return redirect('reservation')->with(['updates' => 'Fecha ingresada no disponible', 'class' => 'alert-danger']);
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
            $request->validate([
                'updateUserId' => 'required|string|max:10',
                'updateUserName' => 'required|string|max:30',
                'updateUserLastName' => 'required|string|max:30',
                'updateUserPetName' => 'required|string|max:30',
                'updateMeetingTime' => 'required|date_format:Y-m-d\TH:i',
            ]);

            $consulta = Appointment::find($id);
            $consulta->id_user = $request->updateUserId;
            $consulta->name = $request->updateUserName;
            $consulta->last_name = $request->updateUserLastName;
            $consulta->pet_name = $request->updateUserPetName;

            $current_date_time = strtotime(date($consulta->date));
            $request_date_time = strtotime(date($request->updateMeetingTime));
            $check_date =  strtotime(date('Y-m-d H:i', strtotime('-2 hour', $current_date_time)));
            $current_time = strtotime(date('Y-m-d H:i'));


            if ($current_date_time != $request_date_time) {
                if ($current_time > $check_date) {
                    return redirect('reservation')->with(['updates' => 'No se puede actualizar la fecha con menos de dos horas para la cita.', 'class' => 'alert-danger']);
                }

                if ($this->checkAppointmentDate($request->updateMeetingTime) == false) {
                    return redirect('reservation')->with(['updates' => 'Fecha ingresada no disponible.', 'class' => 'alert-danger']);
                }
            }

            $consulta->date = $request->updateMeetingTime;

            if ($request->updateState == 'on') {
                $consulta->state = 1;
            } else {
                $consulta->state = 0;
            }

            $consulta->update();
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

    private static function checkAppointmentDate($date)
    {
        try {
            $format_date = date('Y-m-d H:i', strtotime($date));
            $consulta = Appointment::where('date', '=', $format_date);

            if ($consulta->count() > 0) {
                return false;
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
