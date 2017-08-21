<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'test@bb.bb',
            'password' => bcrypt('1234'),
        ]);

        factory(App\User::class, 200)->create();
    }
}
