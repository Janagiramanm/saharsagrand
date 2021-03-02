<?php

use Illuminate\Database\Seeder;
use App\Amenity;
use App\AmenityTime;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $amenities = [
                    'Badminton' => [          
                                    'logo'=>'icon-1.png',
                                    'advance_book'=>2,
                                    'time_slots'=>1
                    ],
                    'Swimming'=> [
                                    'logo'=>'icon-3.png',
                                    'advance_book'=>2,
                                    'time_slots'=>1
                    ],
                    'Gym'=> [
                                    'logo'=>'icon-4.png',
                                    'advance_book'=>2,
                                    'time_slots'=>1
                    ],
                    'Snooker'=> [
                                    'logo'=>'icon-5.png',
                                    'advance_book'=>2,
                                    'time_slots'=>1
                    ],
                    'Table Tennis'=> [
                                    'logo'=>'icon-6.png',
                                    'advance_book'=>2,
                                    'time_slots'=>1
                    ],
                    'Party Hall'=> [
                                    'logo'=>'icon-7.png',
                                    'advance_book'=>Null,
                                    'time_slots'=>0
                    ],
                    'Maintenance Payment'=> [
                                    'logo'=>'icon-8.png',
                                    'advance_book'=>Null,
                                    'time_slots'=>0
                    ],
                    'Grievance'=> [
                                    'logo'=>'icon-9.png',
                                    'advance_book'=>Null,
                                    'time_slots'=>0
                    ]
        ];
        
        // echo '<pre>';
        // print_r($amenities);
        // exit;

        $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

        foreach($amenities as $key => $value){

            $amenity = new Amenity();
            $amenity->name = $key;
            $amenity->logo = $value['logo'];
            $amenity->advance_book = $value['advance_book'];
            $amenity->active = TRUE;
           // $amenity->time_slots = $amenity['time_slots'];
            $amenity->save();
            foreach($days as $day){
                   $time = new AmenityTime();
                   $time->amenity_id = $amenity->id;
                   $time->day = $day;
                   $time->start_time = '06:00';
                   $time->end_time = '20:00';
                   $time->active = TRUE;
                   $time->save();
            }
       
        }
        exit;
        
    }
}
