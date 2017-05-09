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
    	// Inserting 10 users
    	for($i = 0; $i < 10; $i++){
    		DB::table('users')->insert([
	            'first_name' => str_random(10),
	            'second_name' => str_random(10),
	            'email' => str_random(10).'@gmail.com',
	            'password' => bcrypt('secret'),
	            'email_token' => md5(time())
	        ]);
    	}
        
    }
}
