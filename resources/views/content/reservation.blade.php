<?php
$current_date = date('Y-m-d H:i');
$last_date = date('Y-m-d H:i', strtotime('+1 month', strtotime($current_date)));
?>
<x-app-layout>
    <div class="container pt-5 pb-5">

        <button type="button" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#save-data-modal">
            {{ __('Reservar') }}
        </button>

        <div class="modal fade" id="save-data-modal" tabindex="-1" aria-labelledby="saveDataModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="saveDataModalLabel">{{ __('RESERVAR CITA') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('reservation') }}">
                            {{-- onsubmit="return saveAppointmentDataCheck();"> --}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="userId" class="col-form-label">{{ __('DNI:') }}</label>
                                        <input type="text" class="form-control" id="userId" name="userId"
                                            required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="userName" class="col-form-label">{{ __('Nombre:') }}</label>
                                        <input type="text" class="form-control" id="userName" name="userName"
                                            required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="userLastName" class="col-form-label">{{ __('Apellido:') }}</label>
                                        <input type="text" class="form-control" id="userLastName" name="userLastName"
                                            required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="userPetName"
                                            class="col-form-label">{{ __('Nombre de la mascota:') }}</label>
                                        <input type="text" class="form-control" id="userPetName" name="userPetName"
                                            required>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="meetingTime">{{ __('Seleccionar fecha:') }}</label>
                                        <input class="form-control" type="datetime-local" id="meetingTime"
                                            name="meetingTime" value="{{ $current_date }}" min="{{ $current_date }}"
                                            max="{{ $last_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ __('Cerrar') }}</button>
                                @csrf
                                <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive rounded pb-3">
            <table class="table table-dark table-hover table-striped rounded">
                <thead>
                    <tr>
                        <th scope="col">{{ __('#') }}</th>
                        <th scope="col">{{ __('DNI') }}</th>
                        <th scope="col">{{ __('NOMBRE') }}</th>
                        <th scope="col">{{ __('APELLIDO') }}</th>
                        <th scope="col">{{ __('NOMBRE MASCOTA') }}</th>
                        <th scope="col">{{ __('FECHA CITA') }}</th>
                        <th scope="col">{{ __('ESTADO') }}</th>
                        <th scope="col">{{ __('') }}</th>
                        <th scope="col">{{ __('') }}</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($appointments as $appointment)
                        <?php
                        $update_selection = $appointment->id . ",'" . $appointment->id_user . "','" . $appointment->name . "','" . $appointment->last_name . "','" . $appointment->pet_name . "','" . $appointment->date . "'," . $appointment->state . ",'" . url('reservation') . "'";
                        $delete_selection = $appointment->id . ",'" . $appointment->id_user . "','" . $appointment->name . "','" . $appointment->date . "','" . url('reservation') . "'";
                        ?>

                        <tr>
                            <th scope="row">{{ $appointment->id }}</th>
                            <td>{{ $appointment->id_user }}</td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->last_name }}</td>
                            <td>{{ $appointment->pet_name }}</td>
                            <td>{{ $appointment->date }}</td>
                            @if ($appointment->state == 0)
                                <td>{{ __('EN ESPERA') }}</td>
                            @else
                                <td>{{ __('CANCELADO') }}</td>
                            @endif
                            <td><a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateDataModal"
                                    onclick="updateAppointment(<?php echo $update_selection; ?>);"
                                    role="button">{{ __('EDITAR') }}</a></td>
                            <td><a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDataModal"
                                    onclick="deleteAppointment(<?php echo $delete_selection; ?>);"
                                    role="button">{{ __('ELIMINAR') }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col">{{ __('#') }}</th>
                        <th scope="col">{{ __('DNI') }}</th>
                        <th scope="col">{{ __('NOMBRE') }}</th>
                        <th scope="col">{{ __('APELLIDO') }}</th>
                        <th scope="col">{{ __('NOMBRE MASCOTA') }}</th>
                        <th scope="col">{{ __('FECHA CITA') }}</th>
                        <th scope="col">{{ __('ESTADO') }}</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </tfoot>
            </table>
            {{ $appointments->links() }}
        </div>


        <div class="modal fade" id="updateDataModal" tabindex="-1" aria-labelledby="updateDataModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateDataModalLabel">{{ __('ACTUALIZAR CITA') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form id="updateForm" method="POST" onsubmit="return updateAppointmentDataCheck();">
                        <div class="modal-body">
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="updateUserId"
                                        class="col-form-label">{{ __('Actualizar DNI:') }}</label>
                                    <input type="text" class="form-control" id="updateUserId" name="updateUserId"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="updateUserName"
                                        class="col-form-label">{{ __('Actualizar nombre:') }}</label>
                                    <input type="text" class="form-control" id="updateUserName"
                                        name="updateUserName" required>
                                </div>
                                <div class="col mb-3">
                                    <label for="updateUserLastName"
                                        class="col-form-label">{{ __('Actualizar apellido:') }}</label>
                                    <input type="text" class="form-control" id="updateUserLastName"
                                        name="updateUserLastName" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="updateUserPetName"
                                        class="col-form-label">{{ __('Actualizar nombre de la mascota:') }}</label>
                                    <input type="text" class="form-control" id="updateUserPetName"
                                        name="updateUserPetName" required>
                                </div>
                                <div class="col mb-3">
                                    <label for="updateMeetingTime">{{ __('Seleccionar fecha:') }}</label>
                                    <input class="form-control" type="datetime-local" id="updateMeetingTime"
                                        name="updateMeetingTime" value="{{ $current_date }}"
                                        min="{{ $current_date }}" max="{{ $last_date }}">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cerrar') }}</button>
                            @csrf
                            <button type="submit" class="btn btn-warning">{{ __('Actualizar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="deleteDataModal" tabindex="-1" aria-labelledby="deleteDataModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteDataModalLabel">
                            {{ __('¿Eliminar registro?') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form id="deleteForm" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="deleteAppointmentID"
                                        class="col-form-label">{{ __('DNI:') }}</label>
                                    <input type="text" class="form-control" id="deleteAppointmentID"
                                        name="deleteAppointmentID" disabled>
                                </div>
                                <div class="col mb-3">
                                    <label for="deleteAppointmentName"
                                        class="col-form-label">{{ __('Nombre:') }}</label>
                                    <input type="text" class="form-control" id="deleteAppointmentName"
                                        name="deleteAppointmentName" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="deleteAppointmentDate"
                                        class="col-form-label">{{ __('Fecha:') }}</label>
                                    <input type="text" class="form-control" id="deleteAppointmentDate"
                                        name="deleteAppointmentDate" disabled>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ __('Cerrar') }}</button>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('Eliminar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if (session('updates'))
            <div id="updatesAlert" class="alert alert-dismissible fade show {{ session('class') }}" role="alert">
                {{ session('updates') }}
                <button type="button" class="btn btn-close ms-5 bg-secondary" data-bs-dismiss="alert"
                    aria-label="Close">{{ __('Cerrar') }}</button>
            </div>
        @endif
    </div>
</x-app-layout>
