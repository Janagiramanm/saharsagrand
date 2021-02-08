
    <div class="col-md-12 booking-result">
        
        <table class="table">
             <tr>
                 <th colspan="2">
                  <h3>Booked For {{ $booking->booking_type }} </h3>
                 </th>
            </tr>
            <tr>
                <td>Name </dt>
                <td>{{ $booking->user->name }}</dt>
            </tr>
            <tr>
                <td>Date </dt>
                <td>{{ $booking->booking_date }}</dt>
            </tr>
            <tr>
                <td>Start Time </dt>
                <td>{{ $booking->start_time }}</dt>
            </tr>
            <tr>
                <td>End Time </dt>
                <td>{{ $booking->end_time }}</dt>
            </tr>
            <tr>
                <td>Reference Code </dt>
                <td>{{ $booking->booking_code }}</dt>
            </tr>
        </table>
        <div class="">
            <a href="/"> Go Back </a>
        </div>
    </div>

