<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_type');
            $table->date('booking_date')->nullable();
            $table->time('start_time')->default('00:00'); 
            $table->time('end_time')->default('00:00');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('total_guests')->default(0);
            $table->string('status')->nullable();
            $table->string('booking_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
