<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
      //   DB::table('users')->insert([
      //   'name' => 'Administrador',
      //   'email' => 'adminbaba13@hotmail.com',
      //   'password' => Hash::make('burguer1212baba'),
      // ]);

      DB::table('garcons')->insert([
      'name' => 'Garçom',
      'email' => 'garconbaba@hotmail.com',
      'password' => Hash::make('garcon3030'),
    ]);


    }

}
