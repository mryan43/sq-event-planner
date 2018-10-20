<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 43,
            'name' => "test",
            'department' => "test",
            'login' => 'test',
            'email' => 'test@test.com'
        ]);
    }
}
