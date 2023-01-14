<script>
    var calendar_data = {!! json_encode($data) !!};
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: calendar_data
        });
        calendar.render();
    });
</script>
<x-app-layout>
    <div class="container pt-5 pb-5">
        <div id='calendar'></div>
    </div>
</x-app-layout>
