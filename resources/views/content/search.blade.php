<?php
$current_date = date('Y-m-d');

?>
<x-app-layout>
    <div class="container pt-5 pb-5">
        <form class="d-flex" role="search" method="POST" action="{{ route('search') }}">
            <input class="form-control mx-5" type="date" id="searchDate" name="searchDate" value="{{ $current_date }}"
                required>
            @csrf
            <button class="btn btn-outline-success" type="submit">{{__('Buscar')}}</button>
        </form>

        @if (session('table'))
            <div class="table-responsive rounded mt-5 pb-3">
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
                        <?php $dates = session('table'); ?>
                        @foreach ($dates as $date)
                            <?php
                            $update_selection = $date->id . ",'" . $date->id_user . "','" . $date->name . "','" . $date->last_name . "','" . $date->pet_name . "','" . $date->date . "'," . $date->state . ",'" . url('reservation') . "'";
                            $delete_selection = $date->id . ",'" . $date->id_user . "','" . $date->name . "','" . $date->date . "','" . url('reservation') . "'";
                            ?>

                            <tr>
                                <th scope="row">{{ $date->id }}</th>
                                <td>{{ $date->id_user }}</td>
                                <td>{{ $date->name }}</td>
                                <td>{{ $date->last_name }}</td>
                                <td>{{ $date->pet_name }}</td>
                                <td>{{ $date->date }}</td>
                                @if ($date->state == 0)
                                    <td>{{ __('EN ESPERA') }}</td>
                                @else
                                    <td>{{ __('CANCELADO') }}</td>
                                @endif
                                {{-- <td><a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateDataModal"
                                    onclick="updateAppointment(<?php echo $update_selection; ?>);"
                                    role="button">{{ __('EDITAR') }}</a></td>
                            <td><a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDataModal"
                                    onclick="deleteAppointment(<?php echo $delete_selection; ?>);"
                                    role="button">{{ __('ELIMINAR') }}</a></td> --}}
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
            </div>
        @endif

        @if (session('results') || session('error'))
            <div id="updatesAlert" class="alert mt-5 alert-dismissible fade show {{ session('class') }}"
                role="alert">
                {{ session('results') }}
                {{ session('error') }}
                <button type="button" class="btn btn-close ms-5" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
    </div>
</x-app-layout>
