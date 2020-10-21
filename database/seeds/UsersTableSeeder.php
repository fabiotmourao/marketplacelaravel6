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
//        DB::table('users')->insert([
//           'name' => str_random(10),
//            'email' => str_random(10).'@gmail.com',
//           'password' => bcrypt('secret'),
//      ]);

    factory(App\User::class, 40)->create()->each(function ($user) {
        $user->store()->save(factory(\App\Models\Store::class)->make());
        
    });
    
    }
}
