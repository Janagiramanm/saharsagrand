
    <div class="col-md-12">
        <div class="title">
            <h3>Booked For {{ $booking->booking_type }} </h3>
        </div>
        <div class="row">
            Name : {{ $booking->user->name }}
        </div>
        <div class="row">
             Date: {{ $booking->booking_date }}
        </div>
        <div class="row">
             Start Time: {{ $booking->start_time }}
        </div>
        <div class="row">
             End Time: {{ $booking->end_time }}
        </div>
        <div class="row">
             Reference Code: {{ $booking->booking_code }}
        </div>


    <div class="">
        <a href="/"> Go Back </a>
    </div>
    </div>

