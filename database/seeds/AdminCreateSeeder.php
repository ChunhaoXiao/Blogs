<?php

use Illuminate\Database\Seeder;
use App\Models\User ;

class AdminCreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!User::where([['email','admin@admin.com'], ['is_admin',1]])->first())
        {
        	factory(App\Models\Admin::class)->create() ;
        }  	
    }
}
