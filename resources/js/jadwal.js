// resources/js/jadwal.js
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '/events',
        dateClick: function(info) {
            $('#eventDate').val(info.dateStr);
            $('#eventModal').modal('show');
        },
        eventClick: function(info) {
            // Handle event click
        }
    });
    calendar.render();

    // Handle form submission
    $('#eventForm').submit(async function(e) {
        e.preventDefault();
        
        const formData = {
            title: $('#eventTitle').val(),
            date: $('#eventDate').val(),
            start_time: $('#eventStart').val(),
            end_time: $('#eventEnd').val(),
            visibility: $('#eventVisibility').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        try {
            const response = await fetch('/events', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            if (response.ok) {
                calendar.refetchEvents();
                $('#eventModal').modal('hide');
                this.reset();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
    const userRole = document.getElementById('userRole').dataset.role;
    if (userRole === 'karyawan') {
        $('#eventVisibility').closest('.form-group').hide();
    }
});