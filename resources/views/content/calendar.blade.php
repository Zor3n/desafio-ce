<?php
$current_date = date('Y-m-d H:i');
$last_date = date('Y-m-d H:i', strtotime('+1 month', strtotime($current_date)));
?>
<script>
    var calendar_data = {!! json_encode($data) !!};

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'title',
                center: '',
                end: 'dayGridMonth,timeGridWeek,timeGridDay today prev,next'
            },
            eventSources: [{
                events: calendar_data,
                color: '#206f4d'
            }],
            eventClick: function(info) {
                // alert('Cita: ' + info.event.title + ' \nHora: ' + info.event.start);
                const myModal = new bootstrap.Modal(document.getElementById('calendarDataModal'), {
                    keyboard: true
                });
                console.log(info.event);
                document.getElementById('calendarModalTitle').innerHTML = info.event.title;
                document.getElementById('ownerName').value = info.event.extendedProps.owner_name;
                document.getElementById('petName').value = info.event.extendedProps.pet_name;
                document.getElementById('dateAppointment').value = info.event.extendedProps.date_app;
                document.getElementById('hourAppointment').value = info.event.extendedProps.hour;
                myModal.show();
            }
        });
        calendar.render();
    });
</script>
<x-app-layout>
    <div class="container pt-5 pb-5">
        <div id='calendar'></div>
    </div>
    <div class="modal fade" id="calendarDataModal" tabindex="-1" aria-labelledby="calendarDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="calendarModalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="ownerName" class="col-form-label">{{ __('Dueño:') }}</label>
                            <input type="text" class="form-control" id="ownerName" name="ownerName" readonly>
                        </div>
                        <div class="col">
                            <label for="petName" class="col-form-label">{{ __('Nombre mascota:') }}</label>
                            <input type="text" class="form-control" id="petName" name="petName" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="dateAppointment" class="col-form-label">{{ __('Fecha:') }}</label>
                            <input type="text" class="form-control" id="dateAppointment" name="dateAppointment"
                                readonly>
                        </div>
                        <div class="col">
                            <label for="hourAppointment" class="col-form-label">{{ __('Hora:') }}</label>
                            <input type="text" class="form-control" id="hourAppointment" name="hourAppointment"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Cerrar') }}</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
