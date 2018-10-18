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
        $datetime = new DateTime("2019-02-15T17:00:00.0000000Z");
        $timezone = new DateTimeZone('CET');
        $datetime->setTimezone($timezone);

        DB::table('events')->insert([
            'name' => "SQ Party 2019",
            'time' => $datetime,
        ]);
    }
}
