<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datetime = new DateTime("2019-02-15T16:00:00.0000000Z");
        $timezone = new DateTimeZone('CET');
        $datetime->setTimezone($timezone);

        DB::table('events')->insert([
            'name' => "SQ Party 2019",
            'location' => "Geneva, Palexpo",
            'gmap' => "https://www.google.com/maps/dir/Swissquote+Bank+SA,+Chemin+de+la+Cr%C3%A9taux,+Gland/Palexpo,+Route+Fran%C3%A7ois-Peyrot+30,+1218+Le+Grand-Saconnex/@46.3306213,6.053582,11z/data=!3m1!4b1!4m14!4m13!1m5!1m1!1s0x478c437c978b78ad:0x956a7940b0fb4daf!2m2!1d6.2677941!2d46.4177308!1m5!1m1!1s0x478c64897abb301b:0x809a09de3beff13a!2m2!1d6.1168898!2d46.2363842!3e0",
            'time' => $datetime,
        ]);
    }
}
