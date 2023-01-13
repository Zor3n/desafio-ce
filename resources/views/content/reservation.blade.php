<x-app-layout>
    <div class="container pt-5 pb-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            {{ __('Reservar') }}
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive rounded">
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
                            <td><a class="btn btn-warning" href="#" role="button">EDITAR</a></td>
                            <td><a class="btn btn-danger" href="#" role="button">ELIMINAR</a></td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td>@fat</td>
                        <td>@fat</td>
                        <td>@fat</td>
                        <td>@fat</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                        <td>@twitter</td>
                    </tr>
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
        </div>
    </div>
</x-app-layout>
