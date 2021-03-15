$(document).ready(function () {
    $('#upcomingBookingsTable').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "searching": false,
        "bAutoWidth": true,
        "aaSorting": [ [2,'asc'] ],
        "columnDefs": [
            { "width": "10%", "targets": 0 }
        ]
    });

    $('#bookingTable').dataTable({
        "bPaginate": true,
        "pagingType": "full_numbers",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aaSorting": [ [4,'asc'], [2,'asc']],
        "columnDefs": [
            { "width": "20%", "targets": 0 }
        ]
    });

    $('#barbersTable').dataTable({
        "bPaginate": false,
        "aaSorting": [ [4,'desc']]
    });
});