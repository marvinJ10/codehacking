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
        //Use code below to create a seeder
        /*
                 php artisan make:seeder UsersTableSeeder
         * */

        //You the run this command to execute after filling in the column fields
        /*
                php artisan db:seed
         */
        DB::table('users')->insert([
            'name'=>str_random(10),
            'role_id'=>1,
            'is_active'=>2,
            'email'=>str_random(10).'@codingke.com',
            'password'=>bcrypt('secret'),
            'photo_id'=>str_random(3),
            'created_at'=>\Carbon\Carbon::create('2000', '01', '01'),
            'updated_at'=>\Carbon\Carbon::RFC1123,


        ]);
    }
}
