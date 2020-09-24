<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(
          [
              'name'=>'Asraf Poraf',
              'email'=>'asraf@aic-mail.com',
              'password'=>bcrypt('123456789')
          ]
        );
    }
}
