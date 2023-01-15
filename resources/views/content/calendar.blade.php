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
                alert('Cita: ' + info.event.title + ' \nHora: ' + info.event.start);
            }
        });
        calendar.render();
    });
</script>
<x-app-layout>
    <div class="container pt-5 pb-5">
        <div id='calendar'></div>
    </div>
</x-app-layout>
