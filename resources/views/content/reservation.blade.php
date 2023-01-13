<x-app-layout>
    <div class="container pt-5 pb-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#saveDataModal">
            {{ __('Reservar') }}
        </button>


        <div class="modal fade" id="saveDataModal" tabindex="-1" aria-labelledby="saveDataModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="saveDataModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('reservation') }}" onsubmit="return saveDataCheck();">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="txtTitulo" class="col-form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo"
                                        placeholder="Nombre" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                @csrf
                                <button type="submit" class="btn btn-primary">Guardar</button>
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
                        $selection = $appointment->id . ",'" . $appointment->id_user . "','" . $appointment->name . "','" . $appointment->last_name . "','" . $appointment->pet_name . "','" . $appointment->date . "'," . $appointment->state . ",'" . url('reservation') . "'";
                        ?>

                        <tr>
                            <th scope="row">{{ $appointment->id }}</th>
                            <td>{{ $appointment->id_user }}</td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->last_name }}</td>
                            <td>{{ $appointment->pet_name }}</td>
                            <td>{{ $appointment->date }}</td>
                            @if ($appointment->state == 0)
                                <td>{{ __('ESPERA') }}</td>
                            @else
                                <td>{{ __('CANCELADO') }}</td>
                            @endif
                            <td><a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalActualizar"
                                    onclick="updateAppointment(<?php echo $selection; ?>);" role="button">EDITAR</a></td>
                            <td><a class="btn btn-danger" href="" role="button">ELIMINAR</a></td>
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

        <!--Actualizar Alojamiento-->
        <div class="modal fade" id="modalActualizar" tabindex="-1" aria-labelledby="modalActualizarLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalActualizarLabel">Actualizar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form id="formActualizar" method="POST" onsubmit="return checkUpdateData();">
                        <div class="modal-body">
                            @method('PUT')
                            <div class="mb-3">
                                <label for="updateName" class="col-form-label">{{ __('Nuevo Nombre:') }}</label>
                                <input type="text" class="form-control" id="updateName" name="updateName"
                                    required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            @csrf
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
