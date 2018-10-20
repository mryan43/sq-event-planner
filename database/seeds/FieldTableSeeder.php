<?php

use Illuminate\Database\Seeder;

class FieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fields')->insert([
            'id' => 1,
            'type' => 'radio',
            'label' => 'Will you be present at the event ?',
            'options' => 'Yes;No'
        ]);

        DB::table('fields')->insert([
            'id' => 2,
            'type' => 'radio',
            'label' => 'Will you take your own car to go to the event ?',
            'options' => 'Yes;No',
            'help' => 'There will be no shuttle transports this year, parking is 12 CHF for the night'
        ]);

        DB::table('fields')->insert([
            'id' => 3,
            'type' => 'radio',
            'label' => 'Do you need a hotel room ?',
            'help' => 'Answer "No" if you already have a room (FAME participants) or if you have another accommodation plan for the night.',
            'options' => 'Yes;No'
        ]);

        DB::table('fields')->insert([
            'id' => 4,
            'type' => 'doubletext',
            'label' => 'Who do you want to share the room with ?',
            'options' => 'Yes;No',
            'help' => 'Rooms have 3 occupants in total, input the name and department of the persons you want to share the room with',
            'condition' => "3:Yes"
        ]);


        DB::table('fields')->insert([
            'id' => 5,
            'type' => 'radio',
            'label' => 'Do you have any dietary restrictions (for example allergies) ?',
            'options' => 'Yes;No'
        ]);

        DB::table('fields')->insert([
            'id' => 6,
            'type' => 'text',
            'label' => 'Which ones ?',
            'condition' => "5:Yes"
        ]);

        for ($i = 2; $i < 7; $i++){
            DB::table('event_fields')->insert([
                'event_id' => 1,
                'field_id' => $i
            ]);
        }

    }
}
