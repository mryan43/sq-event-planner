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

        $id = 1;
        DB::table('fields')->insert([
            'id' => $id++,
            'type' => 'radio',
            'label' => 'Will you be present at the event ?',
            'options' => 'Yes;No'
        ]);

        DB::table('fields')->insert([
            'id' => $id++,
            'type' => 'text',
            'label' => 'Why not ? (Optional)',
        ]);

        DB::table('fields')->insert([
            'id' => $id++,
            'type' => 'radio',
            'label' => 'Do you need accommodation for the night (hotel) ?',
            'help' => 'Answer "No" if you already have a room (FAME participants) or if you have another accommodation plan for the night.',
            'options' => 'Yes;No'
        ]);

        DB::table('fields')->insert([
            'id' => $id++,
            'type' => 'doubletext',
            'label' => 'Who do you want to share the room with ?',
            'help' => 'Rooms have 3 occupants in total, input the name and department of the persons you want to share the room with',
            'condition' => "3:Yes"
        ]);

        DB::table('fields')->insert([
            'id' => $id++,
            'type' => 'radio',
            'label' => 'How will you be going to the event ?',
            'options' => 'Train;My own car;Passenger someone\'s car;Plane',
            'help' => 'There will be no shuttle transports this year, parking is 12 CHF for the night'
        ]);

        DB::table('fields')->insert([
            'id' => $id++,
            'type' => 'radio',
            'label' => 'Meal Choice',
            'options' => 'Meat;Fish;Vegetarian'
        ]);

        DB::table('fields')->insert([
            'id' => $id++,
            'type' => 'radio',
            'label' => 'Do you have any dietary restrictions (for example allergies) ?',
            'options' => 'Yes;No'
        ]);

        DB::table('fields')->insert([
            'id' => $id++,
            'type' => 'text',
            'label' => 'Which ones ?',
            'condition' => "7:Yes"
        ]);

        DB::table('fields')->insert([
            'id' => $id++,
            'type' => 'select',
            'label' => 'Sitting place (Team) ?',
            'options' => env('SECRET_TEAMS')
        ]);

        DB::table('fields')->insert([
            'id' => $id++,
            'type' => 'text',
            'label' => 'Comments'
        ]);

        for ($i = 3; $i < $id; $i++) {
            DB::table('event_fields')->insert([
                'event_id' => 1,
                'field_id' => $i
            ]);
        }

    }
}
