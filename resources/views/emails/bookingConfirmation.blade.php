<html>
<body>


Dear  {{ $user->name }},  <br> your booking has been successfully added.
<br>
Booking Type : {{ $booking->booking_type }} <br>
Booking Date : {{ $booking->booking_date }}<br>
Start Time   : {{ $booking->start_time }} <br>
End Time     : {{ $booking->end_time }} <br>
Booking Code : {{ $booking->booking_code }}

<br>&nbsp;<br><br>Regards, <br> <b> Sahasragrand </b>

</body>

</html>